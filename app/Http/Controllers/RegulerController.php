<?php

namespace App\Http\Controllers;

use App\Models\peserta_pelatihan_reguler;
use App\Models\tema;
use App\Models\reguler;
use App\Models\fasilitator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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


        // Upload files ke Google Drive dan simpan ke database
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $filename = $file->getClientOriginalName(); // Ambil nama file asli
                $path = Storage::disk('google')->putFileAs('', $file, $filename); // Simpan di Drive

                DB::table('reguler_files')->insert([
                    'id_reguler' => $reguler->id_reguler,
                    'file_url' => $filename, // Simpan hanya nama file di database
                ]);
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

    // public function show($id_reguler)
    // {
    //     // Pastikan $id_reguler adalah integer sebelum menggunakannya dalam query
    //     $id_reguler = (int) $id_reguler;
    //     $reguler = reguler::findOrFail($id_reguler); // Assuming you have a Pelatihan model

    //     // Now you have the $pelatihan object, you can access its properties like nama_pelatihan
    //     $nama_pelatihan = $reguler->nama_pelatihan;

    //     // Continue with your existing code to fetch data related to the $id_pelatihan
    //     // $data = peserta_pelatihan_test::with('pelatihan', 'gender', 'rentang_usia', 'negara', 'provinsi', 'kabupaten_kota', 'informasi_pelatihan')
    //     //     ->where('id_pelatihan', $id_pelatihan)
    //     //     ->get();

    //     // Ambil data UserPresensi yang sudah melakukan presensi
    //     // $dataHadir = UserPresensi::whereHas('presensi', function ($query) use ($id_pelatihan) {
    //     //     $query->where('id_pelatihan', $id_pelatihan);
    //     // })->with(['presensi', 'user'])->get();

    //     // $presensiStatus = Hadir::where('id_pelatihan', $id_pelatihan)->value('status');

    //     // Menyiapkan link unduhan file bukti bayar
    //     // $downloadLinks = [];
    //     // foreach ($data as $peserta) {
    //     //     $buktiBayarPath = storage_path('app/' . $peserta->bukti_bayar);
    //     //     $downloadLinks[$peserta->id] = file_exists($buktiBayarPath) ? route('download.bukti_bayar', ['id' => $peserta->id]) : null;
    //     // }
    //     // dd($data);
    //     return view('admin.reguler.show', compact('data', 'dataHadir', 'presensiStatus', 'nama_pelatihan'));
    // }

    public function show($id)
    {

        $reguler = Reguler::findOrFail($id);
        $nama_pelatihan = $reguler->nama_pelatihan;
        $peserta = peserta_pelatihan_reguler::with('reguler', 'negara', 'provinsi', 'kabupaten_kota')->where('id_reguler', $id)->get();
        // dd($peserta);
        // Ambil data images langsung dari tabel reguler_images
        $images = DB::table('reguler_images')->where('id_reguler', $id)->get();

        // Ambil data files langsung dari tabel reguler_files
        $files = DB::table('reguler_files')->where('id_reguler', $id)->get();

        // // Ambil data fasilitator dari tabel pivot reguler_fasilitators
        // $fasilitators = DB::table('reguler_fasilitators')
        //     ->join('fasilitator_pelatihan', 'reguler_fasilitators.id_fasilitator', '=', 'fasilitator_pelatihan.id_fasilitator')
        //     ->where('reguler_fasilitators.id_pelatihan', $id)
        //     ->select('fasilitator.*')
        //     ->get();

        return view('admin.reguler.show', compact('reguler', 'images', 'files', 'nama_pelatihan', 'peserta'));
    }

    // public function edit($id)
    // {
    //     $data = reguler::find($id);
    //     $oldIdFasilitator = $data->fasilitator_pelatihan->pluck('id_fasilitator')->toArray();
    //     $oldImages = $data->gambarPelatihan()->pluck('path')->toArray();
    //     $oldFiles = $data->filePelatihan()->pluck('path')->toArray();
    //     return view('dashboard.reguler.edit', compact('data', 'oldIdFasilitator', 'oldImages', 'oldFiles'), [
    //         'tema' => Tema::all(),
    //         'fasilitator_pelatihan' => fasilitator_pelatihan_test::all(),
    //     ]);
    // }

    public function edit($id)
    {
        $reguler = Reguler::with(['fasilitators'])->findOrFail($id);

        // Ambil data images langsung dari tabel reguler_images
        $images = DB::table('reguler_images')->where('id_reguler', $id)->get();

        // Ambil data files langsung dari tabel reguler_files
        $files = DB::table('reguler_files')->where('id_reguler', $id)->get();
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
            'file.*' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:5120',
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
        ]);

        // Update Images
        if ($request->hasFile('image')) {
            DB::table('reguler_images')->where('id_reguler', $id)->delete();
            foreach ($request->file('image') as $image) {
                $path = Storage::disk('google')->putFile('', $image);
                $imageUrl = Storage::disk('google')->url($path);
                DB::table('reguler_images')->insert([
                    'id_reguler' => $id,
                    'image_url' => $imageUrl,
                ]);
            }
        }

        // Update Files
        if ($request->hasFile('file')) {
            DB::table('reguler_files')->where('id_reguler', $id)->delete();
            foreach ($request->file('file') as $file) {
                $path = Storage::disk('google')->putFile('', $file);
                $fileUrl = Storage::disk('google')->url($path);
                DB::table('reguler_files')->insert([
                    'id_reguler' => $id,
                    'file_url' => $fileUrl,
                ]);
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
