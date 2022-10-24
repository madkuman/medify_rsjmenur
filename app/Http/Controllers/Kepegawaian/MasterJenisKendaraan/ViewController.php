<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisKendaraan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        $kualifikasi = app("App\Http\Controllers\Kepegawaian\MasterJenisKendaraan\ReadController")->getData()->all();
        $data['kualifikasi'] = $kualifikasi;
        return view('kepegawaian.master.jeniskendaraan.index',$data);
    }

    public function edit($id)
    {
        $data = app("App\Http\Controllers\Kepegawaian\MasterJenisKendaraan\ReadController")->getData()->find($id);
        return response()->json($data);
    }
}
