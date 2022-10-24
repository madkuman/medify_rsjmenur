<?php

namespace App\Http\Controllers\Admin\SirsKegiatanGigiMulut;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanGigiMulut\ReadController')->getAll();
    	return view('admin.sirs-kegiatan-gigi-mulut.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.sirs-kegiatan-gigi-mulut.create');
    }

    public function edit($id)
    {
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanGigiMulut\ReadController')->getById($id);
    	return view('admin.sirs-kegiatan-gigi-mulut.create',['data'=>$data]);
    }
}
