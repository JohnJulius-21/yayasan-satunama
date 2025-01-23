<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function index()
    {
        // $reguler = reguler::paginate(3);

        return view('admin.konsultasi.index');
    }

    public function create()
    {
        return view('admin.konsultasi.create');
    }
}
