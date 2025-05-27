<?php

namespace App\Http\Controllers;

use App\Models\tema;
use App\Models\User;
use App\Models\permintaan;
use App\Models\fasilitator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Google_Service_Drive_DriveFile;
use App\Models\permintaan_pelatihan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use App\Models\assesment_peserta_permintaan;
use App\Models\peserta_pelatihan_permintaan;

class PermintaanController extends Controller
{

    private function getDriveFileId($path)
    {
        $directory = dirname($path);
        $filename = basename($path);

        $contents = Storage::disk('google')->listContents($directory);

        foreach ($contents as $item) {
            if ($item instanceof \League\Flysystem\FileAttributes) {
                if (basename($item->path()) === $filename) {
                    // Ambil metadata asli dari Google Drive
                    $adapter = Storage::disk('google')->getAdapter();
                    $rawMetadata = $adapter->getMetadata($item->path());

                    return $rawMetadata['id'] ?? null;
                }
            }
        }

        return null;
    }

    public function index()
    {
        $permintaan = permintaan::with('mitra')->get();
        $permintaan_pelatihan = permintaan_pelatihan::with('permintaan')->get();

        return view('admin.permintaan.index', compact('permintaan', 'permintaan_pelatihan'));
    }

    public function create($id)
    {
        $permintaan = permintaan::where('id_permintaan', $id)->get();
        $fasilitator = fasilitator::all();
        $tema = tema::all();
        $oldIdFasilitator = old('id_fasilitator', []);
        return view('admin.permintaan.create', compact('permintaan', 'fasilitator', 'oldIdFasilitator', 'tema'));

    }

