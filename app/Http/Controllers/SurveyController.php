<?php

namespace App\Http\Controllers;

use App\Models\reguler;
use App\Models\form_surveykepuasan_reguler;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function indexReguler()
    {
        $reguler = reguler::all();
        return view('admin.survey.reguler.index', compact('reguler'));
    }

    public function createReguler($id)
    {
        $reguler = reguler::findOrFail($id);
        return view('admin.survey.reguler.create', compact('reguler'));
    }

    public function storeReguler(Request $request)
    {
        $reguler = new form_surveykepuasan_reguler();
        $reguler->id_reguler = $request->id_reguler;
        $contentArray = json_decode($request->form, true);
        $reguler->content = $contentArray;
        $reguler->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('surveyRegulerAdmin')->with('success', 'Form berhasil disimpan.');
    }

    public function showReguler($id)
    {
        $reguler = reguler::findOrFail($id);
        return view('admin.survey.reguler.show', compact('reguler'));
    }

    public function editReguler($id)
    {
        $id_reguler = form_surveykepuasan_reguler::where('id_reguler', $id)->first();
        return $id_reguler;
    }
}
