<?php

namespace App\Http\Controllers\KamarOperasi\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
	public function index()
	{
		return view('kamaroperasi.pengaturan.index');
	}
}
