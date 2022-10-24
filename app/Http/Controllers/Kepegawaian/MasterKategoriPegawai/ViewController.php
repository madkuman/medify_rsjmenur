<?php

namespace App\Http\Controllers\Kepegawaian\MasterKategoriPegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        return view('kepegawaian.master.kategori-pegawai.index');
    }
}
