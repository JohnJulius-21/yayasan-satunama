<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudiController extends Controller
{
    public function index()
    {
        // $reguler = reguler::paginate(3);

        return view('admin.studi.index');
    }

    public function create()
    {
        return view('admin.studi.create');
    }
}
