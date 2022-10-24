<?php

namespace App\Http\Controllers\Covid19\Statistik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
	public function index()
	{
		return view('covid19.statistik.index');
	}
}
