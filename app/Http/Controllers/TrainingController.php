<?php

namespace App\Http\Controllers;

use App\Models\tema;
use App\Models\mitra;
use App\Models\negara;
use App\Models\reguler;
use App\Models\provinsi;
use App\Models\pelatihan;
use App\Models\rentang_usia;
use Illuminate\Http\Request;
use App\Models\kabupaten_kota;
use App\Models\jenis_organisasi;
use Illuminate\Support\Facades\DB;
use App\Models\informasi_pelatihan;
use Illuminate\Support\Facades\Auth;
use App\Models\form_evaluasi_reguler;
use Illuminate\Support\Facades\Storage;
use App\Models\form_studidampak_reguler;
use App\Models\peserta_pelatihan_reguler;
use App\Models\form_surveykepuasan_reguler;
use App\Models\peserta_pelatihan_konsultasi;
use App\Models\peserta_pelatihan_permintaan;

class TrainingController extends Controller
{
    public function index()
    {
        $reguler = reguler::paginate(3);

        return view('user.training.index', compact('reguler'), [
            'title' => 'Pelatihan',
        ]);
    }

    public function showReguler($id)
    {
        // Fetch the specific pelatihan by its ID
        $pelatihan = reguler::findOrFail($id);
        // dd($pelatihan);

        // Ambil data images langsung dari tabel reguler_images
        $imageUrls = DB::table('reguler_images')
            ->where('id_reguler', $id)
            ->pluck('image_url')
            ->map(function ($url) {
                return 'https://drive.google.com/uc?export=view&id=' . $url;
            });


        // Ambil data fasilitator yang sudah terhubung dengan reguler ini dari tabel pivot reguler_fasilitators
        $fasilitators = DB::table('reguler_fasilitators')
            ->join('fasilitator_pelatihan', 'reguler_fasilitators.id_fasilitator', '=', 'fasilitator_pelatihan.id_fasilitator')
            ->where('reguler_fasilitators.id_pelatihan', $id)
            ->select('fasilitator_pelatihan.*')
            ->get();

        if (!$pelatihan) {
            abort(404, 'Pelatihan not found');
        }

        // Return the view with the pelatihan details
        return view('user.training.reguler.show', compact('pelatihan', 'fasilitators', 'imageUrls'), [
            'title' => 'Detail Pelatihan',
        ]);
    }

    public function indexReguler(Request $request)
    {
        // Fetch the specific pelatihan by its ID
        $query = $request->input('search');

        if ($query) {
            // Filter pelatihan berdasarkan nama_pelatihan
            $reguler = reguler::where('nama_pelatihan', 'like', "%{$query}%")->get();
        } else {
            $reguler = reguler::all();
        }

        // Cek apakah ada pelatihan yang ditemukan
        $isEmpty = $reguler->isEmpty();

        // Return the view with the pelatihan details
        return view('user.training.reguler.index', compact('reguler', 'isEmpty'), [
            'title' => 'Detail Pelatihan',
        ]);
    }

