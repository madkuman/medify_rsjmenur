<?php

namespace App\Http\Controllers\Kepegawaian\MasterSubkualifikasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterSubkualifikasi;
class ViewController extends Controller
{
    public function index()
	{
		$subkualifikasi = app("App\Http\Controllers\Kepegawaian\MasterSubkualifikasi\ReadController")->getData()->with('kualifikasi')->get();
		$kualifikasi = app("App\Http\Controllers\Kepegawaian\MasterKualifikasi\ReadController")->getData()->all();
		$data['subkualifikasi'] = $subkualifikasi;
		$data['kualifikasi'] = $kualifikasi;
		return view('kepegawaian.master.subkualifikasi.index',$data);
	}

	public function baru()
	{
		$data=[];
		return view('kepegawaian.master.subkualifikasi.form',$data);
	}

	public function edit($id)
	{
		$subkualifikasi = app("App\Http\Controllers\Kepegawaian\MasterSubkualifikasi\ReadController")->getData()->find($id);
		return response()->json($subkualifikasi);;
	}}
