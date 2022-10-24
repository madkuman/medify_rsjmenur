<?php

namespace App\Http\Controllers\CSSD\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
	{
		return view('cssd.pengaturan.index');
	}
}
