<?php

namespace App\Http\Controllers\Admin\SirsKunjunganKegiatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = app('App\Http\Controllers\Admin\SirsKunjunganKegiatan\ReadController')->getAll();
    	return view('admin.sirs-kunjungan-kegiatan.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.sirs-kunjungan-kegiatan.create');
    }

    public function edit($id)
    {
    	$data = app('App\Http\Controllers\Admin\SirsKunjunganKegiatan\ReadController')->getById($id);
    	return view('admin.sirs-kunjungan-kegiatan.create',['data'=>$data]);
    }
}
