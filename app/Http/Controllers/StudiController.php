<?php

namespace App\Http\Controllers;

use App\Models\reguler;
use App\Models\form_studidampak_reguler;
use Illuminate\Http\Request;

class StudiController extends Controller
{
    public function indexReguler()
    {
        $reguler = reguler::all();
        return view('admin.studi.reguler.index', compact('reguler'));
    }

    public function createReguler($id)
    {
        $reguler = reguler::findOrFail($id);
        return view('admin.studi.reguler.create', compact('reguler'));
    }

    public function storeReguler(Request $request)
    {
        $reguler = new form_studidampak_reguler();
        $reguler->id_reguler = $request->id_reguler;
        $contentArray = json_decode($request->form, true);
        $reguler->content = $contentArray;
        $reguler->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('studiRegulerAdmin')->with('success', 'Form berhasil disimpan.');
    }

    public function showReguler($id)
    {
        $reguler = reguler::findOrFail($id);
        $form = form_studidampak_reguler::where('id_reguler', $id)->get();
        $showButtons = $form->isEmpty(); 
        return view('admin.studi.reguler.show', compact('reguler','form', 'showButtons'));
    }

    public function editReguler($id)
    {
        $id_reguler = form_studidampak_reguler::where('id_reguler', $id)->first();
        return $id_reguler;
    }
}
