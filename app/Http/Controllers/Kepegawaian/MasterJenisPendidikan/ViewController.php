<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisPendidikan;


class ViewController extends Controller
{
    public function index()
	{
		$jenis_pendidikan = MasterJenisPendidikan::all();
		$data['jenis'] = $jenis_pendidikan;
		
		return view('kepegawaian.master.jenis-pendidikan.index', $data);
	}
}
