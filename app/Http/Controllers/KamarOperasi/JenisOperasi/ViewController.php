<?php

namespace App\Http\Controllers\KamarOperasi\JenisOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\JenisOperasi;

class ViewController extends Controller
{
	public function index()
	{
		$data['jenis'] = JenisOperasi::all();
		return view('kamaroperasi.jenis-operasi.index',$data);
	}
}
