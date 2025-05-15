<?php

namespace App\Http\Controllers;

use App\Models\Komen;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Models\discussion_file;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Google_Service_Drive_DriveFile;
use Illuminate\Support\Str;

class DiscussionController extends Controller
{
    //admin
    public function indexAdmin()
    {
        $discussion = Discussion::all(); // 10 item per halaman
        // dd($discussion);


        return view('admin.discussion.index', compact('discussion'));
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
            'content' => 'required',
            'id_parent' => 'nullable|exists:komen_diskusi,id_komen', // Validasi id_parent
        ]);

        Komen::create([
            'id_diskusi' => $id_diskusi,
            'id_user' => Auth::id(),
            'id_parent' => $request->id_parent, // NULL jika komentar utama
            'content' => $request->content,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
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
            'id_parent' => $request->id_parent, // NULL jika komentar utama
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
