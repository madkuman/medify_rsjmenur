<?php

namespace App\Http\Controllers\Kepegawaian\MasterKualifikasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterKualifikasi;

class ViewController extends Controller
{
	public function index()
	{
		$kualifikasi = app("App\Http\Controllers\Kepegawaian\MasterKualifikasi\ReadController")->getData()->all();
		$data['kualifikasi'] = $kualifikasi;
		return view('kepegawaian.master.kualifikasi.index',$data);
	}

	public function edit($id)
	{
		$kualifikasi = app("App\Http\Controllers\Kepegawaian\MasterKualifikasi\ReadController")->getData()->find($id);
		return response()->json($kualifikasi);
	}
}
