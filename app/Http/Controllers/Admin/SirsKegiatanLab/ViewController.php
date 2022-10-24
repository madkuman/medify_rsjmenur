<?php

namespace App\Http\Controllers\Admin\SirsKegiatanLab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanLab\ReadController')->getAll();
    	return view('admin.sirs-kegiatan-lab.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.sirs-kegiatan-lab.create');
    }

    public function edit($id)
    {
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanLab\ReadController')->getById($id);
    	return view('admin.sirs-kegiatan-lab.create',['data'=>$data]);
    }
}
