<?php

namespace App\Http\Controllers;

use App\Models\tema;
use App\Models\User;
use App\Models\mitra;
use App\Models\negara;
use App\Models\status;
use App\Models\reguler;
use App\Models\provinsi;
use App\Models\pelatihan;
use App\Models\konsultasi;
use App\Models\permintaan;
use App\Models\rentang_usia;
use Illuminate\Http\Request;
use App\Models\kabupaten_kota;
use App\Models\jenis_organisasi;
use Illuminate\Support\Facades\DB;
use App\Models\informasi_pelatihan;
use Hashids\Hashids;
use App\Models\konsultasi_pelatihan;
use App\Models\permintaan_pelatihan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\form_evaluasi_reguler;
use App\Models\hasil_evaluasi_reguler;
use Illuminate\Support\Facades\Storage;
use App\Models\form_evaluasi_konsultasi;
use App\Models\form_evaluasi_permintaan;
use App\Models\form_studidampak_reguler;
use App\Models\hasil_evaluasi_konsultasi;
use App\Models\hasil_evaluasi_permintaan;
use App\Models\hasil_studidampak_reguler;
use App\Models\peserta_pelatihan_reguler;
use App\Models\presensi_pelatihan_reguler;
use App\Models\form_studidampak_konsultasi;
use App\Models\form_studidampak_permintaan;
use App\Models\form_surveykepuasan_reguler;
use App\Models\assesment_peserta_permintaan;
use App\Models\hasil_studidampak_konsultasi;
use App\Models\hasil_studidampak_permintaan;
use App\Models\hasil_surveykepuasan_reguler;
use App\Models\peserta_pelatihan_konsultasi;
use App\Models\peserta_pelatihan_permintaan;
use App\Models\form_surveykepuasan_konsultasi;
use App\Models\form_surveykepuasan_permintaan;
use App\Models\hasil_surveykepuasan_konsultasi;
use App\Models\hasil_surveykepuasan_permintaan;
use Illuminate\Support\Facades\Log;


class TrainingController extends Controller
{
    /** Decode hash dan kembalikan int ID */
    private function decodeHash(string $hash)
    {
        $hashids = new Hashids(env('HASHIDS_SALT'), 10); // Sesuaikan salt dan min_length sesuai encode
        $decoded = $hashids->decode($hash);
        return $decoded[0] ?? abort(404);
    }

    public function index()
    {
        session(['show_tutorial' => true]);
        // Ambil data pelatihan
        $reguler = Reguler::paginate(3);
        $permintaan = permintaan_pelatihan::paginate(3);
        $konsultasi = konsultasi_pelatihan::paginate(3);

        // Untuk setiap pelatihan, ambil gambar terkait
        foreach ($reguler as $item) {
            $item->image = DB::table('reguler_images')
                ->where('id_reguler', $item->id_reguler)
                ->value('image_url'); // Ambil satu gambar (misal gambar pertama)
        }
        foreach ($permintaan as $item) {
            $item->image = DB::table('permintaan_images')
                ->where('id_permintaan', $item->id_permintaan)
                ->value('image_url'); // Ambil satu gambar (misal gambar pertama)
        }
        foreach ($konsultasi as $item) {
            $item->image = DB::table('konsultasi_images')
                ->where('id_konsultasi', $item->id_konsultasi)
                ->value('image_url'); // Ambil satu gambar (misal gambar pertama)
        }

        return view('user.training.index', compact('reguler', 'permintaan', 'konsultasi'), [
            'title' => 'Pelatihan',
        ]);
    }


    public function showReguler(string $hash)
    {
        $id = $this->decodeHash($hash);
        // Fetch the specific pelatihan by its ID
        $pelatihan = reguler::findOrFail($id);
        // dd($pelatihan);

        // Ambil data images langsung dari tabel reguler_images
        $imageNames = DB::table('reguler_images')
            ->where('id_reguler', $id)
            ->pluck('image_url');

        $imageUrls = [];

        foreach ($imageNames as $filename) {
            if ($filename) {
                $cachePath = public_path('storage/cache_drive/' . $filename);

                if (file_exists($cachePath)) {
                    $imageUrls[] = asset('storage/cache_drive/' . $filename);
                } else {
                    $imageUrls[] = route('file.show', ['filename' => $filename]);
                }
            } else {
                $imageUrls[] = asset('/images/stc.png');
            }
        }

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
        $query = $request->input('search');
        $status = $request->input('status'); // "buka" atau "tutup"
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $regulerQuery = Reguler::query();

        // Filter berdasarkan nama pelatihan
        if ($query) {
            $regulerQuery->where('nama_pelatihan', 'like', "%{$query}%");
        }

        // Filter berdasarkan status buka/tutup
        if ($status == 'buka') {
            $regulerQuery->where('tanggal_batas_pendaftaran', '>=', now());
        } elseif ($status == 'tutup') {
            $regulerQuery->where('tanggal_batas_pendaftaran', '<', now());
        }

        // Filter berdasarkan tanggal mulai dan akhir
        if ($startDate) {
            $regulerQuery->whereDate('tanggal_pendaftaran', '>=', $startDate);
        }

        if ($endDate) {
            $regulerQuery->whereDate('tanggal_batas_pendaftaran', '<=', $endDate);
        }

        $reguler = $regulerQuery->get();
        $isEmpty = $reguler->isEmpty();

        // Ambil gambar
        foreach ($reguler as $item) {
            $item->image = DB::table('reguler_images')
                ->where('id_reguler', $item->id_reguler)
                ->value('image_url');
        }

        return view('user.training.reguler.index', [
            'reguler' => $reguler,
            'isEmpty' => $isEmpty,
            'regulerPelatihan' => $reguler, // supaya variabel tetap konsisten di view
            'title' => 'Detail Pelatihan',
        ]);
    }


    public function getProvinsi($negaraId)
    {
        $provinsi = Provinsi::where('id_negara', $negaraId)->pluck('nama_provinsi', 'id');
        return response()->json(['provinsi' => $provinsi]);
    }

    public function getKabupaten($provinsiId)
    {
        $kabupaten = kabupaten_kota::where('id_provinsi', $provinsiId)->pluck('nama_kabupaten_kota', 'id');
        return response()->json(['kabupaten' => $kabupaten]);
    }