    public function show($id)
    {
        $permintaan = permintaan::where('id_permintaan', $id)->get();
        // dd($permintaan);
        $permintaan_pelatihan = permintaan_pelatihan::where('id_permintaan', $id)->get();
        // dd($permintaan_pelatihan);
        $showButtons = $permintaan_pelatihan->isEmpty();

        $peserta = assesment_peserta_permintaan::where('id_permintaan', $id)->get();
        return view('admin.permintaan.show', compact('permintaan', 'showButtons', 'permintaan_pelatihan', 'peserta'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'nama_pelatihan' => 'required|string',
                'id_tema' => 'required|exists:tema,id',
                'metode_pelatihan' => 'required|string|in:Online,Offline',
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

        $permintaan = new permintaan_pelatihan();
        $permintaan->id_permintaan = $request->id_permintaan;
        $permintaan->nama_pelatihan = $request->nama_pelatihan;
        $permintaan->id_tema = $request->id_tema;
        $permintaan->metode_pelatihan = $request->metode_pelatihan;
        // $permintaan->jenis_pelatihan = $request->jenis_pelatihan;
        $permintaan->lokasi_pelatihan = $request->lokasi_pelatihan;
        $permintaan->tanggal_mulai = $request->tanggal_mulai;
        $permintaan->tanggal_selesai = $request->tanggal_selesai;
        $permintaan->deskripsi_pelatihan = $request->deskripsi_pelatihan;
        $permintaan->save();

        // Upload images ke Google Drive dan simpan ke database
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $filename = $image->getClientOriginalName(); // Ambil nama file asli
                $path = Storage::disk('google')->putFileAs('', $image, $filename); // Simpan di Drive

                DB::table('permintaan_images')->insert([
                    'id_permintaan' => $permintaan->id_permintaan,
                    'image_url' => $filename, // Simpan hanya nama file di database
                ]);
            }
        }

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
                    DB::table('permintaan_files')->insert([
                        'id_permintaan' => $permintaan->id_pelatihan_permintaan,
                        'file_url' => $fileUrl,
                    ]);
                }
            }
        }


        // Simpan ID fasilitator ke tabel pivot
        foreach ($request->id_fasilitator as $id_fasilitator) {
            DB::table('permintaan_fasilitators')->insert([
                'id_pelatihan' => $permintaan->id_pelatihan_permintaan,
                'id_fasilitator' => $id_fasilitator,
            ]);
        }

        return redirect()->route('permintaanAdmin')->with('success', 'Data berhasil disimpan');
    }

    public function detailPelatihanPermintaan($id)
    {
        // dd($id);
        $permintaan = permintaan::where('id_permintaan', $id)->get();
        $permintaan_pelatihan = permintaan_pelatihan::with('tema')->where('id_pelatihan_permintaan', $id)->get();
        // dd($permintaan_pelatihan);
        // $showButtons = $permintaan_pelatihan->isEmpty(); // Check if $permintaan is empty
        return view('admin.permintaan.detail', compact('permintaan', 'permintaan_pelatihan'));
    }

    public function edit($id)
    {
        $permintaan = permintaan_pelatihan::find($id);
        $permintaanId = permintaan::where('id_permintaan', $id)->get();
        // Untuk setiap pelatihan, ambil gambar terkait
        $images = [];

        foreach ($permintaanId as $item) {
            $imageUrl = DB::table('permintaan_images')
                ->where('id_permintaan', $item->id_reguler)
                ->value('image_url');

            $images[] = (object) ['image' => $imageUrl]; // Simpan sebagai objek
        }

        $files = DB::table('permintaan_files')
            ->where('id_permintaan', $id)
            ->get(['file_url', 'file_name']); // Ambil semua file_url
        // dd($permintaan);
        $fasilitator = fasilitator::all();
        $tema = tema::all();
        $oldIdFasilitator = $permintaan->fasilitators->pluck('id_fasilitator')->toArray();
        return view('admin.permintaan.edit', compact('permintaan', 'files', 'fasilitator', 'oldIdFasilitator', 'tema', 'images'));
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
            // 'file.*' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:5120',
            'materi_zip' => 'nullable|file|mimes:zip|max:20480'
        ]);

        $permintaan = permintaan_pelatihan::findOrFail($id);
        $permintaan->update([
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

        // Update Images
        if ($request->hasFile('image')) {
            DB::table('permintaan_images')->where('id_permintaan', $id)->delete();
            foreach ($request->file('image') as $image) {
                $filename = $image->getClientOriginalName(); // Ambil nama file asli
                $path = Storage::disk('google')->putFileAs('', $image, $filename); // Simpan di Drive

                DB::table('permintaan_images')->insert([
                    'id_permintaan' => $permintaan->id_permintaan,
                    'image_url' => $filename, // Simpan hanya nama file di database
                ]);
            }
        }
        if ($request->hasFile('materi_zip')) {
            // — simpan ZIP sementara
            $zipFile = $request->file('materi_zip');
            $zipTemp = storage_path('app/temp/' . $zipFile->hashName());
            $zipFile->move(dirname($zipTemp), basename($zipTemp));

            // - STEP 2 — ekstrak
            $extractPath = storage_path("app/temp/extracted_$id");
            $zip = new \ZipArchive;

            if ($zip->open($zipTemp) === TRUE) {
                if (!file_exists($extractPath)) {
                    mkdir($extractPath, 0755, true);
                }
                $zip->extractTo($extractPath);
                $zip->close();
                unlink($zipTemp);
            } else {
                unlink($zipTemp);
                return back()->withErrors(['materi_zip' => 'File ZIP tidak valid atau rusak.']);
            }

            // - STEP 3 — telusuri rekursif & upload ke Drive
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($extractPath, RecursiveDirectoryIterator::SKIP_DOTS)
            );

            foreach ($iterator as $file) {
                if ($file->isDir())
                    continue;

                $relative = Str::after($file->getPathname(), $extractPath . DIRECTORY_SEPARATOR);
                $drivePath = "permintaan_files/$id/$relative";

                Storage::disk('google')->makeDirectory(dirname($drivePath));

                Storage::disk('google')->putFileAs(
                    dirname($drivePath),
                    new \Illuminate\Http\File($file->getPathname()),
                    $file->getFilename()
                );

                // ===== ambil ID file di Drive  =====
                $idDrive = $this->getDriveFileId($drivePath);   // pastikan method ini sudah ada
                $publicUrl = "https://drive.google.com/uc?id=$idDrive&export=download";

                DB::table('permintaan_files')->insert([
                    'id_permintaan' => $id,
                    'file_name' => $file->getFilename(),
                    'file_path' => $relative,
                    'file_url' => $publicUrl,
                ]);
            }

            // ⬇️  STEP 4 — bersihkan temp
            File::deleteDirectory($extractPath);
        }

        // Update Fasilitators
        DB::table('permintaan_fasilitators')->where('id_pelatihan', $id)->delete();
        foreach ($request->id_fasilitator as $id_fasilitator) {
            DB::table('permintaan_fasilitators')->updateOrInsert([
                'id_pelatihan' => $permintaan->id_pelatihan_permintaan,
                'id_fasilitator' => $id_fasilitator,
            ]);
        }

        return redirect()->route('permintaanAdmin')->with('success', 'Data berhasil diperbarui');
    }

    public function destroyPermintaan($id)
    {
        // peserta_permintaan::where('id', $id)->delete();
        $pelatihan = permintaan::find($id);
        //  dd($pelatihan);
        $pelatihan->delete();
        return redirect()->route('permintaanAdmin')->with('success', 'Data berhasil dihapus');
    }

    public function destroy($id)
    {
        // peserta_permintaan::where('id', $id)->delete();
        $pelatihan = permintaan_pelatihan::find($id);
        //  dd($pelatihan);
        $pelatihan->delete();
        return redirect()->route('permintaanAdmin')->with('success', 'Data berhasil dihapus');
    }

    // Peserta
    public function createPeserta($id)
    {
        $permintaan = permintaan_pelatihan::with('permintaan')->where('id_pelatihan_permintaan', $id)->first();
        // dd($permintaan);
        $peserta = peserta_pelatihan_permintaan::with('permintaan_pelatihan')->where('id_pelatihan_permintaan', $id)->get();
        // dd($peserta);
        $emailPesertaTerdaftar = peserta_pelatihan_permintaan::where('id_pelatihan_permintaan', $id)
            ->pluck('email_peserta'); // atau sesuaikan kolomnya

        // Ambil peserta asesmen yang belum ikut pelatihan
        $pesertaAssesment = assesment_peserta_permintaan::where('id_permintaan', $permintaan->id_permintaan)
            ->whereNotIn('email_peserta', $emailPesertaTerdaftar) // sesuaikan kolom
            ->get();
        return view('admin.permintaan.peserta', compact('permintaan', 'peserta', 'pesertaAssesment'));
    }

    public function storePeserta(Request $request)
    {
        // Ambil id_permintaan dari request
        $id_permintaan = $request->input('id_permintaan');
        // Ambil data permintaan_pelatihan berdasarkan id_permintaan
        $permintaan_pelatihan = permintaan_pelatihan::where('id_pelatihan_permintaan', $id_permintaan)->first();
        // dd($permintaan_pelatihan);

        if (!$permintaan_pelatihan) {
            return redirect()->back()->with('error', 'permintaan Pelatihan tidak ditemukan.');
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
        peserta_pelatihan_permintaan::create([
            'id_pelatihan_permintaan' => $permintaan_pelatihan->id_pelatihan_permintaan, // ID dari tabel permintaan_pelatihan
            'id_user' => $user->id,
            'nama_peserta' => $data['nama_peserta'],
            'email_peserta' => $data['email_peserta'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('permintaanCreatePeserta', ['id' => $id_permintaan])
            ->with('success', 'Data berhasil disimpan');

    }

    public function editPeserta($id)
    {
        $peserta = peserta_pelatihan_permintaan::findOrFail($id);
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
        $peserta = peserta_pelatihan_permintaan::findOrFail($id);
        $id_permintaan = $peserta->id_pelatihan_permintaan;

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

        return redirect()->route('permintaanCreatePeserta', ['id' => $id_permintaan])
            ->with('success', 'Peserta berhasil diperbarui.');
    }


    public function destroyPeserta($id)
    {
        // dd($id);
        // return 'test';
        // Ambil peserta berdasarkan ID
        $peserta = peserta_pelatihan_permintaan::findOrFail($id);
        // dd($peserta);
        $id_permintaan = $peserta->id_pelatihan_permintaan;
        $id_user = $peserta->id_user;
        // dd($id_user);

        // Hapus peserta dari tabel peserta_pelatihan_permintaan
        $peserta->delete();

        // Hapus user terkait di tabel users
        User::where('id', $id_user)->delete();

        return redirect()->route('permintaanCreatePeserta', ['id' => $id_permintaan])
            ->with('success', 'Peserta dan akun peserta berhasil dihapus.');
    }
}
