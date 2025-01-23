<?php

namespace App\Http\Controllers;

use App\Models\fasilitator;
use App\Models\internal_eksternal;
use Illuminate\Http\Request;

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
            'nik' => 'required|numeric|digits:16',
            'email_fasilitator' => 'required|email:dns',
            'nomor_telepon' => 'required|numeric|digits:12',
            'alamat' => 'required',
            'gender' => 'required',
            'asal_lembaga' => 'required',
            'id_internal_eksternal' => 'required',
            'body' => 'required',
        ], [
            'nama_fasilitator.required' => 'Field nama fasilitator wajib diisi',
            'nik.required' => 'Field nik wajib diisi',
            'nik.numeric' => 'Field nik harus berupa angka',
            'nik.digits' => 'Field nik harus 16 angka',
            'email_fasilitator.required' => 'Field email wajib diisi',
            'email_fasilitator.email' => 'Field email harus email yang valid',
            'nomor_telepon.required' => 'Field nomor telepon wajib diisi',
            'nomor_telepon.digits' => 'Field nomor telepon harus 12 angka',
            'id_internal_eksternal.required' => 'Field fasilitator internal atau eksternal wajib diisi',
            'alamat.required' => 'Field alamat wajib diisi',
            'gender.required' => 'Field jenis kelamin wajib diisi',
            'body.required' => 'Field tambahkan keahlian wajib diisi',
            'asal_lembaga.required' => 'Field asal lembaga wajib diisi',
        ]);
        $data = [
            'nama_fasilitator' => $request->nama_fasilitator,
            'nik' => $request->nik,
            'email_fasilitator' => $request->email_fasilitator,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->gender,
            'id_internal_eksternal' => $request->id_internal_eksternal,
            'asal_lembaga' => $request->asal_lembaga,
            'body' => $request->body,
        ];

        // $trix = new fasilitator_pelatihan_test();
        // $trix->body = $request->input('body');

        // // Cek apakah ada file yang diupload
        // if ($request->hasFile('body')) {
        //     $attachment = $request->file('body');

        //     // Simpan file ke dalam storage
        //     $path = Storage::putFile('public/attachments', $attachment);

        //     // Simpan path file ke dalam database
        //     $trix->attachment = $path;
        // }



        // dd($data);
        fasilitator::create($data);
        return redirect('fasilitatorAdmin')->with('success', 'Berhasil menambahkan fasilitator');
    }

    public function edit($id)
    {
        $fasilitator = fasilitator::with('internal_eksternal')->find($id);
        // dd($data);
        return view('admin.fasilitator.edit', compact('fasilitator'),[
            'internal_eksternal' => internal_eksternal::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_fasilitator)
    {
        // dd($request->all());
        $data = fasilitator::findOrFail($id_fasilitator);
        $data->nama_fasilitator = $request->nama_fasilitator;
        // $data->tempat_tgl_lahir = $request->tempat_tgl_lahir;
        $data->email_fasilitator = $request->email_fasilitator;
        $data->nomor_telepon = $request->nomor_telepon;
        $data->jenis_kelamin = $request->gender;
        // $data->id_internal_eksternal = $request->id_internal_eksternal;
        $data->asal_lembaga = $request->asal_lembaga;
        $data->body = $request->body;
        $data->save();

        return redirect('/admin/fasilitator')->with('success', 'Berhasil mengupdate data');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fasilitator = fasilitator::find($id);
        $fasilitator->delete();

        return redirect('/admin/fasilitator')->with('success', 'Berhasil menghapus data');
    }

}
