<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Models\reguler;
use App\Models\konsultasi;
use App\Models\permintaan;
use Illuminate\Http\Request;
use App\Models\konsultasi_pelatihan;
use App\Models\permintaan_pelatihan;
use App\Models\hasil_evaluasi_reguler;
use App\Models\hasil_evaluasi_permintaan;
use App\Models\hasil_evaluasi_konsultasi;
use App\Models\form_evaluasi_reguler;
use App\Models\form_evaluasi_konsultasi;
use App\Models\form_evaluasi_permintaan;
use App\Models\peserta_pelatihan_reguler;
use App\Models\peserta_pelatihan_permintaan;
use App\Models\peserta_pelatihan_konsultasi;
use App\Traits\DataTableHelper;
use Carbon\Carbon;

class EvaluasiController extends Controller
{
    use DataTableHelper;

    // Evaluasi Reguler
    public function indexReguler(Request $request)
    {
        // $evaluasi = evaluasi::paginate(3);
        $reguler = reguler::all();
        $query = reguler::query();
        $this->applySearch($query, $request, ['nama_pelatihan', 'tanggal_mulai', 'tanggal_selesai']);

        // Order by tanggal_mulai descending (terbaru dulu)
        $query->orderBy('tanggal_mulai', 'desc');

        // Get paginated data
        $perPage = $request->get('per_page', 10);
        $data = $query->paginate($perPage);

        // Preserve query parameters in pagination links
        $data->appends($request->query());
        // Format tanggal dengan Carbon
        $data->getCollection()->transform(function ($item) {
            $item->tanggal_mulai = Carbon::parse($item->tanggal_mulai)->locale('id')->isoFormat('D MMMM YYYY');
            $item->tanggal_selesai = Carbon::parse($item->tanggal_selesai)->locale('id')->isoFormat('D MMMM YYYY');
            return $item;
        });

        $columns = [
            ['label' => 'Nama Pelatihan', 'field' => 'nama_pelatihan'],
            ['label' => 'Tanggal Mulai', 'field' => 'tanggal_mulai'],
            ['label' => 'Tanggal Selesai', 'field' => 'tanggal_selesai'],
            ['label' => 'Aksi', 'field' => 'aksi'],
        ];

        $actions = [
            [
                'route' => 'evaluasiShowRegulerAdmin',
                'param' => 'id_reguler',
                'label' => '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>Lihat Detail',
                'class' => 'inline-flex items-center px-3 py-2 border border-blue-300 text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100'
            ]
        ];

        // Handle AJAX
        $response = $this->handleDataTableResponse(
            $request,
            $data,
            'partials.table_rows',
            compact('columns', 'actions')
        );

        if ($response) return $response;

        return view('admin.evaluasi.reguler.index', compact('data', 'columns', 'actions'));
    }

    public function createReguler($id)
    {
        $reguler = reguler::findOrFail($id);
        return view('admin.evaluasi.reguler.create', compact('reguler'));
    }

    public function storeReguler(Request $request)
    {
        $reguler = new form_evaluasi_reguler();
        $reguler->id_reguler = $request->id_reguler;
        $contentArray = json_decode($request->form, true);
        $reguler->content = $contentArray;
        $reguler->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('evaluasiShowRegulerAdmin', $reguler->id_reguler)->with('success', 'Form berhasil disimpan.');
    }