    public function getProvinsiSurvey($negaraId)
    {
        try {
            $provinsiList = Provinsi::where('id_negara', $negaraId)->pluck('nama_provinsi', 'id')->toArray();

            return response()->json(['provinsi' => $provinsiList], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function getKabupatenSurvey($provinsiId)
    {
        try {
            $kabupatenList = kabupaten_kota::where('id_provinsi', $provinsiId)->pluck('nama_kabupaten_kota', 'id')->toArray();

            return response()->json(['kabupaten' => $kabupatenList], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createReguler(string $hash, Request $request)
    {
        $id = $this->decodeHash($hash);
        $user = auth()->user();
        $reguler = reguler::findOrFail($id);
        $negara = Negara::all();
        $jumlahPeserta = $request->query('jumlah', 1); // Default ke 1 jika tidak ada parameter

        return view('user.training.reguler.create', compact(
            'reguler',
            'user',
            'negara',
            'jumlahPeserta'
        ), [
            'title' => 'Daftar Pelatihan',
        ]);
    }

    public function storeReguler(Request $request)
    {
        $request->validate([
            'peserta' => 'required|array|min:1',
            'peserta.*.nama_peserta' => 'required|string|max:100',
            'peserta.*.email_peserta' => 'required|email|max:100',
            'peserta.*.no_hp' => 'required|numeric',
            'peserta.*.gender' => 'required',
            'peserta.*.rentang_usia' => 'required',
            'peserta.*.id_negara' => 'required|integer|exists:negara,id',
            'peserta.*.id_provinsi' => 'required|integer|exists:provinsi,id',
            'peserta.*.id_kabupaten' => 'required|integer|exists:kabupaten_kota,id',
            'peserta.*.nama_organisasi' => 'required|string|max:100',
            'peserta.*.organisasi' => 'required',
            'peserta.*.jabatan_peserta' => 'required|string|max:100',
            'peserta.*.informasi' => 'required',
            'peserta.*.pelatihan_relevan' => 'required|string|max:100',
            'peserta.*.harapan_pelatihan' => 'required|string|max:255',
        ]);

        $akunBaru = []; // Menyimpan peserta yang dibuatkan akun

        foreach ($request->peserta as $peserta) {
            // Cek apakah user sudah ada berdasarkan email**
            $user = User::where('email', $peserta['email_peserta'])->first();

            // Jika belum ada, buat akun baru**
            if (!$user) {
                $defaultPassword = 'stc12345'; // Password default

                $user = User::create([
                    'name' => $peserta['nama_peserta'],
                    'email' => $peserta['email_peserta'],
                    'password' => Hash::make($defaultPassword),
                    'roles' => 'peserta',
                ]);

                // Simpan info akun yang baru dibuat
                $akunBaru[] = [
                    'email' => $peserta['email_peserta'],
                    'password' => $defaultPassword,
                ];
            }

            // **Simpan data peserta ke pelatihan**
            $peserta = peserta_pelatihan_reguler::create([
                'id_reguler' => $request->id_reguler,
                'id_user' => $user->id,
                'nama_peserta' => $peserta['nama_peserta'],
                'email_peserta' => $peserta['email_peserta'],
                'no_hp' => $peserta['no_hp'],
                'gender' => $peserta['gender'],
                'rentang_usia' => $peserta['rentang_usia'],
                'id_negara' => $peserta['id_negara'],
                'id_provinsi' => $peserta['id_provinsi'],
                'id_kabupaten' => $peserta['id_kabupaten'],
                'nama_organisasi' => $peserta['nama_organisasi'],
                'organisasi' => $peserta['organisasi'],
                'informasi' => $peserta['informasi'],
                'jabatan_peserta' => $peserta['jabatan_peserta'],
                'pelatihan_relevan' => $peserta['pelatihan_relevan'],
                'harapan_pelatihan' => $peserta['harapan_pelatihan'],
            ]);

            // **Simpan data peserta ke tabel status**
            status::create([
                'id_reguler' => $request->id_reguler,
                'id_peserta' => $peserta->id_peserta_reguler,
            ]);
        }



        // **Siapkan pesan sukses**
        $successMessage = 'Pendaftaran pelatihan berhasil.';

        if (!empty($akunBaru)) {
            $successMessage .= 'Akun telah dibuat untuk peserta berikut:';
            foreach ($akunBaru as $akun) {
                $successMessage .= "Email: {$akun['email']}, Password: {$akun['password']}";
            }

        }

        // **Redirect dengan pesan sukses**
        return redirect()->route('reguler.pelatihan')->with('success', $successMessage);
    }

    public function presensiReguler($id)
    {
        // Ambil model reguler dengan relasi lengkap
        $reguler = reguler::findOrFail($id);

        // Ambil presensi terkait dari tabel presensi_reguler
        $presensi = DB::table('presensi_reguler')
            ->where('id_reguler', $id)
            ->get();

        if (!$presensi) {
            abort(404, 'Presensi tidak ditemukan.');
        }

        return view('user.training.pelatihan.reguler.presensi', [
            'reguler' => $reguler,      // ← tetap model, ada hash_id
            'presensi' => $presensi,    // ← data tambahan
            'title' => 'Presensi Pelatihan Reguler',
        ]);
    }

    public function scanQRCode($id, $id_presensi)
    {
        // Ambil model reguler dengan relasi lengkap
        $reguler = reguler::findOrFail($id);

        // Ambil presensi terkait dari tabel presensi_reguler
        // Ambil data presensi yang dimaksud
        $presensi = DB::table('presensi_reguler')
            ->where('id_reguler', $id)
            ->where('id_presensi', $id_presensi)
            ->first();

        return view('user.training.pelatihan.reguler.scan', [
            'reguler' => $reguler,      // ← tetap model, ada hash_id
            'presensi' => $presensi,    // ← data tambahan
            'title' => 'Presensi Pelatihan Reguler',
        ]);
    }


    public function processQRScan(Request $request, $id)
    {
        try {
            $user = auth()->user();
            $qrData = $request->input('qr_data');
            $id_presensi_reguler = $request->input('id_presensi_reguler');

            // Log::info('Masuk proses QR scan, data:', ['qr_data' => $qrData, 'user_id' => $user->id]);

            $expectedQRData = route('scanQrPresensi', ['id' => $id, 'presensi' => $id_presensi_reguler]);
            if ($qrData !== $expectedQRData) {
                return response()->json(['status' => 'error', 'message' => 'QR Code tidak valid!']);
            }

            $peserta = peserta_pelatihan_reguler::where('id_user', $user->id)
                ->where('id_reguler', $id)
                ->first();

            if (!$peserta) {
                return response()->json(['status' => 'error', 'message' => 'Peserta tidak ditemukan.']);
            }

            $existing = presensi_pelatihan_reguler::where('id_reguler', $id)
                ->where('id_peserta', $peserta->id_peserta_reguler)
                ->where('id_presensi_reguler', $id_presensi_reguler) // ⬅️ TAMBAHKAN INI
                ->first();


            if ($existing) {
                return response()->json(['status' => 'error', 'message' => 'Presensi sudah dilakukan.']);
            }

            presensi_pelatihan_reguler::create([
                'id_reguler' => $id,
                'id_presensi_reguler' => $id_presensi_reguler,
                'id_peserta' => $peserta->id_peserta_reguler,
                'tanggal_presensi' => now(),
                'qr_code' => $qrData,
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Presensi gagal: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Presensi gagal. Cek server log.']);
        }
    }




    // Pelatihan Permintaan

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
        try {
            $request->validate([
                // ... aturan validasi ...
            ], [
                // ... pesan validasi ...
            ]);

            $id_user = Auth::user()->id;

            $permintaan = new permintaan();
            $permintaan->id_user = $id_user;

            $nama_mitra = $request->input('nama_mitra');
            $no_pic = $request->input('no_pic');
            $id_mitra = $request->input('id_mitra');

            if (!empty($nama_mitra)) {
                $mitra_exist = Mitra::where('nama_mitra', $nama_mitra)->first();
                if ($mitra_exist) {
                    $id_mitra = $mitra_exist->id_mitra;
                } else {
                    $mitra_baru = new Mitra();
                    $mitra_baru->nama_mitra = $nama_mitra;
                    $mitra_baru->kontak_pic = $no_pic;
                    $mitra_baru->save();
                    $id_mitra = $mitra_baru->id_mitra;
                }
            }

            $permintaan->id_mitra = $id_mitra;
            $permintaan->judul_pelatihan = $request->input('judul_pelatihan');
            $permintaan->id_tema = $request->input('id_tema');
            $permintaan->no_pic = $no_pic;
            $permintaan->masalah = $request->input('masalah');
            $permintaan->kebutuhan = $request->input('kebutuhan');
            $permintaan->materi = $request->input('materi');
            $permintaan->tanggal_mulai = $request->input('tanggal_waktu_mulai');
            $permintaan->tanggal_selesai = $request->input('tanggal_waktu_selesai');
            $permintaan->request_khusus = $request->input('request_khusus');
            $permintaan->save();

            foreach ($request->nama_peserta as $key => $value) {
                $assessmentPeserta = new assesment_peserta_permintaan();
                $assessmentPeserta->nama_peserta = $value;
                $assessmentPeserta->email_peserta = $request->email_peserta[$key] ?? null;
                $assessmentPeserta->jenis_kelamin = $request->jenis_kelamin[$key] ?? null;
                $assessmentPeserta->jabatan = $request->jabatan[$key] ?? null;
                $assessmentPeserta->tanggung_jawab = $request->tanggung_jawab[$key] ?? null;
                $assessmentPeserta->id_permintaan = $permintaan->id_permintaan;
                $assessmentPeserta->save();
            }

            return response()->json([
                'success' => true,
                'redirect_url' => route('reguler.pelatihan')
            ]);
        } catch (\Throwable $e) {
            \Log::error("Error saat menyimpan permintaan pelatihan: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.',
                'error' => $e->getMessage(), // tampilkan di frontend untuk debug
            ], 500);
        }
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

    public function storeKonsultasi(Request $request)
    {
        // dd($request->all());
        // Validasi formulir
        $request->validate(
            [
                'nama_organisasi' => 'required|string|max:255',
                'jenis_organisasi' => 'required',
                'email' => 'required|email:dns',
                'no_hp' => 'required|numeric',
                'id_kabupaten' => 'required',
                'id_provinsi' => 'required',
                'id_negara' => 'required',
                'deskripsi_kebutuhan' => 'required|string',
            ],
            [
                'nama_organisasi.required' => 'Nama Organisasi harus diisi.',
                'jenis_organisasi.required' => 'Jenis Organisasi harus dipilih.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Email harus diisi dengan email yang  valid.',
                'no_hp.numeric' => 'Nomor Telepon harus diisi dengan angka.',
                'deskripsi_kebutuhan.required' => 'Deskripsi Pelatihan harus diisi.',
            ]
        );
        $id_user = Auth::user()->id;
        // Simpan data formulir ke dalam database
        $konsultasi = new konsultasi();
        $konsultasi->id_user = $id_user; // Simpan ID pengguna
        $konsultasi->nama_organisasi = $request->input('nama_organisasi');
        $konsultasi->jenis_organisasi = $request->input('jenis_organisasi');
        $konsultasi->email = $request->input('email');
        $konsultasi->no_hp = $request->input('no_hp');
        $konsultasi->deskripsi_kebutuhan = $request->input('deskripsi_kebutuhan');
        $konsultasi->id_negara = $request->input('id_negara');
        $konsultasi->id_provinsi = $request->input('id_provinsi');
        $konsultasi->id_kabupaten = $request->input('id_kabupaten');
        $konsultasi->save();

        // Redirect atau berikan respons sesuai kebutuhan Anda
        return redirect()->route('reguler.pelatihan')->with('success', 'Terima Kasih Telah Mendaftar Pelatihan Konsultasi. Pelatihan Anda Segera Diproses');
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
        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }
        // dd(request()->all());
        $reguler = peserta_pelatihan_reguler::with('reguler', 'status')->where('id_user', auth()->user()->id)->get()->sortByDesc(function ($item) {
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
        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }
        // Decode parameter yang diterima dari URL
        $nama_pelatihan = urldecode($nama_pelatihan);

        // Cari data berdasarkan nama pelatihan
        $reguler = Reguler::with('fasilitators')->where('nama_pelatihan', $nama_pelatihan)->firstOrFail();

        return view('user.training.pelatihan.reguler.show', [
            'title' => $reguler->nama_pelatihan,
            'reguler' => $reguler
        ]);
    }

    public function regulerListShowEvaluasi(string $hash)
    {
        $id = $this->decodeHash($hash);
        $reguler = reguler::findOrFail($id);
        $formEvaluasiReguler = form_evaluasi_reguler::where('id_reguler', $id)->first();
        $formDataRaw = $formEvaluasiReguler ? json_decode($formEvaluasiReguler->content, true) : null;

        // Grouping formData berdasarkan 'group'
        $groupedFormData = null;
        if (is_array($formDataRaw)) {
            $groupedFormData = collect($formDataRaw)->groupBy('group')->toArray();
        }

        if (!auth()->check()) {
            return view('user.training.pelatihan.reguler.evaluasi', [
                'reguler' => $reguler,
                'formEvaluasiReguler' => $formEvaluasiReguler,
                'formData' => $groupedFormData, // Kirim data sudah dikelompokkan
                'title' => 'Evaluasi ' . $reguler->nama_pelatihan,
                'showLoginModal' => true,
                'sudahMengisi' => false,
                'peserta' => null,
                'pesertaId' => null
            ]);
        }

        $peserta = peserta_pelatihan_reguler::where('id_user', auth()->id())->first();
        $pesertaId = $peserta?->id_peserta_reguler;

        $sudahMengisi = hasil_evaluasi_reguler::where([
            'id_pelatihan_reguler' => $reguler->id_reguler,
            'id_peserta' => $pesertaId
        ])->exists();

        return view('user.training.pelatihan.reguler.evaluasi', compact(
            'reguler',
            'formEvaluasiReguler',
            'sudahMengisi',
            'peserta',
            'pesertaId'
        ), [
            'title' => 'Evaluasi ' . $reguler->nama_pelatihan,
            'formData' => $groupedFormData,
            'showLoginModal' => false
        ]);
    }


    public function regulerListStoreEvaluasi(Request $request)
    {

        // Validasi input
        $request->validate([
            'id_reguler' => 'required|integer',
            'id_peserta' => 'required|integer',
            'data_respons' => 'required|string',
        ]);

        // Simpan data ke dalam database
        $evaluasi = new hasil_evaluasi_reguler(); // Sesuaikan dengan model Anda
        $evaluasi->id_pelatihan_reguler = $request->id_reguler;
        $evaluasi->id_peserta = $request->id_peserta;
        $evaluasi->data_respons = $request->data_respons;
        $evaluasi->save();


        // Ambil nama pelatihan berdasarkan id_reguler
        $reguler = reguler::find($request->id_reguler); // Sesuaikan dengan model Anda


        if (!$reguler) {
            return redirect()->back()->with('error', 'Pelatihan tidak ditemukan.');
        }

        // Redirect ke halaman pelatihan berdasarkan nama pelatihan
        return redirect()->route('reguler.pelatihan.list', ['nama_pelatihan' => $reguler->nama_pelatihan])
            ->with('success', 'Evaluasi berhasil disimpan!');
    }

    public function regulerListShowSurvey($id)
    {
        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }
        $reguler = reguler::findOrFail($id);
        $negara = negara::all();
        $formSurveyReguler = form_surveykepuasan_reguler::with('reguler')->where('id_reguler', $id)->first();
        $formData = $formSurveyReguler ? json_decode($formSurveyReguler->content, true) : null;

        // Cek apakah user sudah mengisi evaluasi
        $peserta = peserta_pelatihan_reguler::with('reguler')
            ->where('id_user', auth()->user()->id)
            ->first();

        $pesertaId = $peserta ? $peserta->id_peserta_reguler : null; // Cegah error jika null

        $sudahMengisi = hasil_surveykepuasan_reguler::with('peserta')->where('id_pelatihan_reguler', $reguler->id_reguler)
            ->where('id_peserta', $pesertaId)
            ->exists();

        return view('user.training.pelatihan.reguler.survey', compact('reguler', 'formSurveyReguler', 'negara', 'sudahMengisi', 'peserta'), [
            'title' => 'Survey Kepuasan ' . $reguler->nama_pelatihan,
            'formData' => $formData
        ]);
    }

    public function regulerListStoreSurvey(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_reguler' => 'required|integer',
            'id_peserta' => 'required|integer',
            'data_respons' => 'required|string',
        ]);

        // Simpan data ke dalam database
        $surveykepuasan = new hasil_surveykepuasan_reguler(); // Sesuaikan dengan model Anda
        $surveykepuasan->id_pelatihan_reguler = $request->id_reguler;
        $surveykepuasan->id_peserta = $request->id_peserta;
        $surveykepuasan->data_respons = $request->data_respons;
        $surveykepuasan->save();


        // Ambil nama pelatihan berdasarkan id_reguler
        $reguler = reguler::find($request->id_reguler); // Sesuaikan dengan model Anda


        if (!$reguler) {
            return redirect()->back()->with('error', 'Pelatihan tidak ditemukan.');
        }

        // Redirect ke halaman pelatihan berdasarkan nama pelatihan
        return redirect()->route('reguler.pelatihan.list', ['nama_pelatihan' => $reguler->nama_pelatihan])
            ->with('success', 'Evaluasi berhasil disimpan!');
    }

    public function regulerListShowStudi($id)
    {

        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }

        $reguler = reguler::findOrFail($id);
        $formStudiReguler = form_studidampak_reguler::with('reguler')->where('id_reguler', $id)->first();
        $formData = $formStudiReguler ? json_decode($formStudiReguler->content, true) : null;
        // dd($formEvaluasi);
        $peserta = peserta_pelatihan_reguler::with('reguler')
            ->where('id_user', auth()->user()->id)
            ->first();

        $pesertaId = $peserta ? $peserta->id_peserta_reguler : null; // Cegah error jika null

        //cek user sudah pernah mengisi form
        $sudahMengisi = hasil_studidampak_reguler::with('peserta')->where('id_pelatihan_reguler', $reguler->id_reguler)
            ->where('id_peserta', $pesertaId)
            ->exists();

        return view('user.training.pelatihan.reguler.studi', compact('reguler', 'formStudiReguler', 'sudahMengisi', 'peserta'), [
            'title' => 'Studi Dampak ' . $reguler->nama_pelatihan,
            'formData' => $formData
        ]);
    }

    public function regulerListStoreStudi(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_reguler' => 'required|integer',
            'id_peserta' => 'required|integer',
            'data_respons' => 'required|string',
        ]);

        // Simpan data ke dalam database
        $studidampak = new hasil_studidampak_reguler(); // Sesuaikan dengan model Anda
        $studidampak->id_pelatihan_reguler = $request->id_reguler;
        $studidampak->id_peserta = $request->id_peserta;
        $studidampak->data_respons = $request->data_respons;
        $studidampak->save();


        // Ambil nama pelatihan berdasarkan id_reguler
        $reguler = reguler::find($request->id_reguler); // Sesuaikan dengan model Anda


        if (!$reguler) {
            return redirect()->back()->with('error', 'Pelatihan tidak ditemukan.');
        }

        // Redirect ke halaman pelatihan berdasarkan nama pelatihan
        return redirect()->route('reguler.pelatihan.list', ['nama_pelatihan' => $reguler->nama_pelatihan])
            ->with('success', 'Form Studi dampak berhasil disimpan!');
    }

    public function regulerListShowMateri($id)
    {
        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }

        $reguler = Reguler::findOrFail($id);

        $records = DB::table('reguler_files')
            ->where('id_reguler', $id)
            ->get(['file_path', 'file_url', 'file_name']);

        // Ambil semua file dari reguler_files yang sesuai dengan id_reguler
        $tree = [];
        foreach ($records as $r) {
            $parts = preg_split('/[\/\\\\]/', $r->file_path);   // session plan\BAB I …
            $cursor = &$tree;
            foreach ($parts as $idx => $part) {
                if ($idx === count($parts) - 1) {
                    // file
                    $cursor[$part] = [
                        'file_name' => $r->file_name,
                        'file_url' => $r->file_url,
                    ];
                } else {
                    // folder
                    $cursor[$part] ??= [];
                    $cursor = &$cursor[$part];
                }
            }
        }


        return view('user.training.pelatihan.reguler.materi', compact('reguler', 'tree'), [
            'title' => 'Materi Pelatihan ' . $reguler->nama_pelatihan,
        ]);
    }


