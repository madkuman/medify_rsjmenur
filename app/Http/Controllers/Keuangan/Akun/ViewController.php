<?php

namespace App\Http\Controllers\Keuangan\Akun;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
	{
        $data['accounts'] = app('App\Http\Controllers\Keuangan\Akun\ReadController')->get();
        $data['sidebar_active'] = "pengaturan";
		return view('keuangan.akun.index',$data);
	}
}