    public function showReguler($id)
    {
        $reguler = reguler::findOrFail($id);
        $form = form_evaluasi_reguler::with('reguler')->where('id_reguler', $id)->first();
        // dd($reguler);
        // dd($form);
        // $showButtons = is_null($form); //Cek apakah $form nul

        // Tampilkan pesan atau tindakan yang sesuai jika data form evaluasi tidak tersedia
        if (!$form || !isset($form->content)) {
            $pesertaStatus = peserta_pelatihan_reguler::with('hasilEvaluasiReguler')
                ->where('id_reguler', $reguler->id_reguler)
                ->get();
            // dd($pesertaStatus);
            $form1 = form_evaluasi_reguler::with('reguler')->where('id_reguler', $reguler->id_reguler)->get();
            $showButtons = $form1->isEmpty(); // Check jika data form kosong
            return view('admin.evaluasi.reguler.show', compact('reguler', 'pesertaStatus', 'showButtons'));
        }
        // Decode JSON menjadi array PHP
        $contentArray = $form ? json_decode($form->content, true) : null;

        // Inisialisasi array untuk menyimpan label
        $labels = [];
        // Iterasi melalui setiap objek dalam array content
        foreach ($contentArray as $item) {
            // Memeriksa apakah tipe bukan header dan bukan paragraph
            if ($item['type'] !== 'header' && $item['type'] !== 'paragraph') {
                // Jika objek memiliki properti 'label', tambahkan label ke dalam array
                if (isset($item['label'])) {
                    $label = strip_tags($item['label']); // Menghilangkan tag HTML dari label

                    $labels[] = $label;
                }
            }
        }


        $peserta = peserta_pelatihan_reguler::with('hasilEvaluasiReguler')
            ->where('id_reguler', $reguler->id_reguler)
            ->get();

        $respons = [];
        $nama_peserta = [];

        foreach ($peserta as $evaluation) {
            // Ambil data_respons dari relasi hasilEvaluasiReguler
            $dataRespons = optional($evaluation->hasilEvaluasiReguler)->data_respons;

            if ($dataRespons !== null) {
                $decodedDataRespons = json_decode($dataRespons, true);

                if (is_array($decodedDataRespons)) {
                    $respons[] = array_values($decodedDataRespons);
                    $nama_peserta[] = $evaluation->nama_peserta; // Simpan nama peserta sesuai data evaluasi
                }
            }
        }

        // Debug hasilnya
        // dd($respons, $nama_peserta);


        // dd($respons);
        $pesertaStatus = peserta_pelatihan_reguler::with('hasilEvaluasiReguler')
            ->where('id_reguler', $reguler->id_reguler)
            ->get();


        // dd($pesertaStatus);
        $form1 = form_evaluasi_reguler::with('reguler')->where('id_reguler', $reguler->id_reguler)->get();
        $showButtons = $form1->isEmpty();

        return view('admin.evaluasi.reguler.show', compact('reguler', 'pesertaStatus', 'labels', 'respons', 'nama_peserta', 'showButtons'));
    }

    public function showEditFormReguler($id)
    {
        // Cek apakah form evaluasi sudah dibuat
        $form = form_evaluasi_reguler::where('id_reguler', $id)->first();

        // Jika form belum dibuat, kembalikan ke halaman dengan peringatan
        if (!$form) {
            return redirect()->back()->with('warning', 'Form evaluasi belum dibuat. Harap buat form terlebih dahulu.');
        }

        // Cek apakah sudah ada peserta yang mengisi evaluasi
        $jumlahYangIsi = hasil_evaluasi_reguler::where('id_pelatihan_reguler', $id)->count();

        // Jika sudah ada yang mengisi, beri info
        if ($jumlahYangIsi > 0) {
            session()->flash('info', 'Form ini sudah diisi oleh peserta. Mohon tidak mengubah isi form secara berlebihan karena dapat mengacaukan hasil evaluasi.');
        }

        // Tampilkan halaman form builder dengan ID pelatihan reguler
        return view('admin.evaluasi.reguler.edit', compact('form'), ['id' => $id]);
    }


    public function editReguler($id)
    {
        $id_reguler = form_evaluasi_reguler::where('id_reguler', $id)->first();
        return $id_reguler;
    }

    public function updateReguler(Request $request)
    {
        $regulerId = $request->id;
        // dd($regulerId);
        $reguler = form_evaluasi_reguler::where('id_reguler', $regulerId)->firstOrFail();
        $reguler->id_reguler = $regulerId;
        // $contentArray = json_decode($request->form, true);
        $reguler->content = $request->form;
        $reguler->update();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('evaluasiShowRegulerAdmin', $regulerId)->with('success', 'Form berhasil diperbarui.');
    }

