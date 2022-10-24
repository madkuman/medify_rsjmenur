<?php

namespace App\Http\Controllers\Admin\SirsKegiatanPerinatologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanPerinatologi\ReadController')->getAll();
    	return view('admin.sirs-kegiatan-perinatologi.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.sirs-kegiatan-perinatologi.create');
    }

    public function edit($id)
    {
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanPerinatologi\ReadController')->getById($id);
    	return view('admin.sirs-kegiatan-perinatologi.create',['data'=>$data]);
    }
}
