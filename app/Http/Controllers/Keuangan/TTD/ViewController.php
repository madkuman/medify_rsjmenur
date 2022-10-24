<?php

namespace App\Http\Controllers\Keuangan\TTD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
	{
        $data['ttd'] = app('App\Http\Controllers\Keuangan\TTD\ReadController')->get();
        $data['sidebar_active'] = "pengaturan";
		return view('keuangan.ttd.index',$data);
	}
}
