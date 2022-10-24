<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisPegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
	{
        $kualifikasi = app("App\Http\Controllers\Kepegawaian\MasterJenisPegawai\ReadController")->getData()->all();
        $data['kualifikasi'] = $kualifikasi;
        return view('kepegawaian.master.jenis-pegawai.index',$data);
    }
    
    public function edit($id)
    {
        $data = app("App\Http\Controllers\Kepegawaian\MasterJenisPegawai\ReadController")->getData()->find($id);
        return response()->json($data);
    }
}
