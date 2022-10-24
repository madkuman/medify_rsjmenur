<?php

namespace App\Http\Controllers\Keuangan\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {	
    	$sidebar_active = 'kategori';
    	return view('keuangan.pengaturan.index',['sidebar_active'=>$sidebar_active]);
    }
}