    public function getProvinsi($negaraId)
    {
        try {
            $provinsiList = Provinsi::where('id_negara', $negaraId)->pluck('nama_provinsi', 'id')->toArray();

            return response()->json(['provinsi' => $provinsiList], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function getKabupaten($provinsiId)
    {
        try {
            $kabupatenList = kabupaten_kota::where('id_provinsi', $provinsiId)->pluck('nama_kabupaten_kota', 'id')->toArray();

            return response()->json(['kabupaten' => $kabupatenList], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createReguler($id)
    {
        $user = auth()->user(); // Get the authenticated user
        $reguler = reguler::findOrFail($id); // Retrieve pelatihan based on id
        $negara = Negara::all(); // Retrieve all countries

        return view('user.training.reguler.create', compact(
            'reguler',
            'user',
            'negara',

        ), [
            'title' => 'Daftar Pelatihan',
        ]);
    }

    public function storeReguler(Request $request)
    {
        $request->validate([
            'nama_peserta' => 'required|string|max:100',
            'email_peserta' => 'required|email|max:100',
            'no_hp' => 'required|numeric',
            'gender' => 'required',
            'rentang_usia' => 'required',
            'id_negara' => 'required|integer',
            'id_provinsi' => 'required|integer',
            'id_kabupaten' => 'required|integer',
            'nama_organisasi' => 'required|string|max:100',
            'organisasi' => 'required',
            'jabatan_peserta' => 'required|string|max:100',
            'informasi' => 'required',
            'pelatihan_relevan' => 'required|string|max:100',
            'harapan_pelatihan' => 'required',
        ], [
            'nama_peserta.required' => 'Kolom Nama peserta harus diisi.',
            'email_peserta.required' => 'Kolom Email peserta harus diisi.',
            'email_peserta.email' => 'Kolom Email peserta harus valid.',
            'no_hp.required' => 'Kolom Nomor HP harus diisi.',
            'no_hp.numeric' => 'Kolom ini harus diisi dengan angka.',
            'gender.required' => 'Kolom Jenis kelamin harus diisi.',
            'rentang_usia.required' => 'Kolom Rentang usia harus diisi.',
            'id_negara.required' => 'Kolom Negara harus diisi.',
            'id_provinsi.required' => 'Kolom Provinsi harus diisi.',
            'id_kabupaten.required' => 'Kolom Kabupaten harus diisi.',
            'organisasi.required' => 'Kolom Jenis Organisasi harus diisi.',
            'informasi.required' => 'Kolom Informasi harus diisi.',
            'harapan_pelatihan.required' => 'Kolom Harapan pelatihan harus diisi.',
            'pelatihan_relevan.required' => 'Kolom ini harus diisi.',
            'jabatan_peserta.required' => 'Kolom ini harus diisi.',
            // 'harapan_pelatihan.max' => 'Harapan pelatihan maksimal hanya 255 karakter.',
        ]);

        $pendaftaran = new peserta_pelatihan_reguler;
        $pendaftaran->id_reguler = $request->id_reguler;
        $pendaftaran->id_user = $request->id_user;
        $pendaftaran->nama_peserta = $request->nama_peserta;
        $pendaftaran->email_peserta = $request->email_peserta;
        $pendaftaran->no_hp = $request->no_hp;
        $pendaftaran->gender = $request->gender;
        $pendaftaran->rentang_usia = $request->rentang_usia;
        $pendaftaran->id_negara = $request->id_negara;
        $pendaftaran->id_provinsi = $request->id_provinsi;
        $pendaftaran->id_kabupaten = $request->id_kabupaten;
        $pendaftaran->id_kabupaten = $request->id_kabupaten;
        $pendaftaran->nama_organisasi = $request->nama_organisasi;
        $pendaftaran->organisasi = $request->organisasi;
        $pendaftaran->pelatihan_relevan = $request->pelatihan_relevan;
        $pendaftaran->harapan_pelatihan = $request->harapan_pelatihan;
        $pendaftaran->save();

        // Redirect dengan pesan sukses
        return redirect()->route('reguler.pelatihan')->with('success', 'Pendaftaran pelatihan berhasil.');
    }



    public function createPermintaan()
    {
        $mitra = mitra::all();
        $tema = tema::all();
        return view('user.training.permintaan.create', compact('mitra', 'tema'), [
            'title' => 'Pelatihan Permintaan',
        ]);
    }

    public function storePermintaan(Request $request)
    {
        // dd($request->all());
        // $id_user = $request->id_mitra;
        // dd($id_user);
        // Validasi data formulir jika diperlukan
        $request->validate(
            [
                'judul_pelatihan' => 'required',
                'id_mitra' => 'required',
                'id_tema' => 'required',
                'no_pic' => 'required|numeric',
                'tanggal_waktu_mulai' => 'required|date',
                'tanggal_waktu_selesai' => 'required|date|after:tanggal_waktu_mulai',
                'masalah' => 'required',
                'kebutuhan' => 'required',
                'materi' => 'required',
                'nama_peserta.*' => 'required',
                'email_peserta.*' => 'required|email',
                'jenis_kelamin.*' => 'required',
                'jabatan.*' => 'required',
                'tanggung_jawab.*' => 'required',
                'request_khusus' => 'required',
            ],
            [
                // 'id_mitra.required' => 'Nama mitra harus diisi.',
                'judul_pelatihan.required' => 'Judul pelatihan harus diisi.',
                'id_mitra.required' => 'Mitra harus dipilih.',
                'id_tema.required' => 'Tema pelatihan harus dipilih.',
                'no_pic.required' => 'Nomor PIC harus diisi.',
                'no_pic.numeric' => 'Nomor PIC harus diisi dengan angka.',
                'tanggal_waktu_mulai.required' => 'Tanggal mulai harus diisi.',
                'tanggal_waktu_mulai.date' => 'Format tanggal mulai tidak valid.',
                'tanggal_waktu_selesai.required' => 'Tanggal selesai harus diisi.',
                'tanggal_waktu_selesai.date' => 'Format tanggal selesai tidak valid.',
                'tanggal_waktu_selesai.after' => 'Tanggal selesai harus setelah tanggal dan waktu mulai.',
                'masalah.required' => 'Masalah yang dihadapi oleh lembaga harus diisi.',
                'kebutuhan.required' => 'Kebutuhan lembaga harus diisi.',
                'materi.required' => 'Materi dan topik pelatihan harus diisi.',
                'nama_peserta.*.required' => 'Field ini harus diisi.',
                'email_peserta.*.required' => 'Email peserta harus diisi.',
                'email_peserta.*.email' => 'Format email peserta tidak valid.',
                'jenis_kelamin.*.required' => 'Jenis kelamin peserta harus dipilih.',
                'jabatan.*.required' => 'Jabatan peserta di lembaga harus diisi.',
                'tanggung_jawab.*.required' => 'Tanggung jawab utama peserta harus diisi.',
                'request_khusus.required' => 'Request khusus harus diisi.',
            ]
        );
        // );

        // 'id_user' => Auth::user()->id,

        $id_user = Auth::user()->id;
        // Simpan data formulir ke dalam database
        $permintaan = new permintaan_pelatihan();
        $permintaan->id_user = $id_user; // Simpan ID pengguna
        $nama_mitra = $request->input('nama_mitra');
        $id_mitra = $request->input('id_mitra');

        // Jika nama mitra disediakan oleh pengguna
        if (!empty($nama_mitra)) {
            // Periksa apakah nama mitra sudah ada dalam database
            $mitra_exist = Mitra::where('nama_mitra', $nama_mitra)->first();

            // Jika mitra sudah ada, ambil ID mitra yang sesuai
            if ($mitra_exist) {
                $id_mitra = $mitra_exist->id_mitra;
            } else {
                // Jika mitra belum ada, simpan nama mitra baru dan ambil ID mitra yang baru saja disimpan
                $mitra_baru = new Mitra();
                $mitra_baru->nama_mitra = $nama_mitra;
                $mitra_baru->save();

                $id_mitra = $mitra_baru->id_mitra;
            }
        }

        // Set nilai ID mitra untuk entri permintaan pelatihan
        $permintaan->id_mitra = $id_mitra;
        $permintaan->judul_pelatihan = $request->input('judul_pelatihan');
        // $permintaan->jenis_pelatihan = $request->input('jenis_pelatihan');
        $permintaan->id_tema = $request->input('id_tema');
        $permintaan->no_pic = $request->input('no_pic');
        $permintaan->masalah = $request->input('masalah');
        $permintaan->kebutuhan = $request->input('kebutuhan');
        $permintaan->materi = $request->input('materi');
        $permintaan->tanggal_waktu_mulai = $request->input('tanggal_waktu_mulai');
        $permintaan->tanggal_waktu_selesai = $request->input('tanggal_waktu_selesai');
        $permintaan->request_khusus = $request->input('request_khusus');
        // dd($permintaan);
        $permintaan->save();


        // $assesmentDasar = new AssessmentDasar();
        // $assesmentDasar->masalah = $request->masalah;
        // $assesmentDasar->kebutuhan = $request->kebutuhan;
        // $assesmentDasar->materi = $request->materi;
        // $assesmentDasar->id_permintaan = $permintaan->id;
        // $assesmentDasar->save();

        // Proses penyimpanan data assesment dasar dinamis
        // foreach ($request->masalah as $key => $value) {
        //     $assessmentDasar = new AssesmentDasar();
        //     $assessmentDasar->masalah = $value;
        //     $assessmentDasar->kebutuhan = $request->kebutuhan[$key];
        //     $assessmentDasar->materi = $request->materi[$key];
        //     $assessmentDasar->id_permintaan = $permintaan->id;
        //     $assessmentDasar->save();
        // }

        // $assesmentPeserta = new AssessmentPeserta();
        // $assesmentPeserta->nama_peserta = $request->nama_peserta;
        // $assesmentPeserta->jenis_kelamin = $request->jenis_kelamin;
        // $assesmentPeserta->jabatan = $request->jabatan;
        // $assesmentPeserta->tanggung_jawab = $request->tanggung_jawab;
        // $assesmentPeserta->id_permintaan = $permintaan->id;
        // $assesmentPeserta->save();

        // Proses penyimpanan data asesment peserta dinamis
        foreach ($request->nama_peserta as $key => $value) {
            $assessmentPeserta = new AsessmentPeserta();
            $assessmentPeserta->nama_peserta = $value;
            $assessmentPeserta->email_peserta = $request->email_peserta[$key];
            ;
            $assessmentPeserta->jenis_kelamin = $request->jenis_kelamin[$key];
            $assessmentPeserta->jabatan = $request->jabatan[$key];
            $assessmentPeserta->tanggung_jawab = $request->tanggung_jawab[$key];
            $assessmentPeserta->id_permintaan = $permintaan->id;
            // dd($assessmentPeserta);
            $assessmentPeserta->save();
        }

        // Simpan data dinamis (assessment dasar) ke dalam database
        // $masalah = $request->input('masalah');
        // $kebutuhan = $request->input('kebutuhan');
        // $materi = $request->input('materi');

        // foreach ($masalah as $key => $value) {
        //     AssessmentDasar::create([
        //         'id_permintaan' => $permintaan->id, // Menghubungkan dengan data "form_data"
        //         'masalah' => $masalah[$key],
        //         'kebutuhan' => $kebutuhan[$key],
        //         'materi' => $materi[$key],
        //         // Tambahan kolom lain yang diperlukan
        //     ]);
        // }

        // Simpan data dinamis (assessment peserta) ke dalam database
        // $namaPeserta = $request->input('nama_peserta');
        // $jenisKelamin = $request->input('jenis_kelamin');
        // $jabatan = $request->input('jabatan');
        // $tanggungJawab = $request->input('tanggung_jawab');

        // foreach ($namaPeserta as $key => $value) {
        //     AssessmentPeserta::create([
        //         'id_permintaan' => $permintaan->id, // Menghubungkan dengan data "form_data"
        //         'nama_peserta' => $namaPeserta[$key],
        //         'jenis_kelamin' => $jenisKelamin[$key],
        //         'jabatan' => $jabatan[$key],
        //         'tanggung_jawab' => $tanggungJawab[$key],
        //         // Tambahan kolom lain yang diperlukan
        //     ]);
        // }

        return redirect()->to('peserta/permintaan/create')->with('success', 'Terima Kasih Telah Mendaftar Pelatihan Permintaan. Pelatihan Anda Segera Diproses');
    }

    public function createKonsultasi()
    {
        $negara = Negara::all();
        return view('user.training.konsultasi.create', compact(

            'negara',

        ), [
            'title' => 'Pelatihan Konsultasi',
        ]);
    }

    public function indexPelatihan()
    {
        $user = auth()->user();

        return view('user.training.pelatihan.index', compact('user'), [
            'title' => 'Pelatihan Saya',
        ]);
    }

    public function regulerList()
    {
        // dd(request()->all());
        $reguler = peserta_pelatihan_reguler::with('reguler')->where('id_user', auth()->user()->id)->get()->sortByDesc(function ($item) {
            return $item->reguler->tanggal_mulai; // Mengurutkan berdasarkan tanggal mulai
        });
        // dd($reguler);
        return view('user.training.pelatihan.reguler.index', [
            'title' => 'Pelatihan Saya',
            'reguler' => $reguler
        ]);
    }

    public function regulerListShow($nama_pelatihan)
    {
        // Decode parameter yang diterima dari URL
        $nama_pelatihan = urldecode($nama_pelatihan);

        // Cari data berdasarkan nama pelatihan
        $reguler = Reguler::where('nama_pelatihan', $nama_pelatihan)->firstOrFail();

        return view('user.training.pelatihan.reguler.show', [
            'title' => $reguler->nama_pelatihan,
            'reguler' => $reguler
        ]);
    }

    public function regulerListShowEvaluasi($id)
    {

        $reguler = reguler::findOrFail($id);
        $formEvaluasiReguler = form_evaluasi_reguler::with('reguler')->where('id_reguler', $id)->first();
        $formData = $formEvaluasiReguler->content;
        // dd($formEvaluasi);

        //cek user sudah pernah mengisi form
        // $user_id = Auth::id();
        // $hasFilledForm = evaluasi_pelatihan_reguler::where('id_reguler', $id_reguler)
        // ->where('id_user', $user_id)
        // ->exists();

        return view('user.training.pelatihan.reguler.evaluasi', compact('reguler', 'formEvaluasiReguler'), [
            'title' => 'Evaluasi ' . $reguler->nama_pelatihan,
            'formData' => $formData
        ]);
    }
    public function regulerListShowSurvey($id)
    {

        $reguler = reguler::findOrFail($id);
        $negara = negara::all();
        $formSurveyReguler = form_surveykepuasan_reguler::with('reguler')->where('id_reguler', $id)->first();
        $formData = $formSurveyReguler->content;
        // dd($formEvaluasi);

        //cek user sudah pernah mengisi form
        // $user_id = Auth::id();
        // $hasFilledForm = evaluasi_pelatihan_reguler::where('id_reguler', $id_reguler)
        // ->where('id_user', $user_id)
        // ->exists();

        return view('user.training.pelatihan.reguler.survey', compact('reguler', 'formSurveyReguler', 'negara'), [
            'title' => 'Survey Kepuasan ' . $reguler->nama_pelatihan,
            'formData' => $formData
        ]);
    }
    public function regulerListShowStudi($id)
    {

        $reguler = reguler::findOrFail($id);
        $formStudiReguler = form_studidampak_reguler::with('reguler')->where('id_reguler', $id)->first();
        $formData = $formStudiReguler->content;
        // dd($formEvaluasi);

        //cek user sudah pernah mengisi form
        // $user_id = Auth::id();
        // $hasFilledForm = evaluasi_pelatihan_reguler::where('id_reguler', $id_reguler)
        // ->where('id_user', $user_id)
        // ->exists();

        return view('user.training.pelatihan.reguler.studi', compact('reguler', 'formStudiReguler'), [
            'title' => 'Studi Dampak ' . $reguler->nama_pelatihan,
            'formData' => $formData
        ]);
    }


    public function permintaanShow()
    {
        // $user = auth()->user();
        $permintaans = peserta_pelatihan_permintaan::with(['permintaan_pelatihan'])->where('id_user', auth()->user()->id)->get();
        return view('user.training.pelatihan.permintaan', compact('permintaans'), [
            'title' => 'Pelatihan Saya',
            // 'pelatihans' => $permintaans
        ]);
    }

    public function konsultasiShow()
    {
        // $user = auth()->user();
        $konsultasis = peserta_pelatihan_konsultasi::with(['pelatihan_konsultasis'])->where('id_user', auth()->user()->id)->get();
        return view('user.training.pelatihan.konsultasi', compact('konsultasis'), [
            'title' => 'Pelatihan Saya',
            // 'pelatihans' => $konsultasis
        ]);
    }






}
