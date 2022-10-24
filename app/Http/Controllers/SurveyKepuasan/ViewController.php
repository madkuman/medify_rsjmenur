<?php

namespace App\Http\Controllers\SurveyKepuasan;

use DB;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        return view('survey-kepuasan.survey.index');
    }
}