    public function deleteFormReguler($id)
    {
        // Temukan form evaluasi berdasarkan id_reguler
        $form = form_evaluasi_reguler::where('id_reguler', $id)->first();

        if (!$form) {
            return redirect()->route('evaluasiShowRegulerAdmin', $id)->with('warning', 'Form evaluasi tidak ditemukan.');
        }

        // Hapus semua hasil evaluasi peserta yang terkait
        hasil_evaluasi_reguler::where('id_pelatihan_reguler', $id)->delete();

        // Hapus form evaluasi
        $form->delete();

        return redirect()->route('evaluasiShowRegulerAdmin', $id)->with('success', 'Form dan hasil evaluasi berhasil dihapus.');
    }


    // Evaluasi Permintaan
    public function indexPermintaan(Request $request)
    {
        // $evaluasi = evaluasi::paginate(3);
        $permintaan = permintaan_pelatihan::all();
        $query = permintaan_pelatihan::query();
        $this->applySearch($query, $request, ['nama_pelatihan', 'tanggal_mulai', 'tanggal_selesai']);
        $data = $query->paginate($request->get('per_page', 10));

        // Format tanggal dengan Carbon
        $data->getCollection()->transform(function ($item) {
            $item->tanggal_mulai = Carbon::parse($item->tanggal_mulai)->locale('id')->isoFormat('D MMMM YYYY');
            $item->tanggal_selesai = Carbon::parse($item->tanggal_selesai)->locale('id')->isoFormat('D MMMM YYYY');
            return $item;
        });

        $columns = [
            ['label' => 'Nama Pelatihan', 'field' => 'nama_pelatihan'],
            ['label' => 'Tanggal Mulai', 'field' => 'tanggal_mulai'],
            ['label' => 'Tanggal Selesai', 'field' => 'tanggal_selesai'],
            ['label' => 'Aksi', 'field' => 'aksi'],
        ];

        $actions = [
            [
                'route' => 'evaluasiShowPermintaanAdmin',
                'param' => 'id_pelatihan_permintaan',
                'label' => '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>Lihat Detail',
                'class' => 'inline-flex items-center px-3 py-2 border border-blue-300 text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100'
            ]
        ];

        // Handle AJAX
        $response = $this->handleDataTableResponse(
            $request,
            $data,
            'partials.table_rows',
            compact('columns', 'actions')
        );

        if ($response) return $response;

        return view('admin.evaluasi.permintaan.index', compact('data', 'columns', 'actions'));
    }

    public function createPermintaan($id)
    {
        $permintaan = permintaan_pelatihan::findOrFail($id);
        // dd($permintaan);
        return view('admin.evaluasi.permintaan.create', compact('permintaan'));
    }

    public function showPermintaan($id)
    {
        $permintaan = permintaan_pelatihan::findOrFail($id);
        $form = form_evaluasi_permintaan::with('permintaan_pelatihan')->where('id_pelatihan_permintaan', $id)->first();

        // Tampilkan pesan atau tindakan yang sesuai jika data form evaluasi tidak tersedia
        if (!$form || !isset($form->content)) {
            $pesertaStatus = peserta_pelatihan_permintaan::with('hasilEvaluasiPermintaan')
                ->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)
                ->get();

            $form1 = form_evaluasi_permintaan::with('permintaan_pelatihan')->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)->get();
            $showButtons = $form1->isEmpty();

