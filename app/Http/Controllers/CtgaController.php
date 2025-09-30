<?php

namespace App\Http\Controllers;

use App\Models\ctga;
use App\Models\negara;
use App\Models\reguler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CtgaController extends Controller
{
    public function index()
    {
        return view('user.training.ctga.index', [
            'title' => 'CTGA',
        ]);
    }

    public function create(Request $request)
    {
//        $id = $this->decodeHash($hash);
        $user = auth()->user();
//        $reguler = reguler::findOrFail($id);
        $negara = Negara::all();
        $jumlahPeserta = $request->query('jumlah', 1); // Default ke 1 jika tidak ada parameter
        return view('user.training.ctga.create', compact(
//            'reguler',
            'user',
            'negara',
            'jumlahPeserta'
        ), [
            'title' => 'CTGA',
        ]);
    }

    public function store(Request $request)
    {
        // Debug: Cek data yang masuk
        \Log::info('Data request:', $request->all());

        // Validasi
        $validated = $request->validate([
            'nama_lembaga' => 'required|string|max:100',
            'kontak_lembaga' => 'required|string|max:100',
            'nama_pemimpin_lembaga' => 'required|string|max:100',
            'legalitas_lembaga' => 'required|file|mimes:pdf|max:2048',
            'id_negara' => 'required|exists:negara,id',
            'id_provinsi' => 'required|exists:provinsi,id',
            'id_kabupaten' => 'required|exists:kabupaten_kota,id',
            'alamat_lembaga' => 'required|string|max:100',
        ], [
            'nama_lembaga.required' => 'Nama lembaga wajib diisi',
            'kontak_lembaga.required' => 'Kontak person wajib diisi',
            'nama_pemimpin_lembaga.required' => 'Nama pemimpin lembaga wajib diisi',
            'legalitas_lembaga.required' => 'File legalitas lembaga wajib diupload',
            'legalitas_lembaga.mimes' => 'File harus berformat PDF',
            'legalitas_lembaga.max' => 'Ukuran file maksimal 2MB',
            'id_negara.required' => 'Negara wajib dipilih',
            'id_provinsi.required' => 'Provinsi wajib dipilih',
            'id_kabupaten.required' => 'Kota/Kabupaten wajib dipilih',
            'alamat_lembaga.required' => 'Alamat lengkap lembaga wajib diisi',
        ]);

        DB::beginTransaction();

        try {
            // Upload file
            $legalitasPath = null;
            if ($request->hasFile('legalitas_lembaga')) {
                $file = $request->file('legalitas_lembaga');

                // Validasi file
                if (!$file->isValid()) {
                    throw new \Exception('File tidak valid');
                }

                $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
                $legalitasPath = $file->storeAs('legalitas', $filename, 'public');

                \Log::info('File uploaded:', ['path' => $legalitasPath]);
            }

            // Insert ke database menggunakan DB Query Builder
            $inserted = DB::table('registrasi_ctga')->insert([
                'nama_lembaga' => $validated['nama_lembaga'],
                'kontak_lembaga' => $validated['kontak_lembaga'],
                'nama_pemimpin_lembaga' => $validated['nama_pemimpin_lembaga'],
                'legalitas_lembaga' => $legalitasPath,
                'id_negara' => $validated['id_negara'],
                'id_provinsi' => $validated['id_provinsi'],
                'id_kabupaten' => $validated['id_kabupaten'],
                'alamat_lembaga' => $validated['alamat_lembaga'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (!$inserted) {
                throw new \Exception('Gagal menyimpan data ke database');
            }

            DB::commit();

            \Log::info('Data berhasil disimpan');

            return redirect()->back()->with('success', 'Pendaftaran pelatihan berhasil! Tim kami akan segera menghubungi Anda.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Log error detail
            \Log::error('Error saat menyimpan registrasi:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Hapus file jika gagal
            if ($legalitasPath && Storage::disk('public')->exists($legalitasPath)) {
                Storage::disk('public')->delete($legalitasPath);
                \Log::info('File deleted due to error');
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }
}
