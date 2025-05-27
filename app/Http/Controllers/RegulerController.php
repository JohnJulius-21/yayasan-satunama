<?php

namespace App\Http\Controllers;

use App\Models\tema;
use App\Models\User;
use App\Models\status;
use App\Models\reguler;
use App\Models\negara;
use App\Models\provinsi;
use App\Models\kabupaten_kota;
use App\Models\fasilitator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Google_Service_Drive_DriveFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\peserta_pelatihan_reguler;

class RegulerController extends Controller
{
    public function index()
    {
        $reguler = reguler::all();

        return view('admin.reguler.index', compact('reguler'));
    }

    public function create()
    {
        $fasilitator = fasilitator::all();
        $tema = tema::all();
        $oldIdFasilitator = old('id_fasilitator', []);
        return view('admin.reguler.create', compact('fasilitator', 'oldIdFasilitator', 'tema'));
    }

    public function createTema()
    {
        $tema = tema::all();
        return view('admin.reguler.tema', compact('tema'));
    }

    public function storeTema(Request $request)
    {
        $request->validate([
            'judul_tema' => 'required'

        ]);

        // Simpan data pelatihan
        $tema = new tema;
        $tema->judul_tema = $request->judul_tema;
        $tema->save();

        return redirect()->back()->with('success', 'Tema berhasil disimpan');
    }

    public function destroyTema($id)
    {
        $tema = Tema::findOrFail($id);
        $tema->delete();

        return redirect()->back()->with('success', 'Tema berhasil dihapus.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_pelatihan' => 'required|string',
            'id_tema' => 'required|exists:tema,id',
            'fee_pelatihan' => 'required|numeric',
            'metode_pelatihan' => 'required|string|in:Online,Offline',
            'lokasi_pelatihan' => 'required|string',
            'kuota_peserta' => 'required|integer',
            'tanggal_pendaftaran' => 'required|date',
            'tanggal_batas_pendaftaran' => 'required|date|after:tanggal_pendaftaran',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'id_fasilitator' => 'required|array',
            'deskripsi_pelatihan' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file.*' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:5120',
        ]);

        // Simpan data pelatihan
        $reguler = new reguler;
        $reguler->nama_pelatihan = $request->nama_pelatihan;
        $reguler->id_tema = $request->id_tema;
        $reguler->fee_pelatihan = $request->fee_pelatihan;
        $reguler->metode_pelatihan = $request->metode_pelatihan;
        $reguler->lokasi_pelatihan = $request->lokasi_pelatihan;
        $reguler->kuota_peserta = $request->kuota_peserta;
        $reguler->tanggal_pendaftaran = $request->tanggal_pendaftaran;
        $reguler->tanggal_batas_pendaftaran = $request->tanggal_batas_pendaftaran;
        $reguler->tanggal_mulai = $request->tanggal_mulai;
        $reguler->tanggal_selesai = $request->tanggal_selesai;
        $reguler->deskripsi_pelatihan = $request->deskripsi_pelatihan;
        $reguler->pengumuman = $request->pengumuman;
        $reguler->save();

        // Upload images ke Google Drive dan simpan ke database
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $filename = $image->getClientOriginalName(); // Ambil nama file asli
                $path = Storage::disk('google')->putFileAs('', $image, $filename); // Simpan di Drive

