<?php

namespace App\Http\Controllers;

use App\Models\reguler;
use App\Models\permintaan_pelatihan;
use App\Models\konsultasi_pelatihan;
use App\Models\peserta_pelatihan_reguler;
use App\Models\peserta_pelatihan_permintaan;
use App\Models\peserta_pelatihan_konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CertificationController extends Controller
{
    public function indexReguler()
    {
        $reguler = reguler::with('peserta')->get();
        // dd($reguler);
        return view('admin.sertifikat.reguler.index', compact('reguler'));
    }

    public function showReguler($id)
    {
        $reguler = reguler::with('peserta')->findOrFail($id);
        // dd($reguler);
        return view('admin.sertifikat.reguler.show', compact('reguler'));
    }

    public function uploadReguler(Request $request, $id)
    {
        $peserta = peserta_pelatihan_reguler::with('reguler')->findOrFail($id);

        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $filename = $file->getClientOriginalName();

            // Cek apakah sudah ada sertifikat sebelumnya
            $existingSertifikat = DB::table('reguler_sertifikat')
                ->where('id_reguler', $peserta->id_reguler)
                ->where('id_peserta', $peserta->id_peserta_reguler)
                ->first();

            $service = Storage::disk('google')->getAdapter()->getService();

            if ($existingSertifikat) {
                // Cari ID file lama dari URL
                if (preg_match('/\/d\/(.*?)\//', $existingSertifikat->file_url, $matches)) {
                    $oldFileId = $matches[1];

                    // Hapus file lama dari Google Drive
                    try {
                        $service->files->delete($oldFileId);
                    } catch (\Exception $e) {
                        // Optional: bisa log kalau mau
                    }
                }

                // Hapus record lama di database
                DB::table('reguler_sertifikat')
                    ->where('id_reguler', $peserta->id_reguler)
                    ->where('id_peserta', $peserta->id_peserta_reguler)
                    ->delete();
            }

            // Upload file baru
            $filePath = Storage::disk('google')->putFileAs('', $file, $filename);

            // Ambil metadata file baru
            $fileList = $service->files->listFiles([
                'q' => "name='$filename' and trashed=false",
                'fields' => 'files(id, name)',
            ]);

            if (count($fileList->getFiles()) > 0) {
                $fileId = $fileList->getFiles()[0]->getId();

                // Buat file public
                $permission = new \Google_Service_Drive_Permission();
                $permission->setType('anyone');
                $permission->setRole('reader');
                $service->permissions->create($fileId, $permission);

                $fileUrl = "https://drive.google.com/file/d/$fileId/view?usp=sharing";

                // Simpan file baru ke database
                DB::table('reguler_sertifikat')->insert([
                    'id_reguler' => $peserta->id_reguler,
                    'id_peserta' => $peserta->id_peserta_reguler,
                    'file_url' => $fileUrl,
                ]);
            }
        }

        return back()->with('success', 'Sertifikat berhasil diupload.');
    }


    // permintaan
    public function indexPermintaan()
    {
        $permintaan = permintaan_pelatihan::with('peserta_permintaan')->get();
        // dd($permintaan);
        return view('admin.sertifikat.permintaan.index', compact('permintaan'));
    }

    public function showPermintaan($id)
    {
        $permintaan = permintaan_pelatihan::with('peserta_permintaan')->findOrFail($id);
        // dd($permintaan);
        return view('admin.sertifikat.permintaan.show', compact('permintaan'));
    }

    public function uploadPermintaan(Request $request, $id)
    {
        $peserta = peserta_pelatihan_permintaan::with('permintaan_pelatihan')->findOrFail($id);

        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $filename = $file->getClientOriginalName();

            // Cek apakah sudah ada sertifikat sebelumnya
            $existingSertifikat = DB::table('permintaan_sertifikat')
                ->where('id_pelatihan_permintaan', $peserta->id_pelatihan_permintaan)
                ->where('id_peserta', $peserta->id_peserta)
                ->first();

            $service = Storage::disk('google')->getAdapter()->getService();

            if ($existingSertifikat) {
                // Cari ID file lama dari URL
                if (preg_match('/\/d\/(.*?)\//', $existingSertifikat->file_url, $matches)) {
                    $oldFileId = $matches[1];
                    try {
                        $service->files->delete($oldFileId);
                    } catch (\Exception $e) {
                        // Optional: handle error
                    }
                }

                // Hapus data lama di database
                DB::table('permintaan_sertifikat')
                    ->where('id_pelatihan_permintaan', $peserta->id_pelatihan_permintaan)
                    ->where('id_peserta', $peserta->id_peserta)
                    ->delete();
            }

            // Upload file baru
            $filePath = Storage::disk('google')->putFileAs('', $file, $filename);

            $fileList = $service->files->listFiles([
                'q' => "name='$filename' and trashed=false",
                'fields' => 'files(id, name)',
            ]);

            if (count($fileList->getFiles()) > 0) {
                $fileId = $fileList->getFiles()[0]->getId();

                $permission = new \Google_Service_Drive_Permission();
                $permission->setType('anyone');
                $permission->setRole('reader');
                $service->permissions->create($fileId, $permission);

                $fileUrl = "https://drive.google.com/file/d/$fileId/view?usp=sharing";

                // Insert baru
                DB::table('permintaan_sertifikat')->insert([
                    'id_pelatihan_permintaan' => $peserta->id_pelatihan_permintaan,
                    'id_peserta' => $peserta->id_peserta,
                    'file_url' => $fileUrl,
                ]);
            }
        }

        return back()->with('success', 'Sertifikat berhasil diupload.');
    }


    // konsultasi
    public function indexKonsultasi()
    {
        $konsultasi = konsultasi_pelatihan::with('peserta_konsultasi')->get();
        // dd($konsultasi);
        return view('admin.sertifikat.konsultasi.index', compact('konsultasi'));
    }

    public function showKonsultasi($id)
    {
        $konsultasi = konsultasi_pelatihan::with('peserta_konsultasi')->findOrFail($id);
        // dd($konsultasi);
        return view('admin.sertifikat.konsultasi.show', compact('konsultasi'));
    }

    public function uploadKonsultasi(Request $request, $id)
    {
        $peserta = peserta_pelatihan_konsultasi::with('pelatihan_konsultasi')->findOrFail($id);

        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $filename = $file->getClientOriginalName();

            // Cek apakah sudah ada sertifikat sebelumnya
            $existingSertifikat = DB::table('konsultasi_sertifikat')
                ->where('id_pelatihan_konsultasi', $peserta->id_pelatihan_konsultasi)
                ->where('id_peserta', $peserta->id_peserta)
                ->first();

            $service = Storage::disk('google')->getAdapter()->getService();

            if ($existingSertifikat) {
                // Cari ID file lama dari URL
                if (preg_match('/\/d\/(.*?)\//', $existingSertifikat->file_url, $matches)) {
                    $oldFileId = $matches[1];
                    try {
                        $service->files->delete($oldFileId);
                    } catch (\Exception $e) {
                        // Optional: handle error
                    }
                }

                // Hapus data lama di database
                DB::table('konsultasi_sertifikat')
                    ->where('id_pelatihan_konsultasi', $peserta->id_pelatihan_konsultasi)
                    ->where('id_peserta', $peserta->id_peserta)
                    ->delete();
            }

            // Upload file baru
            $filePath = Storage::disk('google')->putFileAs('', $file, $filename);

            $fileList = $service->files->listFiles([
                'q' => "name='$filename' and trashed=false",
                'fields' => 'files(id, name)',
            ]);

            if (count($fileList->getFiles()) > 0) {
                $fileId = $fileList->getFiles()[0]->getId();

                $permission = new \Google_Service_Drive_Permission();
                $permission->setType('anyone');
                $permission->setRole('reader');
                $service->permissions->create($fileId, $permission);

                $fileUrl = "https://drive.google.com/file/d/$fileId/view?usp=sharing";

                // Insert baru
                DB::table('konsultasi_sertifikat')->insert([
                    'id_pelatihan_konsultasi' => $peserta->id_pelatihan_konsultasi,
                    'id_peserta' => $peserta->id_peserta,
                    'file_url' => $fileUrl,
                ]);
            }
        }

        return back()->with('success', 'Sertifikat berhasil diupload.');
    }

}
