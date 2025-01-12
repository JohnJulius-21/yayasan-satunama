<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegulerController extends Controller
{
    public function index()
    {
        // $reguler = reguler::paginate(3);

        return view('admin.reguler.index');
    }
}