            // Return dengan labels kosong untuk menghindari error di view
            return view('admin.evaluasi.permintaan.show', compact('permintaan', 'pesertaStatus', 'showButtons'))->with(['labels' => [], 'respons' => [], 'nama_peserta' => []]);
        }

        // Decode JSON dengan validasi yang lebih robust
        $contentArray = null;

        if (!empty($form->content)) {
            // Cek apakah content sudah berupa array atau masih string
            if (is_string($form->content)) {
                $contentArray = json_decode($form->content, true);
            } elseif (is_array($form->content)) {
                $contentArray = $form->content;
            }
        }

        // Validasi hasil decode
        if (!is_array($contentArray)) {
            // Log error untuk debugging
            \Log::error('Content decode failed', [
                'form_id' => $form->id ?? 'unknown',
                'content_type' => gettype($form->content),
                'content_preview' => is_string($form->content) ? substr($form->content, 0, 100) : 'not string',
                'json_error' => json_last_error_msg()
            ]);

            $pesertaStatus = peserta_pelatihan_permintaan::with('hasilEvaluasiPermintaan')
                ->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)
                ->get();

            $form1 = form_evaluasi_permintaan::with('permintaan_pelatihan')->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)->get();
            $showButtons = $form1->isEmpty();

            // Return dengan labels kosong dan pesan error
            return view('admin.evaluasi.permintaan.show', compact('permintaan', 'pesertaStatus', 'showButtons'))
                ->with(['labels' => [], 'respons' => [], 'nama_peserta' => []])
                ->with('warning', 'Data form evaluasi tidak valid. Silakan buat ulang form evaluasi.');
        }

        // Inisialisasi array untuk menyimpan label
        $labels = [];

        // Iterasi dengan validasi tambahan
        if (is_array($contentArray)) {
            foreach ($contentArray as $item) {
                // Pastikan $item adalah array dan memiliki struktur yang benar
                if (is_array($item) && isset($item['type'])) {
                    // Memeriksa apakah tipe bukan header dan bukan paragraph
                    if ($item['type'] !== 'header' && $item['type'] !== 'paragraph') {
                        // Jika objek memiliki properti 'label', tambahkan label ke dalam array
                        if (isset($item['label'])) {
                            $label = strip_tags($item['label']); // Menghilangkan tag HTML dari label
                            $labels[] = $label;
                        }
                    }
                }
            }
        }
