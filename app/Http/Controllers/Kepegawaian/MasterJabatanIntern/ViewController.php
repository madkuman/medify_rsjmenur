<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatanIntern;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJabatanIntern;


class ViewController extends Controller
{
    public function index()
	{
		$intern = MasterJabatanIntern::all();
		$data['intern'] = $intern;
		return view('kepegawaian.master.intern.index',$data);
	}


	public function edit($id)
	{
		$kualifikasi = app("App\Http\Controllers\Kepegawaian\MasterJabatanIntern\ReadController")->getData()->find($id);
		return response()->json($kualifikasi);
	}
}
