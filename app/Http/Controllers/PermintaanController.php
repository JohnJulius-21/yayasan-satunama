<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    public function index()
    {
        // $reguler = reguler::paginate(3);

        return view('admin.permintaan.index');
    }

    public function create()
    {
        return view('admin.permintaan.create');
    }
}
