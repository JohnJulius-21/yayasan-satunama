<?php

namespace App\Http\Controllers;

use App\Models\reguler;
use App\Models\form_evaluasi_reguler;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    public function indexReguler()
    {
        // $evaluasi = evaluasi::paginate(3);
        $reguler = reguler::all();

        return view('admin.evaluasi.reguler.index', compact('reguler'));
    }

    public function createReguler($id)
    {
        $reguler = reguler::findOrFail($id);
        return view('admin.evaluasi.reguler.create', compact('reguler'));
    }

    public function storeReguler(Request $request)
    {
        $reguler = new form_evaluasi_reguler();
        $reguler->id_reguler = $request->id_reguler;
        $contentArray = json_decode($request->form, true);
        $reguler->content = $contentArray;
        $reguler->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('evaluasiRegulerAdmin')->with('success', 'Form berhasil disimpan.');
    }

    public function showReguler($id)
    {
        $reguler = reguler::findOrFail($id);
        return view('admin.evaluasi.reguler.show', compact('reguler'));
    }

    public function editReguler($id)
    {
        $id_reguler = form_evaluasi_reguler::where('id_reguler', $id)->first();
        return $id_reguler;
    }

    public function indexPermintaan()
    {
        // $evaluasi = evaluasi::paginate(3);

        return view('admin.evaluasi.permintaan.index');
    }

    public function createPermintaan()
    {
        return view('admin.evaluasi.permintaan.create');
    }

    public function showPermintaan()
    {
        return view('admin.evaluasi.permintaan.show');
    }
}
