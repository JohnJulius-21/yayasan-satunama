<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\negara;
use App\Models\reguler;
use App\Models\pelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\konsultasi_pelatihan;
use App\Models\permintaan_pelatihan;
use App\Models\peserta_pelatihan_reguler;
use App\Models\peserta_pelatihan_konsultasi;
use App\Models\peserta_pelatihan_permintaan;
use App\Models\hasil_surveykepuasan_reguler;
use App\Models\hasil_surveykepuasan_permintaan;
use App\Models\hasil_surveykepuasan_konsultasi;
use App\Models\form_surveykepuasan_reguler;
use App\Models\form_surveykepuasan_konsultasi;
use App\Models\form_surveykepuasan_permintaan;

class SurveyController extends Controller
{
    // Survey Reguler
    public function indexReguler()
    {
        $reguler = reguler::all();
        return view('admin.survey.reguler.index', compact('reguler'));
    }

    public function createReguler($id)
    {
        $reguler = reguler::findOrFail($id);
        return view('admin.survey.reguler.create', compact('reguler'));
    }

    public function storeReguler(Request $request)
    {
        $reguler = new form_surveykepuasan_reguler();
        $reguler->id_reguler = $request->id_reguler;
        $contentArray = json_decode($request->form, true);
        $reguler->content = $contentArray;
        $reguler->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('surveyShowRegulerAdmin', $reguler->id_reguler)->with('success', 'Form berhasil disimpan.');
    }

