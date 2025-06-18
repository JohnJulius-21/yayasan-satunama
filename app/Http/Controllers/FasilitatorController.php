<?php

namespace App\Http\Controllers;

use App\Models\fasilitator;
use Illuminate\Http\Request;
use App\Models\internal_eksternal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FasilitatorController extends Controller
{
    public function index()
    {
        // $reguler = reguler::paginate(3);

        $fasilitator = fasilitator::orderBy('id_fasilitator')->get();
        return view('admin.fasilitator.index', compact('fasilitator'));
    }

    public function create()
    {
        return view('admin.fasilitator.create', [
            'internal_eksternal' => internal_eksternal::all()
        ]);
    }

    public function show($id_fasilitator)
    {
        $fasilitator = fasilitator::with('internal_eksternal')->where('id_fasilitator', '=', $id_fasilitator)->get();
        // dd($fasilitator);
        return view('admin.fasilitator.show', compact('fasilitator'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_fasilitator' => 'required',
            'email_fasilitator' => 'required|email:dns',
            'nomor_telepon' => 'required|numeric|digits:12',
            'alamat' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'gender' => 'required',
            'asal_lembaga' => 'required',
            'id_internal_eksternal' => 'required',
        ], [
            'nama_fasilitator.required' => 'Field nama fasilitator wajib diisi',
            'foto.image' => 'Field foto harus berformat gambar',
            'foto.max' => 'Field foto tidak boleh lebih dari 2mb',
            'nik.numeric' => 'Field nik harus berupa angka',
            'email_fasilitator.required' => 'Field email wajib diisi',
            'email_fasilitator.email' => 'Field email harus email yang valid',
            'nomor_telepon.required' => 'Field nomor telepon wajib diisi',
            'nomor_telepon.digits' => 'Field nomor telepon harus 12 angka',
            'id_internal_eksternal.required' => 'Field fasilitator internal atau eksternal wajib diisi',
            'alamat.required' => 'Field alamat wajib diisi',
            'gender.required' => 'Field jenis kelamin wajib diisi',
            'asal_lembaga.required' => 'Field asal lembaga wajib diisi',
        ]);
        $data = [
            'nama_fasilitator' => $request->nama_fasilitator,
            'email_fasilitator' => $request->email_fasilitator,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->gender,
            'id_internal_eksternal' => $request->id_internal_eksternal,
            'asal_lembaga' => $request->asal_lembaga,
            'body' => json_encode(array_filter($request->body)),
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
        ];

        $fasilitator = fasilitator::create($data);

        // Upload images ke Google Drive dan simpan ke database
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = $foto->getClientOriginalName();
            $path = Storage::disk('google')->putFileAs('', $foto, $filename);


            DB::table('fasilitator_foto')->insert([
                'id_fasilitator' => $fasilitator->id_fasilitator,
                'photo_url' => $filename, // Simpan hanya nama file di database
            ]);
        }
        return redirect()->route('fasilitatorAdmin')->with('success', 'Berhasil menambahkan fasilitator');
    }

    public function edit($id)
    {
        $fasilitator = fasilitator::with('internal_eksternal')->find($id);
        // dd($data);
        return view('admin.fasilitator.edit', compact('fasilitator'), [
            'internal_eksternal' => internal_eksternal::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_fasilitator' => 'required',
            'nik' => 'required|numeric|digits:16',
            'email_fasilitator' => 'required|email:dns',
            'nomor_telepon' => 'required|numeric|digits:12',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gender' => 'required',
            'asal_lembaga' => 'required',
            'id_internal_eksternal' => 'required',
        ], [
            'nama_fasilitator.required' => 'Field nama fasilitator wajib diisi',
            'nik.required' => 'Field nik wajib diisi',
            'foto.image' => 'Field foto harus berformat gambar',
            'foto.max' => 'Field foto tidak boleh lebih dari 2mb',
            'nik.numeric' => 'Field nik harus berupa angka',
            'nik.digits' => 'Field nik harus 16 angka',
            'email_fasilitator.required' => 'Field email wajib diisi',
            'email_fasilitator.email' => 'Field email harus email yang valid',
            'nomor_telepon.required' => 'Field nomor telepon wajib diisi',
            'nomor_telepon.digits' => 'Field nomor telepon harus 12 angka',
            'id_internal_eksternal.required' => 'Field fasilitator internal atau eksternal wajib diisi',
            'alamat.required' => 'Field alamat wajib diisi',
            'gender.required' => 'Field jenis kelamin wajib diisi',
            'asal_lembaga.required' => 'Field asal lembaga wajib diisi',
        ]);

        $fasilitator = fasilitator::findOrFail($id);

        $data = [
            'nama_fasilitator' => $request->nama_fasilitator,
            'nik' => $request->nik,
            'email_fasilitator' => $request->email_fasilitator,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->gender,
            'id_internal_eksternal' => $request->id_internal_eksternal,
            'asal_lembaga' => $request->asal_lembaga,
            'body' => json_encode(array_filter($request->body)),
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
        ];

        $fasilitator->update($data);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = $foto->getClientOriginalName();
            $path = Storage::disk('google')->putFileAs('', $foto, $filename);

            // Update or insert ke tabel fasilitator_foto
            DB::table('fasilitator_foto')->updateOrInsert(
                ['id_fasilitator' => $fasilitator->id_fasilitator],
                ['photo_url' => $filename]
            );
        }

        return redirect()->route('fasilitatorAdmin')->with('success', 'Berhasil mengupdate fasilitator');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fasilitator = fasilitator::find($id);
        $fasilitator->delete();

        return redirect()->route('fasilitatorAdmin')->with('success', 'Berhasil menghapus data');
    }

    public function createFasilitator()
    {
        return view('admin.fasilitator.fasilitator', [
            'internal_eksternal' => internal_eksternal::all()
        ]);
    }


    public function storeFasilitator(Request $request)
    {
        // return 'text';
        $request->validate([
            'nama_fasilitator' => 'required',
            'email_fasilitator' => 'required|email:dns',
            'nomor_telepon' => 'required|numeric|digits:12',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'jenis_kelamin' => 'required',
            'asal_lembaga' => 'required',
            'id_internal_eksternal' => 'required',
            'body' => 'required|array|min:1', // Ubah validasi untuk body
            'body.*' => 'required|string|min:3', // Validasi setiap item dalam array
        ], [
            'nama_fasilitator.required' => 'Field nama fasilitator wajib diisi',
            'foto.required' => 'Field foto wajib diisi',
            'foto.image' => 'Field foto harus berformat gambar',
            'foto.max' => 'Field foto tidak boleh lebih dari 2mb',
            'email_fasilitator.required' => 'Field email wajib diisi',
            'email_fasilitator.email' => 'Field email harus email yang valid',
            'nomor_telepon.required' => 'Field nomor telepon wajib diisi',
            'nomor_telepon.digits' => 'Field nomor telepon harus 12 angka',
            'id_internal_eksternal.required' => 'Field fasilitator internal atau eksternal wajib diisi',
            'alamat.required' => 'Field alamat wajib diisi',
            'jenis_kelamin.required' => 'Field jenis kelamin wajib diisi',
            'body.required' => 'Minimal satu keahlian wajib diisi',
            'body.min' => 'Minimal satu keahlian wajib diisi',
            'body.*.required' => 'Field keahlian wajib diisi',
            'body.*.min' => 'Keahlian minimal 3 karakter',
            'asal_lembaga.required' => 'Field asal lembaga wajib diisi',
        ]);

        try {
            // Simpan data fasilitator
            $fasilitator = Fasilitator::create([
                'nama_fasilitator' => $request->nama_fasilitator,
                'email_fasilitator' => $request->email_fasilitator,
                'nomor_telepon' => $request->nomor_telepon,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_internal_eksternal' => $request->id_internal_eksternal,
                'asal_lembaga' => $request->asal_lembaga,
                'facebook' => $request->facebook,
                'x' => $request->x,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
                'body' => json_encode(array_filter($request->body)),
            ]);

            // Upload images ke Google Drive dan simpan ke database
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $filename = $foto->getClientOriginalName();
                $path = Storage::disk('google')->putFileAs('', $foto, $filename);

                
                DB::table('fasilitator_foto')->insert([
                    'id_fasilitator' => $fasilitator->id_fasilitator,
                    'photo_url' => $filename, // Simpan hanya nama file di database
                ]);
            }

            

            return redirect()->back()->with('success', 'Data fasilitator berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }


}