//        dd($labels);

        $peserta = peserta_pelatihan_permintaan::with('hasilEvaluasiPermintaan')
            ->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)
            ->get();

        $respons = [];
        $nama_peserta = [];

        foreach ($peserta as $evaluation) {
            // Ambil data_respons dari relasi hasilEvaluasiPermintaan
            $dataRespons = optional($evaluation->hasilEvaluasiPermintaan)->data_respons;

            if ($dataRespons !== null) {
                $decodedDataRespons = json_decode($dataRespons, true);

                if (is_array($decodedDataRespons)) {
                    $respons[] = array_values($decodedDataRespons);
                    $nama_peserta[] = $evaluation->nama_peserta;
                }
            }
        }

        $pesertaStatus = peserta_pelatihan_permintaan::with('hasilEvaluasiPermintaan')
            ->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)
            ->get();

        $form1 = form_evaluasi_permintaan::with('permintaan_pelatihan')->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)->get();
        $showButtons = $form1->isEmpty();

        return view('admin.evaluasi.permintaan.show', compact('permintaan', 'pesertaStatus', 'labels', 'respons', 'nama_peserta', 'showButtons'));
    }

    public function showEditFormPermintaan($id)
    {
        // Cek apakah form evaluasi sudah dibuat
        $form = form_evaluasi_permintaan::where('id_pelatihan_permintaan', $id)->first();

        // Jika form belum dibuat, kembalikan ke halaman dengan peringatan
        if (!$form) {
            return redirect()->back()->with('warning', 'Form evaluasi belum dibuat. Harap buat form terlebih dahulu.');
        }

        // Cek apakah sudah ada peserta yang mengisi evaluasi
        $jumlahYangIsi = hasil_evaluasi_permintaan::where('id_pelatihan_permintaan', $id)->count();

        // Jika sudah ada yang mengisi, beri info
        if ($jumlahYangIsi > 0) {
            session()->flash('info', 'Form ini sudah diisi oleh peserta. Mohon tidak mengubah isi form secara berlebihan karena dapat mengacaukan hasil evaluasi.');
        }

        // Tampilkan halaman form builder dengan ID pelatihan permintaan
        return view('admin.evaluasi.permintaan.edit', compact('form'), ['id' => $id]);
    }

    public function editPermintaan($id)
    {
        $id_pelatihan_permintaan = form_evaluasi_permintaan::where('id_pelatihan_permintaan', $id)->first();
        return $id_pelatihan_permintaan;
    }

    public function storePermintaan(Request $request)
    {
        $permintaan = new form_evaluasi_Permintaan();
        $permintaan->id_pelatihan_permintaan = $request->id_pelatihan_permintaan;
        $contentArray = json_decode($request->form, true);
        $permintaan->content = $contentArray;
        $permintaan->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('evaluasiShowPermintaanAdmin', $permintaan->id_pelatihan_permintaan)->with('success', 'Form berhasil disimpan.');
    }

    public function updatePermintaan(Request $request)
    {
        $permintaanId = $request->id;
        $permintaan = form_evaluasi_permintaan::where('id_pelatihan_permintaan', $permintaanId)->firstOrFail();
        // dd($permintaan);
        $permintaan->id_pelatihan_permintaan = $permintaanId;
        $permintaan->content = $request->form;
        $permintaan->update();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('evaluasiShowPermintaanAdmin', $permintaanId)->with('success', 'Form berhasil diperbarui.');
    }

    public function deleteFormPermintaan($id)
    {
        // Temukan form evaluasi berdasarkan id_reguler
        $form = form_evaluasi_permintaan::where('id_pelatihan_permintaan', $id)->first();

        if (!$form) {
            return redirect()->route('evaluasiShowpermintaanAdmin', $id)->with('warning', 'Form evaluasi tidak ditemukan.');
        }

        // Hapus semua hasil evaluasi peserta yang terkait
        hasil_evaluasi_permintaan::where('id_pelatihan_permintaan', $id)->delete();

        // Hapus form evaluasi
        $form->delete();

        return redirect()->route('evaluasiShowPermintaanAdmin', $id)->with('success', 'Form dan hasil evaluasi berhasil dihapus.');
    }

    // Evaluasi Konsultasi
    public function indexkonsultasi()
    {
        // $evaluasi = evaluasi::paginate(3);
        $konsultasi = konsultasi_pelatihan::all();
        // dd($konsultasi);

        return view('admin.evaluasi.konsultasi.index', compact('konsultasi'));
    }

    public function createkonsultasi($id)
    {
        $konsultasi = konsultasi_pelatihan::findOrFail($id);
        // dd($konsultasi);
        return view('admin.evaluasi.konsultasi.create', compact('konsultasi'));
    }

    public function storeKonsultasi(Request $request)
    {
        // dd($request->id_pelatihan_konsultasi);

        $konsultasi = new form_evaluasi_konsultasi();
        $konsultasi->id_pelatihan_konsultasi = (int)$request->id_pelatihan_konsultasi; // PAKSA JADI INTEGER
        $contentArray = json_decode($request->form, true);
        $konsultasi->content = $contentArray;
        $konsultasi->save();


        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('evaluasiShowKonsultasiAdmin', $konsultasi->id_pelatihan_konsultasi)->with('success', 'Form berhasil disimpan.');
    }

    public function showkonsultasi($id)
    {
        $konsultasi = konsultasi_pelatihan::findOrFail($id);
        $form = form_evaluasi_konsultasi::with('konsultasi_pelatihan')->where('id_pelatihan_konsultasi', $id)->first();
        // dd($konsultasi);
        // dd($form);
        // $showButtons = is_null($form); //Cek apakah $form nul

        // Tampilkan pesan atau tindakan yang sesuai jika data form evaluasi tidak tersedia
        if (!$form || !isset($form->content)) {
            $pesertaStatus = peserta_pelatihan_konsultasi::with('hasilEvaluasiKonsultasi')
                ->where('id_pelatihan_konsultasi', $konsultasi->id_pelatihan_konsultasi)
                ->get();

            $form1 = form_evaluasi_konsultasi::with('konsultasi_pelatihan')->where('id_pelatihan_konsultasi', $konsultasi->id_pelatihan_konsultasi)->get();
            $showButtons = $form1->isEmpty(); // Check jika data form kosong
            return view('admin.evaluasi.konsultasi.show', compact('konsultasi', 'pesertaStatus', 'showButtons'));
        }
        // Decode JSON menjadi array PHP
        $contentArray = $form ? json_decode($form->content, true) : null;

        // Inisialisasi array untuk menyimpan label
        $labels = [];
        // Iterasi melalui setiap objek dalam array content
        foreach ($contentArray as $item) {
            // Memeriksa apakah tipe bukan header dan bukan paragraph
            if ($item['type'] !== 'header' && $item['type'] !== 'paragraph') {
                // Jika objek memiliki properti 'label', tambahkan label ke dalam array
                if (isset($item['label'])) {
                    $label = strip_tags($item['label']); // Menghilangkan tag HTML dari label

                    $labels[] = $label;
                }
            }
        }

        $peserta = peserta_pelatihan_konsultasi::with('hasilEvaluasiKonsultasi')
            ->where('id_pelatihan_konsultasi', $konsultasi->id_pelatihan_konsultasi)
            ->get();
        // dd($peserta);

        $respons = [];
        $nama_peserta = [];

        foreach ($peserta as $evaluation) {
            // Ambil data_respons dari relasi hasilEvaluasiReguler
            $dataRespons = optional($evaluation->hasilEvaluasiKonsultasi)->data_respons;

            if ($dataRespons !== null) {
                $decodedDataRespons = json_decode($dataRespons, true);

                if (is_array($decodedDataRespons)) {
                    $respons[] = array_values($decodedDataRespons);
                    $nama_peserta[] = $evaluation->nama_peserta; // Simpan nama peserta sesuai data evaluasi
                }
            }
        }

        $pesertaStatus = peserta_pelatihan_konsultasi::with('hasilEvaluasiKonsultasi')
            ->where('id_pelatihan_konsultasi', $konsultasi->id_pelatihan_konsultasi)
            ->get();


        // dd($pesertaStatus);
        $form1 = form_evaluasi_konsultasi::with('konsultasi_pelatihan')->where('id_pelatihan_konsultasi', $konsultasi->id_pelatihan_konsultasi)->get();
        $showButtons = $form1->isEmpty();
        return view('admin.evaluasi.konsultasi.show', compact('konsultasi', 'pesertaStatus', 'labels', 'respons', 'nama_peserta', 'showButtons'));
    }

    public function showEditFormKonsultasi($id)
    {
        // Cek apakah form evaluasi sudah dibuat
        $form = form_evaluasi_konsultasi::where('id_pelatihan_konsultasi', $id)->first();

        // Jika form belum dibuat, kembalikan ke halaman dengan peringatan
        if (!$form) {
            return redirect()->back()->with('warning', 'Form evaluasi belum dibuat. Harap buat form terlebih dahulu.');
        }

        // Cek apakah sudah ada peserta yang mengisi evaluasi
        $jumlahYangIsi = hasil_evaluasi_konsultasi::where('id_pelatihan_konsultasi', $id)->count();

        // Jika sudah ada yang mengisi, beri info
        if ($jumlahYangIsi > 0) {
            session()->flash('info', 'Form ini sudah diisi oleh peserta. Mohon tidak mengubah isi form secara berlebihan karena dapat mengacaukan hasil evaluasi.');
        }

        // Tampilkan halaman form builder dengan ID pelatihan konsultasi
        return view('admin.evaluasi.konsultasi.edit', compact('form'), ['id' => $id]);
    }

    public function editkonsultasi($id)
    {
        $id_konsultasi = form_evaluasi_konsultasi::where('id_pelatihan_konsultasi', $id)->first();
        return $id_konsultasi;
    }

    public function updateKonsultasi(Request $request)
    {
        $konsultasiId = $request->id;
        $konsultasi = form_evaluasi_konsultasi::where('id_pelatihan_konsultasi', $konsultasiId)->firstOrFail();
        // dd($konsultasiId);
        $konsultasi->id_pelatihan_konsultasi = $konsultasiId;
        $konsultasi->content = $request->form;
        $konsultasi->update();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('evaluasiShowKonsultasiAdmin', $konsultasiId)->with('success', 'Form berhasil diperbarui.');
    }

    public function deleteFormKonsultasi($id)
    {
        // Temukan form evaluasi berdasarkan id_reguler
        $form = form_evaluasi_konsultasi::where('id_pelatihan_konsultasi', $id)->first();

        if (!$form) {
            return redirect()->route('evaluasiShowkonsultasiAdmin', $id)->with('warning', 'Form evaluasi tidak ditemukan.');
        }

        // Hapus semua hasil evaluasi peserta yang terkait
        hasil_evaluasi_konsultasi::where('id_pelatihan_konsultasi', $id)->delete();

        // Hapus form evaluasi
        $form->delete();

        return redirect()->route('evaluasiShowKonsultasiAdmin', $id)->with('success', 'Form dan hasil evaluasi berhasil dihapus.');
    }
}

