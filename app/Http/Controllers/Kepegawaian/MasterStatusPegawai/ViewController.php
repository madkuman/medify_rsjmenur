<?php

namespace App\Http\Controllers\Kepegawaian\MasterStatusPegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
	{
        $kualifikasi = app("App\Http\Controllers\Kepegawaian\MasterStatusPegawai\ReadController")->getData()->all();
        $data['kualifikasi'] = $kualifikasi;
        return view('kepegawaian.master.status-pegawai.index',$data);
    }
    
    public function edit($id)
    {
        $data = app("App\Http\Controllers\Kepegawaian\MasterStatusPegawai\ReadController")->getData()->find($id);
        return response()->json($data);
    }
}