    public function showReguler($id)
    {
        $reguler = reguler::findOrFail($id);
        $form = form_surveykepuasan_reguler::with('reguler')->where('id_reguler', $id)->first();
        // dd($reguler);
        // dd($form);
        // $showButtons = is_null($form); //Cek apakah $form nul

        // Tampilkan pesan atau tindakan yang sesuai jika data form surveykepuasan tidak tersedia
        if (!$form || !isset($form->content)) {
            $pesertaStatus = peserta_pelatihan_reguler::with('hasilSurveyReguler')
                ->where('id_reguler', $reguler->id_reguler)
                ->get();
            // dd($pesertaStatus);

            $form1 = form_surveykepuasan_reguler::with('reguler')->where('id_reguler', $reguler->id_reguler)->get();
            $showButtons = $form1->isEmpty(); // Check jika data form kosong
            return view('admin.survey.reguler.show', compact('reguler', 'pesertaStatus', 'showButtons'));
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
        // dd($labels);
        $peserta = peserta_pelatihan_reguler::with([
            'hasilSurveyReguler',
            'negara', // Pastikan peserta memiliki relasi dengan negara
            'provinsi', // Relasi ke provinsi
            'kabupaten_kota' // Relasi ke kabupaten/kota
        ])
            ->where('id_reguler', $reguler->id_reguler)
            ->get();

        $respons = [];
        $negara = [];
        $provinsi = [];
        $kabupaten = [];
        $nama_peserta = [];

        foreach ($peserta as $evaluation) {
            // Ambil data_respons dari hasilSurveyReguler
            $dataRespons = optional($evaluation->hasilSurveyReguler)->data_respons;

            if ($dataRespons !== null) {
                $decodedDataRespons = json_decode($dataRespons, true);

                if (is_array($decodedDataRespons)) {
                    $arrayValues = array_values($decodedDataRespons);

                    // Ambil nama negara, provinsi, dan kabupaten/kota dari relasi model
                    $negara[] = optional($evaluation->negara)->nama_negara ?? '-';
                    $provinsi[] = optional($evaluation->provinsi)->nama_provinsi ?? '-';
                    $kabupaten[] = optional($evaluation->kabupaten_kota)->nama_kabupaten_kota ?? '-';

                    // Hapus indeks 0,1,2 dari respons dan simpan sisanya
                    $respons[] = array_slice($arrayValues, 3);

                    // Simpan nama peserta sesuai data evaluasi
                    $nama_peserta[] = $evaluation->nama_peserta;
                }
            }
        }


        // Dump hasil akhirnya
        // dd($respons, $negara, $provinsi, $kabupaten, $nama_peserta);

        $pesertaStatus = peserta_pelatihan_reguler::with('hasilSurveyReguler')
            ->where('id_reguler', $reguler->id_reguler)
            ->get();


        // dd($pesertaStatus);
        $form1 = form_surveykepuasan_reguler::with('reguler')->where('id_reguler', $reguler->id_reguler)->get();
        $showButtons = $form1->isEmpty();

        return view('admin.survey.reguler.show', compact('reguler', 'pesertaStatus', 'labels', 'respons', 'nama_peserta', 'showButtons', 'negara', 'provinsi', 'kabupaten'));
    }

    public function showEditFormReguler($id)
    {
        // Cek apakah form evaluasi sudah dibuat
        $form = form_surveykepuasan_reguler::where('id_reguler', $id)->first();

        // Jika form belum dibuat, kembalikan ke halaman dengan peringatan
        if (!$form) {
            return redirect()->back()->with('warning', 'Form survey belum dibuat. Harap buat form terlebih dahulu.');
        }

        // Cek apakah sudah ada peserta yang mengisi survey
        $jumlahYangIsi = hasil_surveykepuasan_reguler::where('id_pelatihan_reguler', $id)->count();

        // Jika sudah ada yang mengisi, beri info
        if ($jumlahYangIsi > 0) {
            session()->flash('info', 'Form ini sudah diisi oleh peserta. Mohon tidak mengubah isi form secara berlebihan karena dapat mengacaukan hasil survey.');
        }

        // Tampilkan halaman form builder dengan ID pelatihan reguler
        return view('admin.survey.reguler.edit', compact('form'), ['id' => $id]);
    }

    public function editReguler($id)
    {
        $id_reguler = form_surveykepuasan_reguler::where('id_reguler', $id)->first();
        return $id_reguler;
    }

    public function updateReguler(Request $request)
    {
        $regulerId = $request->id;
        // dd($regulerId);
        $reguler = form_surveykepuasan_reguler::where('id_reguler', $regulerId)->firstOrFail();
        $reguler->id_reguler = $regulerId;
        // $contentArray = json_decode($request->form, true);
        $reguler->content = $request->form;
        $reguler->update();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('surveyShowRegulerAdmin', $regulerId)->with('success', 'Form berhasil diperbarui.');
    }

    public function deleteFormReguler($id)
    {
        // Temukan form evaluasi berdasarkan id_reguler
        $form = form_surveykepuasan_reguler::where('id_reguler', $id)->first();

        if (!$form) {
            return redirect()->route('surveyShowRegulerAdmin', $id)->with('warning', 'Form survey tidak ditemukan.');
        }

        // Hapus semua hasil survey peserta yang terkait
        hasil_surveykepuasan_reguler::where('id_pelatihan_reguler', $id)->delete();

        // Hapus form survey
        $form->delete();

        return redirect()->route('surveyShowRegulerAdmin', $id)->with('success', 'Form dan hasil survey berhasil dihapus.');
    }

    // Survey Permintaan

    public function indexPermintaan()
    {
        $permintaan = permintaan_pelatihan::all();
        return view('admin.survey.permintaan.index', compact('permintaan'));
    }

    public function createPermintaan($id)
    {
        $permintaan = permintaan_pelatihan::findOrFail($id);
        return view('admin.survey.permintaan.create', compact('permintaan'));
    }

    public function storePermintaan(Request $request)
    {
        $permintaan = new form_surveykepuasan_permintaan();
        $permintaan->id_pelatihan_permintaan = $request->id_pelatihan_permintaan;
        $contentArray = json_decode($request->form, true);
        $permintaan->content = $contentArray;
        $permintaan->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('surveyShowPermintaanAdmin', $permintaan->id_pelatihan_permintaan)->with('success', 'Form berhasil disimpan.');
    }

    public function showPermintaan($id)
    {
        $permintaan = permintaan_pelatihan::findOrFail($id);
        $form = form_surveykepuasan_permintaan::with('permintaan_pelatihan')->where('id_pelatihan_permintaan', $id)->first();

        // Tampilkan pesan atau tindakan yang sesuai jika data form surveykepuasan tidak tersedia
        if (!$form || !isset($form->content)) {
            $pesertaStatus = peserta_pelatihan_permintaan::with('hasilSurveyPermintaan')
                ->where('id_pelatihan_permintaan', $permintaan->id_permintaan)
                ->get();

            $form1 = form_surveykepuasan_permintaan::with('permintaan_pelatihan')->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)->get();
            $showButtons = $form1->isEmpty(); // Check jika data form kosong
            return view('admin.survey.permintaan.show', compact('permintaan', 'pesertaStatus', 'showButtons'));
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

        $peserta = peserta_pelatihan_permintaan::with('hasilSurveyPermintaan')
            ->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)
            ->get();
        // dd($peserta); 

        $respons = [];
        $negara = [];
        $provinsi = [];
        $kabupaten = [];
        $nama_peserta = [];

        foreach ($peserta as $evaluation) {
            // Ambil data_respons dari hasilSurveyReguler
            $dataRespons = optional($evaluation->hasilSurveyPermintaan)->data_respons;

            if ($dataRespons !== null) {
                $decodedDataRespons = json_decode($dataRespons, true);

                if (is_array($decodedDataRespons)) {
                    $arrayValues = array_values($decodedDataRespons);

                    $id_negara = $decodedDataRespons['id_negara'] ?? null;
                    $id_provinsi = $decodedDataRespons['id_provinsi'] ?? null;
                    $id_kabupaten_kota = $decodedDataRespons['id_kabupaten'] ?? null;

                    // Cari nama dari tabel terkait
                    $negara[] = DB::table('negara')->where('id', $id_negara)->value('nama_negara') ?? '-';
                    $provinsi[] = DB::table('provinsi')->where('id', $id_provinsi)->value('nama_provinsi') ?? '-';
                    $kabupaten[] = DB::table('kabupaten_kota')->where('id', $id_kabupaten_kota)->value('nama_kabupaten_kota') ?? '-';

                    // Hapus indeks 0,1,2 dari respons dan simpan sisanya
                    $respons[] = array_slice($arrayValues, 3);

                    // Simpan nama peserta sesuai data evaluasi
                    $nama_peserta[] = $evaluation->nama_peserta;
                }
            }
        }

        // dd($respons, $negara, $provinsi, $kabupaten, $nama_peserta);

        $pesertaStatus = peserta_pelatihan_permintaan::with('hasilSurveyPermintaan')
            ->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)
            ->get();
        // dd($pesertaStatus);