                DB::table('reguler_images')->insert([
                    'id_reguler' => $reguler->id_reguler,
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
                    DB::table('reguler_files')->insert([
                        'id_reguler' => $reguler->id_reguler,
                        'file_url' => $fileUrl,
                    ]);
                }
            }
        }

        // Simpan ID fasilitator ke tabel pivot
        foreach ($request->id_fasilitator as $id_fasilitator) {
            DB::table('reguler_fasilitators')->insert([
                'id_pelatihan' => $reguler->id_reguler,
                'id_fasilitator' => $id_fasilitator,
            ]);
        }

        return redirect()->route('regulerAdmin')->with('success', 'Pelatihan berhasil disimpan');
    }

    public function show($id)
    {

        $reguler = Reguler::findOrFail($id);
        $nama_pelatihan = $reguler->nama_pelatihan;
        $peserta = peserta_pelatihan_reguler::with('reguler', 'negara', 'provinsi', 'kabupaten_kota', 'status')->where('id_reguler', $id)->get();
        // dd($peserta);
        // Ambil data images langsung dari tabel reguler_images
        $images = DB::table('reguler_images')->where('id_reguler', $id)->get();

        // Ambil data files langsung dari tabel reguler_files
        $files = DB::table('reguler_files')->where('id_reguler', $id)->get();
        $negara = negara::all();


        return view('admin.reguler.show', compact('reguler', 'images', 'files', 'nama_pelatihan', 'peserta', 'negara'));
    }

    public function getProvinsi($negaraId)
    {
        $provinsi = provinsi::where('id_negara', $negaraId)->pluck('nama_provinsi', 'id');
        return response()->json(['provinsi' => $provinsi]);
    }

    public function getKabupaten($provinsiId)
    {
        $kabupaten = kabupaten_kota::where('id_provinsi', $provinsiId)->pluck('nama_kabupaten_kota', 'id');
        return response()->json(['kabupaten' => $kabupaten]);
    }

    public function storePeserta(Request $request)
    {
        $request->validate([
            'nama_peserta' => 'required|string|max:255',
            'email_peserta' => 'required|email',
            'no_hp' => 'required|max:12',
            'gender' => 'required|string',
            'rentang_usia' => 'nullable|string',
            'nama_organisasi' => 'nullable|string',
            'organisasi' => 'nullable|string',
            'jabatan_peserta' => 'nullable|string',
            'harapan_pelatihan' => 'nullable|string',
            'id_reguler' => 'required|exists:reguler,id_reguler',
        ]);

        // Cek user berdasarkan email
        $user = User::where('email', $request->email_peserta)->first();

        // Jika belum ada user, buat akun baru
        if (!$user) {
            $defaultPassword = 'stc12345';
            $user = User::create([
                'name' => $request->nama_peserta,
                'email' => $request->email_peserta,
                'password' => Hash::make($defaultPassword),
                'roles' => 'peserta',
            ]);

            // Optional: bisa simpan data akun baru yang dibuat ke log atau notifikasi
        }

        // Simpan peserta pelatihan
        $peserta = peserta_pelatihan_reguler::create([
            'id_reguler' => $request->id_reguler,
            'id_user' => $user->id,
            'nama_peserta' => $request->nama_peserta,
            'email_peserta' => $request->email_peserta,
            'no_hp' => $request->no_hp,
            'gender' => $request->gender,
            'rentang_usia' => $request->rentang_usia,
            'id_negara' => $request->id_negara ?? null, // Tambahkan jika input tersedia
            'id_provinsi' => $request->id_provinsi ?? null,
            'id_kabupaten' => $request->id_kabupaten ?? null,
            'nama_organisasi' => $request->nama_organisasi,
            'organisasi' => $request->organisasi,
            'informasi' => $request->informasi ?? null,
            'jabatan_peserta' => $request->jabatan_peserta,
            'pelatihan_relevan' => $request->pelatihan_relevan ?? null,
            'alamat' => $request->jabatan_peserta,
            'harapan_pelatihan' => $request->harapan_pelatihan,
        ]);

        // Simpan status peserta
        status::create([
            'id_reguler' => $request->id_reguler,
            'id_peserta' => $peserta->id_peserta_reguler,
        ]);

        return redirect()->back()->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function updateStatus(Request $request, $id)
    {
        $status = status::where('id_peserta', $id)->first();

        if ($status) {
            $status->status = $request->status;
            $status->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }


    public function edit($id)
    {
        $reguler = Reguler::with(['fasilitators'])->findOrFail($id);
        $regulerId = Reguler::where('id_reguler', $id)->get();

        // Untuk setiap pelatihan, ambil gambar terkait
        $images = [];

        foreach ($regulerId as $item) {
            $imageUrl = DB::table('reguler_images')
                ->where('id_reguler', $item->id_reguler)
                ->value('image_url');

            $images[] = (object) ['image' => $imageUrl]; // Simpan sebagai objek
        }
        // dd($images);
        // Ambil data files langsung dari tabel reguler_files
        // Ambil semua file dari reguler_files yang sesuai dengan id_reguler
        $files = DB::table('reguler_files')
            ->where('id_reguler', $id)
            ->get(['file_url']); // Ambil semua file_url
        // dd($files);

        $tema = Tema::all();
        $fasilitators = Fasilitator::all();
        $oldIdFasilitator = $reguler->fasilitators->pluck('id_fasilitator')->toArray();
        return view('admin.reguler.edit', compact('reguler', 'tema', 'fasilitators', 'images', 'files', 'oldIdFasilitator'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelatihan' => 'required|string',
            'id_tema' => 'required|exists:tema,id',
            'fee_pelatihan' => 'required|numeric',
            'metode_pelatihan' => 'required|string|in:Online,Offline',
            'lokasi_pelatihan' => 'required|string',
            'kuota_peserta' => 'required|integer',
            'tanggal_pendaftaran' => 'required|date',
            'tanggal_batas_pendaftaran' => 'required|date|after:tanggal_pendaftaran',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'id_fasilitator' => 'required|array',
            'deskripsi_pelatihan' => 'required',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file.*' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:10120',
        ]);

        $reguler = Reguler::findOrFail($id);
        $reguler->update([
            'nama_pelatihan' => $request->nama_pelatihan,
            'id_tema' => $request->id_tema,
            'fee_pelatihan' => $request->fee_pelatihan,
            'metode_pelatihan' => $request->metode_pelatihan,
            'lokasi_pelatihan' => $request->lokasi_pelatihan,
            'kuota_peserta' => $request->kuota_peserta,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
            'tanggal_batas_pendaftaran' => $request->tanggal_batas_pendaftaran,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'deskripsi_pelatihan' => $request->deskripsi_pelatihan,
            'pengumuman' => $request->pengumuman,
        ]);

        // Update Images
        if ($request->hasFile('image')) {
            DB::table('reguler_images')->where('id_reguler', $id)->delete();
            foreach ($request->file('image') as $image) {
                $filename = $image->getClientOriginalName(); // Ambil nama file asli
                $path = Storage::disk('google')->putFileAs('', $image, $filename); // Simpan di Drive

                DB::table('reguler_images')->insert([
                    'id_reguler' => $reguler->id_reguler,
                    'image_url' => $filename, // Simpan hanya nama file di database
                ]);
            }
        }

        if ($request->hasFile('file')) {
            // Ambil file lama dari database
            $oldFiles = DB::table('reguler_files')
                ->where('id_reguler', $reguler->id_reguler)
                ->pluck('file_url');

            // Hapus file lama dari Google Drive
            foreach ($oldFiles as $oldFile) {
                preg_match('/id=([^&]+)/', $oldFile, $matches);
                if (isset($matches[1])) {
                    Storage::disk('google')->delete($matches[1]); // Hapus berdasarkan ID
                }
            }

            // Hapus data file lama dari database
            DB::table('reguler_files')->where('id_reguler', $reguler->id_reguler)->delete();

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

                    DB::table('reguler_files')->insert([
                        'id_reguler' => $reguler->id_reguler,
                        'file_name' => $filename, // Simpan nama file langsung
                        'file_url' => $fileUrl, // Simpan URL langsung
                    ]);
                }
            }
        }


        // Update Fasilitators
        DB::table('reguler_fasilitators')->where('id_pelatihan', $id)->delete();
        foreach ($request->id_fasilitator as $id_fasilitator) {
            DB::table('reguler_fasilitators')->insert([
                'id_pelatihan' => $id,
                'id_fasilitator' => $id_fasilitator,
            ]);
        }

        return redirect()->route('regulerAdmin')->with('success', 'Data berhasil diperbarui');
    }


    public function destroy($id)
    {
        $reguler = Reguler::findOrFail($id);

        // Hapus Gambar dari Database dan Google Drive
        $images = DB::table('reguler_images')->where('id_reguler', $id)->get();
        foreach ($images as $image) {
            Storage::disk('google')->delete($image->image_url);
        }
        DB::table('reguler_images')->where('id_reguler', $id)->delete();

        // Hapus File dari Database dan Google Drive
        $files = DB::table('reguler_files')->where('id_reguler', $id)->get();
        foreach ($files as $file) {
            Storage::disk('google')->delete($file->file_url);
        }
        DB::table('reguler_files')->where('id_reguler', $id)->delete();

        // Hapus Data Fasilitator
        DB::table('reguler_fasilitators')->where('id_pelatihan', $id)->delete();

        // Hapus Data Pelatihan
        $reguler->delete();

        return redirect()->route('regulerAdmin')->with('success', 'Data berhasil dihapus');
    }

}
