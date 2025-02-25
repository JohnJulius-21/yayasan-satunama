<?php

namespace App\Http\Controllers;

use App\Models\tema;
use App\Models\pelatihan;
use App\Models\konsultasi;
use App\Models\konsultasi_pelatihan;
use App\Models\fasilitator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KonsultasiController extends Controller
{
    public function index()
    {
        $konsultasi = konsultasi::all();

        return view('admin.konsultasi.index', compact('konsultasi'));
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

        // Upload images ke Google Drive dan simpan ke database
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $filename = $image->getClientOriginalName(); // Ambil nama file asli
                $path = Storage::disk('google')->putFileAs('', $image, $filename); // Simpan di Drive

                DB::table('konsultasi_images')->insert([
                    'id_konsultasi' => $konsultasi->id_konsultasi,
                    'image_url' => $filename, // Simpan hanya nama file di database
                ]);
            }
        }


        // Upload files ke Google Drive dan simpan ke database
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $filename = $file->getClientOriginalName(); // Ambil nama file asli
                $path = Storage::disk('google')->putFileAs('', $file, $filename); // Simpan di Drive

                DB::table('konsultasi_files')->insert([
                    'id_konsultasi' => $konsultasi->id_konsultasi,
                    'file_url' => $filename, // Simpan hanya nama file di database
                ]);
            }
        }


        // Simpan ID fasilitator ke tabel pivot
        foreach ($request->id_fasilitator as $id_fasilitator) {
            DB::table('konsultasi_fasilitators')->insert([
                'id_pelatihan' => $konsultasi->id_konsultasi,
                'id_fasilitator' => $id_fasilitator,
            ]);
        }

        return redirect()->route('konsultasiAdmin')->with('success', 'Data berhasil disimpan');
    }
}
