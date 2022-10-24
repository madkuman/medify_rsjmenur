<?php

namespace App\Http\Controllers\Admin\SirsKegiatanRehabMedik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanRehabMedik\ReadController')->getAll();
    	return view('admin.sirs-kegiatan-rehab-medik.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.sirs-kegiatan-rehab-medik.create');
    }

    public function edit($id)
    {
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanRehabMedik\ReadController')->getById($id);
    	return view('admin.sirs-kegiatan-rehab-medik.create',['data'=>$data]);
    }
}
