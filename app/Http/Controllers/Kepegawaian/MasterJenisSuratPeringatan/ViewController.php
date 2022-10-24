<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisSuratPeringatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
	{
        $kualifikasi = app("App\Http\Controllers\Kepegawaian\MasterJenisSuratPeringatan\ReadController")->getData()->all();
        $data['kualifikasi'] = $kualifikasi;
        return view('kepegawaian.master.jenis-surat-peringatan.index',$data);
    }
    
    public function edit($id)
    {
        $data = app("App\Http\Controllers\Kepegawaian\MasterJenisSuratPeringatan\ReadController")->getData()->find($id);
        return response()->json($data);
    }
}
