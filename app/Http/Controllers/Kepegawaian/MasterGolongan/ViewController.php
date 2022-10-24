<?php

namespace App\Http\Controllers\Kepegawaian\MasterGolongan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        return view('kepegawaian.master.golongan.index');
    }
}
