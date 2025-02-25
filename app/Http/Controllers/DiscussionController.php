<?php

namespace App\Http\Controllers;

use App\Models\Komen;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function indexAdmin()
    {
        return view('admin.discussion.index');
    }

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
        $discussion = Discussion::with('user', 'comments.user')->findOrFail($id);
        // dd($discussion);

        // Tambah jumlah views
        $discussion->increment('views');

        return view('user.discussion.show', compact('discussion'),[
            'title' => 'Lihat Ruang Diskusi',
        ]);
    }


    // Menampilkan form untuk membuat diskusi baru
    public function createUser()
    {
        return view('user.discussion.create', [
            'title' => 'Buat Diskusi Baru'
        ]);
    }

    public function storeKomenUser(Request $request,  $id_diskusi)
    {
        $request->validate([
            'content' => 'required',
            'id_parent' => 'nullable|exists:komen_diskusi,id_komen', // Validasi id_parent
        ]);

        Komen::create([
            'id_diskusi' =>  $id_diskusi,
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
        // dd($request->all());
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'id_user' => 'required|exists:users,id'
        ]);


        Discussion::create([
            'id_user' => $request->id_user,
            'title' => $request->title,
            'content' => $request->content,
        ]);

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

    // Menghapus diskusi dari database
    public function destroy(Discussion $discussion)
    {
        $discussion->delete();
        return redirect()->route('discussion.indexUser')->with('success', 'Diskusi berhasil dihapus!');
    }
}
