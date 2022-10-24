<?php

namespace App\Http\Controllers\Admin\SirsKegiatanKesehatanJiwa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanKesehatanJiwa\ReadController')->getAll();
    	return view('admin.sirs-kegiatan-kesehatan-jiwa.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.sirs-kegiatan-kesehatan-jiwa.create');
    }

    public function edit($id)
    {
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanKesehatanJiwa\ReadController')->getById($id);
    	return view('admin.sirs-kegiatan-kesehatan-jiwa.create',['data'=>$data]);
    }
}
