<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    public function indexReguler()
    {
        // $evaluasi = evaluasi::paginate(3);

        return view('admin.evaluasi.reguler.index');
    }

    public function createReguler()
    {
        return view('admin.evaluasi.reguler.create');
    }

    public function showReguler()
    {
        return view('admin.evaluasi.reguler.show');
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
