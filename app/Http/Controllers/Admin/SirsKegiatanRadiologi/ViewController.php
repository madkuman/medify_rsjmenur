<?php

namespace App\Http\Controllers\Admin\SirsKegiatanRadiologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanRadiologi\ReadController')->getAll();
    	return view('admin.sirs-kegiatan-radiologi.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.sirs-kegiatan-radiologi.create');
    }

    public function edit($id)
    {
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanRadiologi\ReadController')->getById($id);
    	return view('admin.sirs-kegiatan-radiologi.create',['data'=>$data]);
    }
}
