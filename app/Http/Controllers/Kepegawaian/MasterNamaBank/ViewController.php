<?php

namespace App\Http\Controllers\Kepegawaian\MasterNamaBank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterNamaBank;

class ViewController extends Controller
{
    public function index()
	{
        $kualifikasi = app("App\Http\Controllers\Kepegawaian\MasterNamaBank\ReadController")->getData()->all();
        $data['kualifikasi'] = $kualifikasi;
        return view('kepegawaian.master.nama-bank.index',$data);
    }
    
    public function edit($id)
    {
        $data = app("App\Http\Controllers\Kepegawaian\MasterNamaBank\ReadController")->getData()->find($id);
        return response()->json($data);
    }
}
