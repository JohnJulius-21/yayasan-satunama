<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CtgaController extends Controller
{
    public function index(){
        return view('user.training.ctga.index', [
            'title' => 'CTGA',
        ]);
    }
}
