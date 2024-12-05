<?php

namespace App\Http\Controllers;

use App\Models\fasilitator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $fasilitator = fasilitator::all();
        // dd($fasilitator);
        return view('user/home',[
            'title' => 'Beranda',
             'fasilitator' => $fasilitator
        ]);
    }
}
