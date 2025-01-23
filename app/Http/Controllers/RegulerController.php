<?php

namespace App\Http\Controllers;

use App\Models\tema;
use App\Models\reguler;
use App\Models\fasilitator;
use Illuminate\Http\Request;

class RegulerController extends Controller
{
    public function index()
    {
        // $reguler = reguler::paginate(3);

        return view('admin.reguler.index');
    }

    public function create()
    {
        $fasilitator = fasilitator::all();
        $tema = tema::all();
        $oldIdFasilitator = old('id_fasilitator', []);
        return view('admin.reguler.create',compact('fasilitator', 'oldIdFasilitator','tema'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate(
            [
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
                'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'file.*' => 'required|mimes:pdf,doc,docx|max:2048',
                'deskripsi_pelatihan' => 'required',
            ],
            [
                'nama_pelatihan.required' => 'Kolom nama pelatihan wajib diisi.',
                'id_tema.required' => 'Kolom tema wajib diisi.',
                'id_tema.exists' => 'Tema yang dipilih tidak valid.',
                'lokasi_pelatihan.required' => 'Kolom lokasi pelatihan wajib diisi.',
                'tanggal_pendaftaran.required' => 'Tanggal pendaftaran harus diisi.',
                'tanggal_batas_pendaftaran.required' => 'Tanggal batas pendaftaran harus diisi.',
                'tanggal_batas_pendaftaran.after' => 'Tanggal batas pendaftaran harus setelah tanggal pendaftaran.',
                'tanggal_mulai.required' => 'Tanggal mulai harus diisi.',
                'tanggal_selesai.required' => 'Tanggal selesai harus diisi.',
                'tanggal_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai.',
                'fee_pelatihan.required' => 'Kolom fee pelatihan wajib diisi.',
                'fee_pelatihan.numeric' => 'Kolom fee pelatihan harus berupa angka.',
                'deskripsi_pelatihan' => 'Kolom deskripsi pelatihan harus diisi.',
                // 'image.*.max' => 'Poster tidak boleh lebih dari 2MB.',
            ]
        );

        // Simpan data pelatihan
        $pelatihan = new reguler;
        $pelatihan->nama_pelatihan = $request->nama_pelatihan;
        $pelatihan->id_tema = $request->id_tema;
        $pelatihan->fee_pelatihan = $request->fee_pelatihan;
        $pelatihan->metode_pelatihan = $request->metode_pelatihan;
        $pelatihan->lokasi_pelatihan = $request->lokasi_pelatihan;
        $pelatihan->kuota_peserta = $request->kuota_peserta;
        $pelatihan->tanggal_pendaftaran = $request->tanggal_pendaftaran;
        $pelatihan->tanggal_batas_pendaftaran = $request->tanggal_batas_pendaftaran;
        $pelatihan->tanggal_mulai = $request->tanggal_mulai;
        $pelatihan->tanggal_selesai = $request->tanggal_selesai;
        $pelatihan->deskripsi_pelatihan = $request->deskripsi_pelatihan;
        $pelatihan->save();

        // Simpan ID fasilitator dan ID pelatihan
        foreach ($request->id_fasilitator as $id_fasilitator) {
            $pelatihan->fasilitator_pelatihan()->attach($id_fasilitator, ['id_pelatihan' => $pelatihan->id_pelatihan]);
        }

        // dd($pelatihan);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $path = $file->storeAs('image', $file->getClientOriginalName()); // Simpan dengan nama asli
                $gambarPelatihan = new gambar_pelatihan(['path' => $path]);
                $gambarPelatihan->id_pelatihan = $pelatihan->id_pelatihan;
                $pelatihan->gambarPelatihan()->save($gambarPelatihan);
            }
        }

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $path = $file->storeAs('file', $file->getClientOriginalName()); // Simpan dengan nama asli
                $filePelatihan = new file_pelatihan(['path' => $path]);
                $filePelatihan->id_pelatihan = $pelatihan->id_pelatihan;
                $pelatihan->filePelatihan()->save($filePelatihan);
            }
        }


        return redirect()->route('dashboard.reguler.index')->with('success', 'Data berhasil disimpan');
    }
}