        // dd($pesertaStatus);
        $form1 = form_surveykepuasan_permintaan::with('permintaan_pelatihan')->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)->get();
        $showButtons = $form1->isEmpty();
        return view('admin.survey.permintaan.show', compact('permintaan', 'pesertaStatus', 'labels', 'respons', 'nama_peserta', 'showButtons', 'negara', 'provinsi', 'kabupaten'));

    }

    public function showEditFormPermintaan($id)
    {
        // Cek apakah form evaluasi sudah dibuat
        $form = form_surveykepuasan_permintaan::where('id_pelatihan_permintaan', $id)->first();

        // Jika form belum dibuat, kembalikan ke halaman dengan peringatan
        if (!$form) {
            return redirect()->back()->with('warning', 'Form survey belum dibuat. Harap buat form terlebih dahulu.');
        }

        // Cek apakah sudah ada peserta yang mengisi survey
        $jumlahYangIsi = hasil_surveykepuasan_permintaan::where('id_pelatihan_permintaan', $id)->count();

        // Jika sudah ada yang mengisi, beri info
        if ($jumlahYangIsi > 0) {
            session()->flash('info', 'Form ini sudah diisi oleh peserta. Mohon tidak mengubah isi form secara berlebihan karena dapat mengacaukan hasil survey.');
        }

        // Tampilkan halaman form builder dengan ID pelatihan permintaan
        return view('admin.survey.permintaan.edit', compact('form'), ['id' => $id]);
    }

    public function editPermintaan($id)
    {
        $id_permintaan = form_surveykepuasan_permintaan::where('id_pelatihan_permintaan', $id)->first();
        return $id_permintaan;
    }

    public function updatePermintaan(Request $request)
    {
        $permintaanId = $request->id;
        $permintaan = form_surveykepuasan_permintaan::where('id_pelatihan_permintaan', $permintaanId)->firstOrFail();
        // dd($permintaan);
        $permintaan->id_pelatihan_permintaan = $permintaanId;
        $permintaan->content = $request->form;
        $permintaan->update();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('surveyShowPermintaanAdmin', $permintaanId)->with('success', 'Form berhasil diperbarui.');
    }

    public function deleteFormPermintaan($id)
    {
        // Temukan form evaluasi berdasarkan id_reguler
        $form = form_surveykepuasan_permintaan::where('id_pelatihan_permintaan', $id)->first();
        // dd( $form);

        if (!$form) {
            return redirect()->route('surveyShowPermintaanAdmin', $id)->with('warning', 'Form survey tidak ditemukan.');
        }

        // Hapus semua hasil survey peserta yang terkait
        hasil_surveykepuasan_permintaan::where('id_pelatihan_permintaan', $id)->delete();

        // Hapus form survey
        $form->delete();

        return redirect()->route('surveyShowPermintaanAdmin', $id)->with('success', 'Form dan hasil survey berhasil dihapus.');
    }

    // Survey Konsultasi

    public function indexKonsultasi()
    {
        $konsultasi = konsultasi_pelatihan::all();
        return view('admin.survey.konsultasi.index', compact('konsultasi'));
    }

    public function createKonsultasi($id)
    {
        $konsultasi = konsultasi_pelatihan::findOrFail($id);
        return view('admin.survey.konsultasi.create', compact('konsultasi'));
    }

    public function storeKonsultasi(Request $request)
    {
        $konsultasi = new form_surveykepuasan_Konsultasi();
        $konsultasi->id_pelatihan_konsultasi = $request->id_pelatihan_konsultasi;
        $contentArray = json_decode($request->form, true);
        $konsultasi->content = $contentArray;
        $konsultasi->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('surveyShowKonsultasiAdmin', $konsultasi->id_pelatihan_konsultasi)->with('success', 'Form berhasil disimpan.');
    }

    public function showKonsultasi($id)
    {
        $konsultasi = konsultasi_pelatihan::findOrFail($id);
        $form = form_surveykepuasan_konsultasi::with('konsultasi_pelatihan')->where('id_pelatihan_konsultasi', $id)->first();
        // dd($konsultasi);
        // dd($form);
        // $showButtons = is_null($form); //Cek apakah $form nul

        // Tampilkan pesan atau tindakan yang sesuai jika data form Survey tidak tersedia
        if (!$form || !isset($form->content)) {
            $pesertaStatus = peserta_pelatihan_konsultasi::with('hasilSurveyKonsultasi')
                ->where('id_pelatihan_konsultasi', $konsultasi->id_konsultasi)
                ->get();

            $form1 = form_surveykepuasan_konsultasi::with('konsultasi_pelatihan')->where('id_pelatihan_konsultasi', $konsultasi->id_pelatihan_konsultasi)->get();
            $showButtons = $form1->isEmpty(); // Check jika data form kosong
            return view('admin.survey.konsultasi.show', compact('konsultasi', 'pesertaStatus', 'showButtons'));
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

        $peserta = peserta_pelatihan_konsultasi::with('hasilSurveyKonsultasi')
            ->where('id_pelatihan_konsultasi', $konsultasi->id_pelatihan_konsultasi)
            ->get();
        // dd($peserta);

        $respons = [];
        $negara = [];
        $provinsi = [];
        $kabupaten = [];
        $nama_peserta = [];

        foreach ($peserta as $evaluation) {
            // Ambil data_respons dari hasilSurveyReguler
            $dataRespons = optional($evaluation->hasilSurveyKonsultasi)->data_respons;

            if ($dataRespons !== null) {
                $decodedDataRespons = json_decode($dataRespons, true);

                if (is_array($decodedDataRespons)) {
                    $arrayValues = array_values($decodedDataRespons);

                    $id_negara = $decodedDataRespons['id_negara'] ?? null;
                    $id_provinsi = $decodedDataRespons['id_provinsi'] ?? null;
                    $id_kabupaten_kota = $decodedDataRespons['id_kabupaten'] ?? null;

                    // Cari nama dari tabel terkait
                    $negara[] = DB::table('negara')->where('id', $id_negara)->value('nama_negara') ?? '-';
                    $provinsi[] = DB::table('provinsi')->where('id', $id_provinsi)->value('nama_provinsi') ?? '-';
                    $kabupaten[] = DB::table('kabupaten_kota')->where('id', $id_kabupaten_kota)->value('nama_kabupaten_kota') ?? '-';

                    // Hapus indeks 0,1,2 dari respons dan simpan sisanya
                    $respons[] = array_slice($arrayValues, 3);

                    // Simpan nama peserta sesuai data evaluasi
                    $nama_peserta[] = $evaluation->nama_peserta;
                }
            }
        }

        $pesertaStatus = peserta_pelatihan_konsultasi::with('hasilSurveyKonsultasi')
            ->where('id_pelatihan_konsultasi', $konsultasi->id_pelatihan_konsultasi)
            ->get();


        // dd($pesertaStatus);
        $form1 = form_surveykepuasan_konsultasi::with('konsultasi_pelatihan')->where('id_pelatihan_konsultasi', $konsultasi->id_pelatihan_konsultasi)->get();
        $showButtons = $form1->isEmpty();
        return view('admin.survey.konsultasi.show', compact('konsultasi', 'pesertaStatus', 'labels', 'respons', 'nama_peserta', 'showButtons', 'negara', 'provinsi', 'kabupaten'));
    }

    public function showEditFormKonsultasi($id)
    {
        // Cek apakah form evaluasi sudah dibuat
        $form = form_surveykepuasan_konsultasi::where('id_pelatihan_konsultasi', $id)->first();

        // Jika form belum dibuat, kembalikan ke halaman dengan peringatan
        if (!$form) {
            return redirect()->back()->with('warning', 'Form survey belum dibuat. Harap buat form terlebih dahulu.');
        }

        // Cek apakah sudah ada peserta yang mengisi survey
        $jumlahYangIsi = hasil_surveykepuasan_konsultasi::where('id_pelatihan_konsultasi', $id)->count();

        // Jika sudah ada yang mengisi, beri info
        if ($jumlahYangIsi > 0) {
            session()->flash('info', 'Form ini sudah diisi oleh peserta. Mohon tidak mengubah isi form secara berlebihan karena dapat mengacaukan hasil survey.');
        }

        // Tampilkan halaman form builder dengan ID pelatihan konsultasi
        return view('admin.survey.konsultasi.edit', compact('form'), ['id' => $id]);
    }

    public function editKonsultasi($id)
    {
        $id_konsultasi = form_surveykepuasan_konsultasi::where('id_pelatihan_konsultasi', $id)->first();
        return $id_konsultasi;
    }

    public function updateKonsultasi(Request $request)
    {
        $konsultasiId = $request->id;
        $konsultasi = form_surveykepuasan_konsultasi::where('id_pelatihan_konsultasi',$konsultasiId)->firstOrFail();
        // dd($konsultasiId);
        $konsultasi->id_pelatihan_konsultasi = $konsultasiId;
        $konsultasi->content = $request->form;
        $konsultasi->update();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('surveyShowKonsultasiAdmin', $konsultasiId)->with('success', 'Form berhasil diperbarui.');
    }

    public function deleteFormKonsultasi($id)
    {
        // Temukan form evaluasi berdasarkan id_reguler
        $form = form_surveykepuasan_konsultasi::where('id_pelatihan_konsultasi', $id)->first();
        // dd( $form);

        if (!$form) {
            return redirect()->route('surveyShowKonsultasiAdmin', $id)->with('warning', 'Form survey tidak ditemukan.');
        }

        // Hapus semua hasil survey peserta yang terkait
        hasil_surveykepuasan_konsultasi::where('id_pelatihan_konsultasi', $id)->delete();

        // Hapus form survey
        $form->delete();

        return redirect()->route('surveyShowKonsultasiAdmin', $id)->with('success', 'Form dan hasil survey berhasil dihapus.');
    }
}