    public function regulerListShowSertifikat($id)
    {

        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }

        $reguler = reguler::findOrFail($id);
        // Ambil sertifikat berdasarkan user yang login
        $files = DB::table('reguler_sertifikat')
            ->join('peserta_pelatihan_reguler', 'reguler_sertifikat.id_peserta', '=', 'peserta_pelatihan_reguler.id_peserta_reguler')
            ->where('peserta_pelatihan_reguler.id_user', auth()->user()->id)
            ->where('peserta_pelatihan_reguler.id_reguler', $id) // filter berdasarkan pelatihan juga
            ->select('reguler_sertifikat.file_url')
            ->get();

        return view('user.training.pelatihan.reguler.sertifikat', compact('reguler', 'files'), [
            'title' => 'Sertifikat Pelatihan ' . $reguler->nama_pelatihan,
            // 'formData' => $formData
        ]);
    }

    // permintaan

    public function permintaanShow()
    {
        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }
        // return 'true';
        // $user = auth()->user();
        $permintaans = peserta_pelatihan_permintaan::with(['permintaan_pelatihan'])->where('id_user', auth()->user()->id)->paginate(4);
        // dd($permintaans);
        return view('user.training.pelatihan.permintaan.permintaan', compact('permintaans'), [
            'title' => 'Pelatihan Saya',
            // 'pelatihans' => $permintaans
        ]);
    }

    public function permintaanListShow($nama_pelatihan)
    {
        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }
        // return 'true';
        // Decode parameter yang diterima dari URL
        $nama_pelatihan = urldecode($nama_pelatihan);

        // Cari data berdasarkan nama pelatihan
        $permintaan = permintaan_pelatihan::with('fasilitators')->where('nama_pelatihan', $nama_pelatihan)->firstOrFail();

        return view('user.training.pelatihan.permintaan.show', [
            'title' => $permintaan->nama_pelatihan,
            'permintaan' => $permintaan
        ]);
    }

    public function permintaanListShowEvaluasi($id)
    {
        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }
        $permintaan = permintaan_pelatihan::findOrFail($id);
        // return 'true';
        // dd($permintaan);
        $formEvaluasiPermintaan = form_evaluasi_permintaan::with('permintaan_pelatihan')->where('id_pelatihan_permintaan', $id)->first();
        $peserta = peserta_pelatihan_permintaan::with('permintaan_pelatihan')
            ->where('id_user', auth()->user()->id)
            ->first();


        $pesertaId = $peserta ? $peserta->id_peserta : null; // Cegah error jika null
        // dd($pesertaId);

        // Debugging untuk memastikan peserta ditemukan
        if (!$peserta) {
            dd("Peserta tidak ditemukan untuk id_user: " . auth()->user()->id);
        }

        // Cek apakah form tersedia dan ubah content JSON menjadi array
        $formData = $formEvaluasiPermintaan ? json_decode($formEvaluasiPermintaan->content, true) : null;
        // Cek apakah user sudah mengisi evaluasi

        $sudahMengisi = hasil_evaluasi_permintaan::with('peserta')->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)
            ->where('id_peserta', $pesertaId)
            ->exists();
        // dd($sudahMengisi);
        return view('user.training.pelatihan.permintaan.evaluasi', compact('permintaan', 'formEvaluasiPermintaan', 'sudahMengisi', 'peserta', 'pesertaId'), [
            'title' => 'Evaluasi ' . $permintaan->nama_pelatihan,
            'formData' => $formData
        ]);
    }

    public function permintaanListStoreEvaluasi(Request $request)
    {

        // Validasi input
        $request->validate([
            'id_pelatihan_permintaan' => 'required|integer',
            'id_peserta' => 'required|integer',
            'data_respons' => 'required|string',
        ]);

        // Simpan data ke dalam database
        $evaluasi = new hasil_evaluasi_permintaan(); // Sesuaikan dengan model Anda
        $evaluasi->id_pelatihan_permintaan = $request->id_pelatihan_permintaan;
        $evaluasi->id_peserta = $request->id_peserta;
        $evaluasi->data_respons = $request->data_respons;
        $evaluasi->save();


        // Ambil nama pelatihan berdasarkan id_pelatihan_permintaan
        $permintaan = permintaan_pelatihan::find($request->id_pelatihan_permintaan); // Sesuaikan dengan model Anda


        if (!$permintaan) {
            return redirect()->back()->with('error', 'Pelatihan tidak ditemukan.');
        }

        // Redirect ke halaman pelatihan berdasarkan nama pelatihan
        return redirect()->route('permintaan.pelatihan.list', ['nama_pelatihan' => $permintaan->nama_pelatihan])
            ->with('success', 'Evaluasi berhasil disimpan!');
    }

    public function permintaanListShowSurvey($id)
    {
        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }
        $permintaan = permintaan_pelatihan::findOrFail($id);
        $negara = negara::all();
        $formSurveyPermintaan = form_surveykepuasan_permintaan::with('permintaan_pelatihan')->where('id_pelatihan_permintaan', $id)->first();
        $formData = $formSurveyPermintaan ? json_decode($formSurveyPermintaan->content, true) : null;

        // Cek apakah user sudah mengisi evaluasi
        $peserta = peserta_pelatihan_permintaan::with('permintaan_pelatihan')
            ->where('id_user', auth()->user()->id)
            ->first();

        $pesertaId = $peserta ? $peserta->id_peserta : null; // Cegah error jika null

        $sudahMengisi = hasil_surveykepuasan_permintaan::with('peserta')->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)
            ->where('id_peserta', $pesertaId)
            ->exists();

        return view('user.training.pelatihan.permintaan.survey', compact('permintaan', 'formSurveyPermintaan', 'negara', 'sudahMengisi', 'peserta'), [
            'title' => 'Survey Kepuasan ' . $permintaan->nama_pelatihan,
            'formData' => $formData
        ]);
    }

    public function permintaanListStoreSurvey(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_pelatihan_permintaan' => 'required|integer',
            'id_peserta' => 'required|integer',
            'data_respons' => 'required|string',
        ]);

        // Simpan data ke dalam database
        $surveykepuasan = new hasil_surveykepuasan_permintaan(); // Sesuaikan dengan model Anda
        $surveykepuasan->id_pelatihan_permintaan = $request->id_pelatihan_permintaan;
        $surveykepuasan->id_peserta = $request->id_peserta;
        $surveykepuasan->data_respons = $request->data_respons;
        $surveykepuasan->save();


        // Ambil nama pelatihan berdasarkan id_pelatihan_permintaan
        $permintaan = permintaan_pelatihan::find($request->id_pelatihan_permintaan); // Sesuaikan dengan model Anda


        if (!$permintaan) {
            return redirect()->back()->with('error', 'Pelatihan tidak ditemukan.');
        }

        // Redirect ke halaman pelatihan berdasarkan nama pelatihan
        return redirect()->route('permintaan.pelatihan.list', ['nama_pelatihan' => $permintaan->nama_pelatihan])
            ->with('success', 'Form Survey Kepuasan berhasil disimpan!');
    }

    public function permintaanListShowStudi($id)
    {
        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }
        // return 'true';
        $permintaan = permintaan_pelatihan::findOrFail($id);
        $formStudiPermintaan = form_studidampak_permintaan::with('permintaan_pelatihan')->where('id_pelatihan_permintaan', $id)->first();
        $formData = $formStudiPermintaan ? json_decode($formStudiPermintaan->content, true) : null;
        // dd($formEvaluasi);
        $peserta = peserta_pelatihan_permintaan::with('permintaan_pelatihan')
            ->where('id_user', auth()->user()->id)
            ->first();


        $pesertaId = $peserta ? $peserta->id_peserta : null; // Cegah error jika null
        // dd($pesertaId);

        //cek user sudah pernah mengisi form
        $sudahMengisi = hasil_studidampak_permintaan::with('peserta')->where('id_pelatihan_permintaan', $permintaan->id_pelatihan_permintaan)
            ->where('id_peserta', $pesertaId)
            ->exists();

        return view('user.training.pelatihan.permintaan.studi', compact('permintaan', 'formStudiPermintaan', 'sudahMengisi', 'peserta'), [
            'title' => 'Studi Dampak ' . $permintaan->nama_pelatihan,
            'formData' => $formData
        ]);
    }

    public function permintaanListStoreStudi(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_pelatihan_permintaan' => 'required|integer',
            'id_peserta' => 'required|integer',
            'data_respons' => 'required|string',
        ]);

        // Simpan data ke dalam database
        $studidampak = new hasil_studidampak_permintaan(); // Sesuaikan dengan model Anda
        $studidampak->id_pelatihan_permintaan = $request->id_pelatihan_permintaan;
        $studidampak->id_peserta = $request->id_peserta;
        $studidampak->data_respons = $request->data_respons;
        $studidampak->save();


        // Ambil nama pelatihan berdasarkan id_pelatihan_permintaan
        $permintaan = permintaan_pelatihan::find($request->id_pelatihan_permintaan); // Sesuaikan dengan model Anda


        if (!$permintaan) {
            return redirect()->back()->with('error', 'Pelatihan tidak ditemukan.');
        }

        // Redirect ke halaman pelatihan berdasarkan nama pelatihan
        return redirect()->route('permintaan.pelatihan.list', ['nama_pelatihan' => $permintaan->nama_pelatihan])
            ->with('success', 'Form Studi dampak berhasil disimpan!');
    }

    public function permintaanListShowMateri($id)
    {

        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }

        // Ambil data permintaan berdasarkan kolom id_pelatihan_permintaan
        $permintaan = permintaan_pelatihan::where('id_pelatihan_permintaan', $id)->firstOrFail();

        // Ambil semua file dari permintaan_files yang sesuai dengan id_permintaan
        // $files = DB::table('permintaan_files')
        //     ->where('id_permintaan', $id)
        //     ->whereNotNull('file_url')
        //     ->paginate(5, ['file_url', 'file_name', 'file_path']);

        // // Bangun struktur folder-file (tree) dari file_path
        // $tree = [];

        // foreach ($files as $file) {
        //     $parts = preg_split('/[\/\\\\]/', $file->file_path); // split dengan slash / atau \
        //     $current = &$tree;

        //     foreach ($parts as $index => $part) {
        //         if ($index === count($parts) - 1) {
        //             // ini file, simpan data file (nama & url)
        //             $current[$part] = [
        //                 'file_name' => $file->file_name,
        //                 'file_url' => $file->file_url,
        //             ];
        //         } else {
        //             // ini folder, buat key jika belum ada
        //             if (!isset($current[$part])) {
        //                 $current[$part] = [];
        //             }
        //             $current = &$current[$part];
        //         }
        //     }
        // }

        $records = DB::table('permintaan_files')
            ->where('id_permintaan', $id)
            ->get(['file_path', 'file_url', 'file_name']);

        $tree = [];
        foreach ($records as $r) {
            $parts = preg_split('/[\/\\\\]/', $r->file_path);   // session plan\BAB I …
            $cursor = &$tree;
            foreach ($parts as $idx => $part) {
                if ($idx === count($parts) - 1) {
                    // file
                    $cursor[$part] = [
                        'file_name' => $r->file_name,
                        'file_url' => $r->file_url,
                    ];
                } else {
                    // folder
                    $cursor[$part] ??= [];
                    $cursor = &$cursor[$part];
                }
            }
        }


        return view('user.training.pelatihan.permintaan.materi', compact('permintaan', 'tree'), [
            'title' => 'Materi Pelatihan ' . $permintaan->nama_pelatihan,
        ]);
    }

    public function permintaanListShowSertifikat($id)
    {
        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }

        $permintaan = permintaan_pelatihan::findOrFail($id);
        $files = DB::table('permintaan_sertifikat')
            ->join('peserta_pelatihan_permintaan', 'permintaan_sertifikat.id_peserta', '=', 'peserta_pelatihan_permintaan.id_peserta')
            ->where('peserta_pelatihan_permintaan.id_user', auth()->user()->id)
            ->where('peserta_pelatihan_permintaan.id_pelatihan_permintaan', $id) // filter berdasarkan pelatihan juga
            ->select('permintaan_sertifikat.file_url')
            ->get();

        return view('user.training.pelatihan.permintaan.sertifikat', compact('permintaan', 'files'), [
            'title' => 'Sertifikat ' . $permintaan->nama_pelatihan,
            // 'formData' => $formData
        ]);
    }


    // konsultasi

    public function konsultasiShow()
    {
        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }
        // Ambil data pelatihan konsultasi yang telah didaftarkan oleh user dengan pagination
        $konsultasi = peserta_pelatihan_konsultasi::with('pelatihan_konsultasi')
            ->where('id_user', auth()->user()->id)
            ->paginate(4);

        return view('user.training.pelatihan.konsultasi.konsultasi', compact('konsultasi'))->with([
            'title' => 'Pelatihan Saya',
        ]);
    }


    public function konsultasiListShow($nama_pelatihan)
    {
        // Decode parameter yang diterima dari URL
        $nama_pelatihan = urldecode($nama_pelatihan);

        // Cari data berdasarkan nama pelatihan
        $konsultasi = konsultasi_pelatihan::with('fasilitators')->where('nama_pelatihan', $nama_pelatihan)->firstOrFail();
        // dd($konsultasi);

        return view('user.training.pelatihan.konsultasi.show', compact('konsultasi'), [
            'title' => $konsultasi->nama_pelatihan,
            'konsultasi' => $konsultasi
        ]);
    }

    public function konsultasiListShowEvaluasi($id)
    {
        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }
        $konsultasi = konsultasi_pelatihan::findOrFail($id);
        // dd($konsultasi);
        $formEvaluasiKonsultasi = form_evaluasi_konsultasi::with('konsultasi_pelatihan')->where('id_pelatihan_konsultasi', $id)->first();
        $peserta = peserta_pelatihan_konsultasi::with('pelatihan_konsultasi')
            ->where('id_user', auth()->user()->id)
            ->first();

        $pesertaId = $peserta ? $peserta->id_peserta : null; // Cegah error jika null

        // dd($peserta);
        // Debugging untuk memastikan peserta ditemukan
        if (!$peserta) {
            dd("Peserta tidak ditemukan untuk id_user: " . auth()->user()->id);
        }

        // Cek apakah form tersedia dan ubah content JSON menjadi array
        $formData = $formEvaluasiKonsultasi ? json_decode($formEvaluasiKonsultasi->content, true) : null;
        // Cek apakah user sudah mengisi evaluasi

        $sudahMengisi = hasil_evaluasi_konsultasi::with('peserta')->where('id_pelatihan_konsultasi', $konsultasi->id_konsultasi)
            ->where('id_peserta', $pesertaId)
            ->exists();
        // dd($sudahMengisi);
        return view('user.training.pelatihan.konsultasi.evaluasi', compact('konsultasi', 'formEvaluasiKonsultasi', 'sudahMengisi', 'peserta', 'pesertaId'), [
            'title' => 'Evaluasi ' . $konsultasi->nama_pelatihan,
            'formData' => $formData
        ]);
    }

    public function konsultasiListStoreEvaluasi(Request $request)
    {

        // Validasi input
        $request->validate([
            'id_pelatihan_konsultasi' => 'required|integer',
            'id_peserta' => 'required|integer',
            'data_respons' => 'required|string',
        ]);

        // Simpan data ke dalam database
        $evaluasi = new hasil_evaluasi_konsultasi(); // Sesuaikan dengan model Anda
        $evaluasi->id_pelatihan_konsultasi = $request->id_pelatihan_konsultasi;
        $evaluasi->id_peserta = $request->id_peserta;
        $evaluasi->data_respons = $request->data_respons;
        $evaluasi->save();


        // Ambil nama pelatihan berdasarkan id_pelatihan_konsultasi
        $konsultasi = konsultasi_pelatihan::find($request->id_pelatihan_konsultasi); // Sesuaikan dengan model Anda


        if (!$konsultasi) {
            return redirect()->back()->with('error', 'Pelatihan tidak ditemukan.');
        }

        // Redirect ke halaman pelatihan berdasarkan nama pelatihan
        return redirect()->route('konsultasi.pelatihan.list', ['nama_pelatihan' => $konsultasi->nama_pelatihan])
            ->with('success', 'Evaluasi berhasil disimpan!');
    }

    public function konsultasiListShowSurvey($id)
    {
        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }
        $konsultasi = konsultasi_pelatihan::findOrFail($id);
        $negara = negara::all();
        $formSurveyKonsultasi = form_surveykepuasan_konsultasi::with('konsultasi_pelatihan')->where('id_pelatihan_konsultasi', $id)->first();
        $formData = $formSurveyKonsultasi ? json_decode($formSurveyKonsultasi->content, true) : null;

        // Cek apakah user sudah mengisi evaluasi
        $peserta = peserta_pelatihan_konsultasi::with('pelatihan_konsultasi')
            ->where('id_user', auth()->user()->id)
            ->first();

        $pesertaId = $peserta ? $peserta->id_peserta : null; // Cegah error jika null

        $sudahMengisi = hasil_surveykepuasan_konsultasi::with('peserta')->where('id_pelatihan_konsultasi', $konsultasi->id_pelatihan_konsultasi)
            ->where('id_peserta', $pesertaId)
            ->exists();

        return view('user.training.pelatihan.konsultasi.survey', compact('konsultasi', 'formSurveyKonsultasi', 'negara', 'sudahMengisi', 'peserta'), [
            'title' => 'Survey Kepuasan ' . $konsultasi->nama_pelatihan,
            'formData' => $formData
        ]);
    }

    public function konsultasiListStoreSurvey(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_pelatihan_konsultasi' => 'required|integer',
            'id_peserta' => 'required|integer',
            'data_respons' => 'required|string',
        ]);

        // Simpan data ke dalam database
        $surveykepuasan = new hasil_surveykepuasan_konsultasi(); // Sesuaikan dengan model Anda
        $surveykepuasan->id_pelatihan_konsultasi = $request->id_pelatihan_konsultasi;
        $surveykepuasan->id_peserta = $request->id_peserta;
        $surveykepuasan->data_respons = $request->data_respons;
        $surveykepuasan->save();


        // Ambil nama pelatihan berdasarkan id_pelatihan_konsultasi
        $konsultasi = konsultasi_pelatihan::find($request->id_pelatihan_konsultasi); // Sesuaikan dengan model Anda


        if (!$konsultasi) {
            return redirect()->back()->with('error', 'Pelatihan tidak ditemukan.');
        }

        // Redirect ke halaman pelatihan berdasarkan nama pelatihan
        return redirect()->route('konsultasi.pelatihan.list', ['nama_pelatihan' => $konsultasi->nama_pelatihan])
            ->with('success', 'Evaluasi berhasil disimpan!');
    }

    public function konsultasiListShowStudi($id)
    {
        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }
        $konsultasi = konsultasi_pelatihan::findOrFail($id);
        $formStudiKonsultasi = form_studidampak_konsultasi::with('konsultasi_pelatihan')->where('id_pelatihan_konsultasi', $id)->first();
        $formData = $formStudiKonsultasi ? json_decode($formStudiKonsultasi->content, true) : null;
        // dd($formEvaluasi);
        $peserta = peserta_pelatihan_konsultasi::with('pelatihan_konsultasi')
            ->where('id_user', auth()->user()->id)
            ->first();

        $pesertaId = $peserta ? $peserta->id_peserta : null; // Cegah error jika null

        //cek user sudah pernah mengisi form
        $sudahMengisi = hasil_studidampak_konsultasi::with('peserta')->where('id_pelatihan_konsultasi', $konsultasi->id_pelatihan_konsultasi)
            ->where('id_peserta', $pesertaId)
            ->exists();

        return view('user.training.pelatihan.konsultasi.studi', compact('konsultasi', 'formStudiKonsultasi', 'sudahMengisi', 'peserta'), [
            'title' => 'Studi Dampak ' . $konsultasi->nama_pelatihan,
            'formData' => $formData
        ]);
    }

    public function konsultasiListStoreStudi(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_pelatihan_konsultasi' => 'required|integer',
            'id_peserta' => 'required|integer',
            'data_respons' => 'required|string',
        ]);

        // Simpan data ke dalam database
        $studidampak = new hasil_studidampak_konsultasi(); // Sesuaikan dengan model Anda
        $studidampak->id_pelatihan_konsultasi = $request->id_pelatihan_konsultasi;
        $studidampak->id_peserta = $request->id_peserta;
        $studidampak->data_respons = $request->data_respons;
        $studidampak->save();


        // Ambil nama pelatihan berdasarkan id_pelatihan_konsultasi
        $konsultasi = konsultasi_pelatihan::find($request->id_pelatihan_konsultasi); // Sesuaikan dengan model Anda


        if (!$konsultasi) {
            return redirect()->back()->with('error', 'Pelatihan tidak ditemukan.');
        }

        // Redirect ke halaman pelatihan berdasarkan nama pelatihan
        return redirect()->route('konsultasi.pelatihan.list', ['nama_pelatihan' => $konsultasi->nama_pelatihan])
            ->with('success', 'Form Studi dampak berhasil disimpan!');
    }

    public function konsultasiListShowMateri($id)
    {

        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }

        $konsultasi = konsultasi_pelatihan::findOrFail($id);
        $konsultasiId = konsultasi_pelatihan::where('id_konsultasi', $id)->get();
        $files = [];

        foreach ($konsultasiId as $item) {
            $filesUrl = DB::table('konsultasi_files')
                ->where('id_konsultasi', $item->id_konsultasi)
                ->value('file_url');

            $files[] = (object) ['file_url' => $filesUrl]; // Ganti "image" menjadi "file_url"
        }

        return view('user.training.pelatihan.konsultasi.materi', compact('konsultasi', 'files'), [
            'title' => 'Studi Dampak Pelatihan ' . $konsultasi->nama_pelatihan,
        ]);
    }

    public function konsultasiListShowSertifikat($id)
    {

        if (!auth()->check()) {
            return redirect()->route('beranda')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }

        $konsultasi = konsultasi_pelatihan::findOrFail($id);

        $files = DB::table('konsultasi_sertifikat')
            ->join('peserta_pelatihan_konsultasi', 'konsultasi_sertifikat.id_peserta', '=', 'peserta_pelatihan_konsultasi.id_peserta')
            ->where('peserta_pelatihan_konsultasi.id_user', auth()->user()->id)
            ->where('peserta_pelatihan_konsultasi.id_pelatihan_konsultasi', $id) // filter berdasarkan pelatihan juga
            ->select('konsultasi_sertifikat.file_url')
            ->get();
        // dd( $files);

        return view('user.training.pelatihan.konsultasi.sertifikat', compact('konsultasi', 'files'), [
            'title' => 'Sertifikat Pelatihan ' . $konsultasi->nama_pelatihan,
            // 'formData' => $formData
        ]);
    }


}
