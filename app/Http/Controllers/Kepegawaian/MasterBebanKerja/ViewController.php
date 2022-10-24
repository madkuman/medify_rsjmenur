<?php

namespace App\Http\Controllers\Kepegawaian\MasterBebanKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ViewController extends Controller
{
	public function index()
	{
		$data['beban_kerja'] = app("App\Http\Controllers\Kepegawaian\MasterBebanKerja\ReadController")->getAllBeban();
		return view('kepegawaian.master.beban-kerja.index', $data);
	}
}
