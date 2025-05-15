<?php

namespace App\Http\Controllers;

use App\Models\tema;
use App\Models\User;
use App\Models\pelatihan;
use App\Models\konsultasi;
use App\Models\fasilitator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\konsultasi_pelatihan;
use App\Models\peserta_pelatihan_konsultasi;
use Illuminate\Support\Facades\Storage;
use Google_Service_Drive_DriveFile;

class KonsultasiController extends Controller
{
    public function index()
    {
        $konsultasi = konsultasi::all();
        $konsultasi_pelatihan = konsultasi_pelatihan::with('konsultasi')->get();
        // dd($konsultasi_pelatihan);

        return view('admin.konsultasi.index', compact('konsultasi', 'konsultasi_pelatihan'));
    }

    public function create($id)
    {
        $konsultasi = Konsultasi::where('id_konsultasi', $id)->get();
        $fasilitator = fasilitator::all();
        $tema = tema::all();
        $oldIdFasilitator = old('id_fasilitator', []);
        return view('admin.konsultasi.create', compact('konsultasi', 'fasilitator', 'oldIdFasilitator', 'tema'));
    }

    public function show($id)
    {
        $konsultasi = Konsultasi::where('id_konsultasi', $id)->get();
        $konsultasi_pelatihan = konsultasi_pelatihan::where('id_konsultasi', $id)->get();
        $showButtons = $konsultasi_pelatihan->isEmpty(); // Check if $konsultasi is empty
        return view('admin.konsultasi.show', compact('konsultasi', 'showButtons'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'nama_pelatihan' => 'required|string',
                'id_tema' => 'required|exists:tema,id',
                'metode_pelatihan' => 'required|string|in:Online,Offline',
                // 'jenis_pelatihan' => 'required|string|in:Reguler,Permintaan,Konsultasi',
                'lokasi_pelatihan' => 'required|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date',
                'id_fasilitator' => 'required|array',
                'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'file.*' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:5120',
                'deskripsi_pelatihan' => 'required',
            ],
            [
                'nama_pelatihan.required' => 'Kolom nama pelatihan wajib diisi.',
                'id_tema.required' => 'Kolom tema wajib diisi.',
                'id_tema.exists' => 'Tema yang dipilih tidak valid.',
            ]
        );

        $konsultasi = new konsultasi_pelatihan();
        $konsultasi->id_konsultasi = $request->id_konsultasi;
        $konsultasi->nama_pelatihan = $request->nama_pelatihan;
        $konsultasi->id_tema = $request->id_tema;
        $konsultasi->metode_pelatihan = $request->metode_pelatihan;
        // $konsultasi->jenis_pelatihan = $request->jenis_pelatihan;
        $konsultasi->lokasi_pelatihan = $request->lokasi_pelatihan;
        $konsultasi->tanggal_mulai = $request->tanggal_mulai;
        $konsultasi->tanggal_selesai = $request->tanggal_selesai;
        $konsultasi->deskripsi_pelatihan = $request->deskripsi_pelatihan;
        $konsultasi->save();

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $filename = $file->getClientOriginalName(); // Nama asli file
                $filePath = Storage::disk('google')->putFileAs('', $file, $filename); // Upload ke Google Drive

                // Ambil metadata file untuk mendapatkan ID
                $service = Storage::disk('google')->getAdapter()->getService();

                $fileList = $service->files->listFiles([
                    'q' => "name='$filename' and trashed=false",
                    'fields' => 'files(id, name)',
                ]);

                if (count($fileList->getFiles()) > 0) {
                    $fileId = $fileList->getFiles()[0]->getId();

                    // Buat file public agar bisa diakses siapa pun
                    $permission = new \Google_Service_Drive_Permission();
                    $permission->setType('anyone');
                    $permission->setRole('reader');
                    $service->permissions->create($fileId, $permission);

                    // Buat URL tampilan
                    $fileUrl = "https://drive.google.com/file/d/$fileId/view?usp=sharing";

                    // Simpan ke database
                    DB::table('konsultasi_files')->insert([
                        'id_konsultasi' => $konsultasi->id_pelatihan_konsultasi,
                        'file_url' => $fileUrl,
                    ]);
                }
            }
        }


        // Simpan ID fasilitator ke tabel pivot
        foreach ($request->id_fasilitator as $id_fasilitator) {
            DB::table('konsultasi_fasilitators')->insert([
                'id_pelatihan' => $konsultasi->id_pelatihan_konsultasi,
                'id_fasilitator' => $id_fasilitator,
            ]);
        }

        return redirect()->route('konsultasiAdmin')->with('success', 'Data berhasil disimpan');
    }
    public function edit($id)
    {
        $konsultasi = konsultasi_pelatihan::find($id);
        $files = DB::table('konsultasi_files')
            ->where('id_konsultasi', $id)
            ->get(['file_url']); // Ambil semua file_url
        // dd($konsultasi);
        $fasilitator = fasilitator::all();
        $tema = tema::all();
        $oldIdFasilitator = $konsultasi->fasilitators->pluck('id_fasilitator')->toArray();
        return view('admin.konsultasi.edit', compact('konsultasi', 'files', 'fasilitator', 'oldIdFasilitator', 'tema'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama_pelatihan' => 'required|string',
            'id_tema' => 'required|exists:tema,id',
            // 'fee_pelatihan' => 'required|numeric',
            // 'kuota_peserta' => 'required|integer',
            'metode_pelatihan' => 'required|string|in:Online,Offline',
            'lokasi_pelatihan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'id_fasilitator' => 'required|array',
            'deskripsi_pelatihan' => 'required',
            'file.*' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:5120',
        ]);

        $konsultasi = konsultasi_pelatihan::findOrFail($id);
        $konsultasi->update([
            'nama_pelatihan' => $request->nama_pelatihan,
            'id_tema' => $request->id_tema,
            // 'fee_pelatihan' => $request->fee_pelatihan,
            // 'kuota_peserta' => $request->kuota_peserta,
            'metode_pelatihan' => $request->metode_pelatihan,
            'lokasi_pelatihan' => $request->lokasi_pelatihan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'deskripsi_pelatihan' => $request->deskripsi_pelatihan,
        ]);

        if ($request->hasFile('file')) {
            // Ambil file lama dari database
            $oldFiles = DB::table('konsultasi_files')
                ->where('id_konsultasi', $konsultasi->id_pelatihan_konsultasi)
                ->pluck('file_url');

            // Hapus file lama dari Google Drive
            foreach ($oldFiles as $oldFile) {
                preg_match('/id=([^&]+)/', $oldFile, $matches);
                if (isset($matches[1])) {
                    Storage::disk('google')->delete($matches[1]); // Hapus berdasarkan ID
                }
            }

            // Hapus data file lama dari database
            DB::table('konsultasi_files')->where('id_konsultasi', $konsultasi->id_pelatihan_konsultasi)->delete();

            // Simpan file baru ke Google Drive
            foreach ($request->file('file') as $file) {
                $filename = $file->getClientOriginalName(); // Ambil nama file asli
                $filePath = Storage::disk('google')->putFileAs('', $file, $filename); // Simpan ke Drive

                // Ambil metadata file untuk mendapatkan file ID
                $service = Storage::disk('google')->getAdapter()->getService();
                $fileMetadata = new Google_Service_Drive_DriveFile();
                $fileList = $service->files->listFiles([
                    'q' => "name='$filename' and trashed=false",
                    'fields' => 'files(id, name)'
                ]);

                if (count($fileList->getFiles()) > 0) {
                    $fileId = $fileList->getFiles()[0]->getId();

                    // Simpan link berbentuk URL langsung ke database
                    $fileUrl = "https://drive.google.com/file/d/$fileId/view?usp=sharing";

                    DB::table('konsultasi_files')->insert([
                        'id_konsultasi' => $konsultasi->id_pelatihan_konsultasi,
                        'file_url' => $fileUrl, // Simpan URL langsung
                    ]);
                }
            }
        }

        // Update Fasilitators
        DB::table('konsultasi_fasilitators')->where('id_pelatihan', $id)->delete();
        foreach ($request->id_fasilitator as $id_fasilitator) {
            DB::table('konsultasi_fasilitators')->updateOrInsert([
                'id_pelatihan' => $konsultasi->id_pelatihan_konsultasi,
                'id_fasilitator' => $id_fasilitator,
            ]);
        }

        return redirect()->route('konsultasiAdmin')->with('success', 'Data berhasil diperbarui');
    }

    public function detailPelatihan($id)
    {
        $konsultasi = Konsultasi::where('id_konsultasi', $id)->get();
        $konsultasi_pelatihan = konsultasi_pelatihan::with('tema')->where('id_pelatihan_konsultasi', $id)->get();
        // dd($konsultasi_pelatihan);
        // $showButtons = $konsultasi_pelatihan->isEmpty(); // Check if $konsultasi is empty
        return view('admin.konsultasi.detail', compact('konsultasi', 'konsultasi_pelatihan'));
    }

    public function destroy($id)
    {
        // peserta_konsultasi::where('id', $id)->delete();
        $pelatihan = konsultasi_pelatihan::find($id);
        //  dd($pelatihan);
        $pelatihan->delete();
        return redirect()->route('konsultasiAdmin')->with('success', 'Data berhasil dihapus');
    }

    public function destroyKonsultasi($id)
    {
        // peserta_konsultasi::where('id', $id)->delete();
        $pelatihan = konsultasi::find($id);
        //  dd($pelatihan);
        $pelatihan->delete();
        return redirect()->route('konsultasiAdmin')->with('success', 'Data berhasil dihapus');
    }

    // Peserta
    public function createPeserta($id)
    {
        $konsultasi = konsultasi_pelatihan::with('konsultasi')->where('id_pelatihan_konsultasi', $id)->first();
        // dd($konsultasi);
        $peserta = peserta_pelatihan_konsultasi::with('pelatihan_konsultasi')->where('id_pelatihan_konsultasi', $id)->get();
        // dd($peserta);
        return view('admin.konsultasi.peserta', compact('konsultasi', 'peserta'));
    }

    public function storePeserta(Request $request)
    {
        // Ambil id_konsultasi dari request
        $id_konsultasi = $request->input('id_konsultasi');
        // Ambil data konsultasi_pelatihan berdasarkan id_konsultasi
        $konsultasi_pelatihan = konsultasi_pelatihan::where('id_pelatihan_konsultasi', $id_konsultasi)->first();
        // dd($konsultasi_pelatihan);

        if (!$konsultasi_pelatihan) {
            return redirect()->back()->with('error', 'Konsultasi Pelatihan tidak ditemukan.');
        }

        // Validasi data formulir
        $data = $request->validate([
            'nama_peserta' => 'required|string|max:255',
            'email_peserta' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Cek apakah user sudah ada berdasarkan email
        $user = User::where('email', $data['email_peserta'])->first();

        if (!$user) {
            // Jika tidak ada, buat user baru
            $user = User::create([
                'name' => $data['nama_peserta'],
                'email' => $data['email_peserta'],
                'roles' => 'peserta',
                'password' => bcrypt($data['password']),
            ]);
        }

        // Simpan data peserta
        peserta_pelatihan_konsultasi::create([
            'id_pelatihan_konsultasi' => $konsultasi_pelatihan->id_pelatihan_konsultasi, // ID dari tabel konsultasi_pelatihan
            'id_user' => $user->id,
            'nama_peserta' => $data['nama_peserta'],
            'email_peserta' => $data['email_peserta'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('konsultasiCreatePeserta', ['id' => $id_konsultasi])
            ->with('success', 'Data berhasil disimpan');

    }

    public function editPeserta($id)
    {
        $peserta = peserta_pelatihan_konsultasi::findOrFail($id);
        return response()->json($peserta);
    }

    public function updatePeserta(Request $request, $id)
    {
        // Validasi data formulir
        $data = $request->validate([
            'nama_peserta' => 'required|string|max:255',
            'email_peserta' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8', // Password bisa kosong
        ]);

        // Ambil peserta berdasarkan ID
        $peserta = peserta_pelatihan_konsultasi::findOrFail($id);
        $id_konsultasi = $peserta->id_pelatihan_konsultasi;

        // Ambil user terkait
        $user = User::find($peserta->id_user);

        if ($user) {
            // Cek apakah email yang dikirim berbeda dari email yang sudah ada
            if ($data['email_peserta'] !== $user->email) {
                // Pastikan email baru tidak bentrok dengan user lain
                $existingUser = User::where('email', $data['email_peserta'])->where('id', '!=', $user->id)->first();
                if ($existingUser) {
                    return redirect()->back()->with('error', 'Email sudah digunakan oleh peserta lain.');
                }
                // Jika berbeda dan tidak bentrok, update email
                $user->email = $data['email_peserta'];
            }

            // Update data user
            $user->name = $data['nama_peserta'];

            // Jika password diisi, update password juga
            if (!empty($data['password'])) {
                $user->password = bcrypt($data['password']);
            }

            $user->update();
        }

        // Update peserta
        $peserta->update([
            'nama_peserta' => $data['nama_peserta'],
            'email_peserta' => $user->email, // Pastikan email sesuai yang digunakan user
        ]);

        return redirect()->route('konsultasiCreatePeserta', ['id' => $id_konsultasi])
            ->with('success', 'Peserta berhasil diperbarui.');
    }


    public function destroyPeserta($id)
    {
        // dd($id);
        // return 'test';
        // Ambil peserta berdasarkan ID
        $peserta = peserta_pelatihan_konsultasi::findOrFail($id);
        // dd($peserta);
        $id_konsultasi = $peserta->id_pelatihan_konsultasi;
        $id_user = $peserta->id_user;
        // dd($id_user);

        // Hapus peserta dari tabel peserta_pelatihan_konsultasi
        $peserta->delete();

        // Hapus user terkait di tabel users
        User::where('id', $id_user)->delete();

        return redirect()->route('konsultasiCreatePeserta', ['id' => $id_konsultasi])
            ->with('success', 'Peserta dan akun peserta berhasil dihapus.');
    }




}
