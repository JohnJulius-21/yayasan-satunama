<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        // $reguler = reguler::paginate(3);

        return view('admin.survey.index');
    }

    public function create()
    {
        return view('admin.survey.create');
    }
}
