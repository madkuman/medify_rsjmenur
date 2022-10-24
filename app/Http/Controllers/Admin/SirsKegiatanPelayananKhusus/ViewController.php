<?php

namespace App\Http\Controllers\Admin\SirsKegiatanPelayananKhusus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanPelayananKhusus\ReadController')->getAll();
    	return view('admin.sirs-kegiatan-pelayanan-khusus.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.sirs-kegiatan-pelayanan-khusus.create');
    }

    public function edit($id)
    {
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanPelayananKhusus\ReadController')->getById($id);
    	return view('admin.sirs-kegiatan-pelayanan-khusus.create',['data'=>$data]);
    }
}
