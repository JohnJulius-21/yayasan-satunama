<?php

namespace App\Http\Controllers;

use App\Models\reguler;
use App\Models\permintaan_pelatihan;
use App\Models\konsultasi_pelatihan;
use App\Models\peserta_pelatihan_reguler;
use App\Models\peserta_pelatihan_permintaan;
use App\Models\peserta_pelatihan_konsultasi;
use App\Traits\DataTableHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CertificationController extends Controller
{
    use DataTableHelper;
    public function indexReguler(Request $request)
    {
        $reguler = reguler::with('peserta')->get();
        $query = reguler::query();
        $this->applySearch($query, $request, ['nama_pelatihan', 'tanggal_mulai', 'tanggal_selesai']);
        $data = $query->paginate($request->get('per_page', 10));
        // dd($reguler);
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
                'route' => 'sertiRegulerShowAdmin',
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
            compact('columns','actions')
        );

        if ($response) return $response;
        return view('admin.sertifikat.reguler.index', compact('data','columns','actions'));
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
    public function indexPermintaan(request $request)
    {
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
                'route' => 'sertiPermintaanShowAdmin',
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
            compact('columns','actions')
        );

        if ($response) return $response;
        return view('admin.sertifikat.permintaan.index', compact('data','columns','actions'));
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
