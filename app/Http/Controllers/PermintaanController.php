<?php

namespace App\Http\Controllers;

use App\Models\permintaan;
use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    public function index()
    {
        $permintaan =permintaan::with('mitra')->get();

        return view('admin.permintaan.index', compact('permintaan'));
    }

    public function create()
    {
        return view('admin.permintaan.create');
    }
}
