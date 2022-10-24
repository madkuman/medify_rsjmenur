<?php

namespace App\Http\Controllers\Kepegawaian\MasterMasaKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        return view('kepegawaian.master.masa-kerja.index');
    }
}
