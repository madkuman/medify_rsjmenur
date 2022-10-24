<?php

namespace App\Http\Controllers\Kepegawaian\MasterResikoKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ViewController extends Controller
{
	public function index()
	{
		$data['resiko_kerja'] = app("App\Http\Controllers\Kepegawaian\MasterResikoKerja\ReadController")->getAllResiko();
		return view('kepegawaian.master.resiko-kerja.index', $data);
	}
}
