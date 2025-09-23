<?php

namespace App\Http\Controllers;

use App\Models\Komen;
use App\Models\Discussion;
use App\Traits\DataTableHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\discussion_file;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Google_Service_Drive_DriveFile;
use Illuminate\Support\Str;

class DiscussionController extends Controller
{
    use DataTableHelper;
    //admin
    public function indexAdmin(Request $request)
    {
        $discussion = Discussion::all(); // 10 item per halaman
        $query = Discussion::query();
        $this->applySearch($query, $request, ['title', 'id_user', 'content', 'views', 'created_at']);
        // dd($discussion);
        $data = $query->paginate($request->get('per_page', 10));
        // dd($reguler);
        // Atur locale ke Indonesia
//        Carbon::setLocale('id');
        $data->getCollection()->transform(function ($item) {
            $item->created_at = Carbon::parse($item->created_at)->translatedFormat('l, j F Y');
            return $item;
        });

        $columns = [
            ['label' => 'Judul Diskusi', 'field' => 'title'],
            ['label' => 'content', 'field' => 'content'],
            ['label' => 'views', 'field' => 'views'],
            ['label' => 'tanggal dibuat', 'field' => 'created_at'],
            ['label' => 'Aksi', 'field' => 'aksi'],
        ];

        $actions = [
            [
                'route' => 'adminShowDiskusi',
                'param' => 'id_diskusi',
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
        return view('admin.discussion.index', compact('data','columns','actions'));
    }

    public function createAdmin()
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Anda perlu masuk sebelum membuat ruang diskusi.');
        }

        return view('admin.discussion.create', [
            'title' => 'Buat Diskusi Baru'
        ]);
    }
    public function showAdmin($id)
    {
        $discussion = Discussion::with('user', 'comments.user', 'files')->findOrFail($id);
        // $discussion_file = discussion_file::findOrFail($id);
        // dd($discussion_file);

        // Tambah jumlah views
        $discussion->increment('views');
        $files = DB::table('discussions_files')
            ->where('id_diskusi', $id)
            ->get(['file_url']); // Ambil semua file_url
        return view('admin.discussion.show', compact('discussion', 'files'), [
            'title' => 'Buat Diskusi Baru'
        ]);
    }

    public function storeKomenAdmin(Request $request, $id_diskusi)
    {
        $request->validate([
            'content' => 'required|string',
            'id_parent' => 'nullable|exists:komen_diskusi,id_komen'
        ]);

        try {
            Komen::create([
                'id_diskusi' =>$id_diskusi,
                'id_user' => Auth::id(),
                'content' => $request->content,
                'id_parent' => $request->id_parent ?: null
            ]);

            $message = $request->id_parent ? 'Balasan berhasil ditambahkan!' : 'Komentar berhasil ditambahkan!';

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan komentar: ' . $e->getMessage());
        }
    }

    public function deleteComment($id)
    {
        try {
            // Cari komentar berdasarkan ID
            $comment = DB::table('komen_diskusi')->where('id_komen', $id)->first();

            // Cek apakah komentar ada
            if (!$comment) {
                return redirect()->back()->with('error', 'Komentar tidak ditemukan.');
            }

            // Cek apakah user yang login adalah pemilik komentar
//            if (Auth::id() != $comment->id_user) {
//                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
//            }

            // Hapus komentar
            $deleted = DB::table('komen_diskusi')->where('id_komen', $id)->delete();

            if ($deleted) {
                return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
            } else {
                return redirect()->back()->with('error', 'Gagal menghapus komentar.');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Menghapus diskusi dari database
    public function destroyAdmin($id)
    {
        // Ambil data diskusi
        $discussion = Discussion::findOrFail($id);

        // Ambil semua file yang terkait dengan diskusi
        $files = DB::table('discussions_files')
            ->where('id_diskusi', $id)
            ->pluck('file_url'); // Format: https://drive.google.com/file/d/{fileId}/view?usp=sharing

        // Hapus file dari Google Drive
        foreach ($files as $fileUrl) {
            if (preg_match('/\/d\/(.+?)\//', $fileUrl, $matches)) {
                $fileId = $matches[1];
                Storage::disk('google')->delete($fileId);
            }
        }

        // Hapus data file dari database
        DB::table('discussions_files')->where('id_diskusi', $id)->delete();

        // Hapus diskusinya
        $discussion->delete();

        return back()->with('success', 'Diskusi berhasil dihapus!');
    }



    //peserta
    public function indexUser()
    {
        $discussions = Discussion::with('user')->latest()->paginate(10); // 10 item per halaman

        return view('user.discussion.index', [
            'title' => 'Forum Diskusi',
            'discussions' => $discussions
        ]);
    }

    public function showUser($id)
    {
        $discussion = Discussion::with('user', 'comments.user', 'files')->findOrFail($id);
        // dd($discussion);

        // Tambah jumlah views
        $discussion->increment('views');

        $files = DB::table('discussions_files')
            ->where('id_diskusi', $id)
            ->get(['file_url']); // Ambil semua file_url

        return view('user.discussion.show', compact('discussion', 'files'), [
            'title' => 'Lihat Ruang Diskusi',
        ]);
    }


    // Menampilkan form untuk membuat diskusi baru

    public function createUser()
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Anda perlu masuk sebelum membuat ruang diskusi.');
        }

        return view('user.discussion.create', [
            'title' => 'Buat Diskusi Baru'
        ]);
    }

    public function storeKomenUser(Request $request, $id_diskusi)
    {
        $request->validate([
            'content' => 'required',
            'id_parent' => 'nullable|exists:komen_diskusi,id_komen', // Validasi id_parent
        ]);

        Komen::create([
            'id_diskusi' => $id_diskusi,
            'id_user' => Auth::id(),
            'id_parent' => $request->id_parent ?: null,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads/images', 'public'); // Simpan file di folder public/uploads/images

            return response()->json([
                'url' => asset("storage/$path") // Kembalikan URL file yang diunggah
            ]);
        }

        return response()->json(['error' => 'File upload failed.'], 400);
    }

    // Menyimpan diskusi baru ke database
    public function storeUser(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:255',
                'content' => 'required',
                'id_user' => 'required|exists:users,id',
                'file.*' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:10120',
            ],
            [
                'title.required' => 'Field judul harus diisi',
                'content.required' => 'Field isi diskusi harus diisi',
                'file.*.mimes' => 'File harus berformat pdf, doc, docx, ppt atau pptx',
                'file.*.max' => 'File tidak boleh lebih dari 10mb',
            ]
        );

        // Simpan diskusi ke DB
        $discussion = Discussion::create([
            'id_user' => $request->id_user,
            'title' => $request->title,
            'content' => $request->content,
        ]);

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
                    DB::table('discussions_files')->insert([
                        'id_diskusi' => $discussion->id_diskusi,
                        'file_url' => $fileUrl,
                    ]);
                }
            }
        }

        return redirect()->route('userDiskusi')->with('success', 'Diskusi berhasil dibuat!');
    }

    public function storeComment(Request $request, Discussion $discussion)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $discussion->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->route('discussion.show', $discussion->id)->with('success', 'Komentar berhasil ditambahkan!');
    }



    // Menampilkan form untuk mengedit diskusi
    public function edit(Discussion $discussion)
    {
        return view('user.discussion.edit', [
            'title' => 'Edit Diskusi',
            'discussion' => $discussion
        ]);
    }

    // Mengupdate diskusi di database
    public function update(Request $request, Discussion $discussion)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $discussion->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('discussion.indexUser')->with('success', 'Diskusi berhasil diperbarui!');
    }


}
