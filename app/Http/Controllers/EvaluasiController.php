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

class EvaluasiController extends Controller
{
    // Evaluasi Reguler
    public function indexReguler()
    {
        // $evaluasi = evaluasi::paginate(3);
        $reguler = reguler::all();

        return view('admin.evaluasi.reguler.index', compact('reguler'));
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
    public function indexPermintaan()
    {
        // $evaluasi = evaluasi::paginate(3);
        $permintaan = permintaan_pelatihan::all();

        return view('admin.evaluasi.permintaan.index', compact('permintaan'));
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
        // dd($permintaan);
        // dd($form);
        // $showButtons = is_null($form); //Cek apakah $form nul

        // Tampilkan pesan atau tindakan yang sesuai jika data form evaluasi tidak tersedia
        if (!$form || !isset($form->content)) {
            $pesertaStatus = peserta_pelatihan_permintaan::with('hasilEvaluasiPermintaan')
                ->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)
                ->get();

            $form1 = form_evaluasi_permintaan::with('permintaan_pelatihan')->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)->get();
            $showButtons = $form1->isEmpty(); // Check jika data form kosong
            return view('admin.evaluasi.permintaan.show', compact('permintaan', 'pesertaStatus', 'showButtons'));
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

        $peserta = peserta_pelatihan_permintaan::with('hasilEvaluasiPermintaan')
            ->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)
            ->get();
        // dd($peserta); 
        // dd($nama_peserta);
        $respons = [];
        $nama_peserta = [];

        foreach ($peserta as $evaluation) {
            // Ambil data_respons dari relasi hasilEvaluasiReguler
            $dataRespons = optional($evaluation->hasilEvaluasiPermintaan)->data_respons;

            if ($dataRespons !== null) {
                $decodedDataRespons = json_decode($dataRespons, true);

                if (is_array($decodedDataRespons)) {
                    $respons[] = array_values($decodedDataRespons);
                    $nama_peserta[] = $evaluation->nama_peserta; // Simpan nama peserta sesuai data evaluasi
                }
            }
        }

        $pesertaStatus = peserta_pelatihan_permintaan::with('hasilEvaluasiPermintaan')
            ->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)
            ->get();


        // dd($pesertaStatus);
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
        $konsultasi->id_pelatihan_konsultasi = (int) $request->id_pelatihan_konsultasi; // PAKSA JADI INTEGER
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

