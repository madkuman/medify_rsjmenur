<?php

namespace App\Http\Controllers\Gizi\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ViewController extends Controller
{
    public function index()
    {	
    	$status = 'pengaturan';
    	return view('gizi.pengaturan.index', ['status'=>$status]);
    }


}
