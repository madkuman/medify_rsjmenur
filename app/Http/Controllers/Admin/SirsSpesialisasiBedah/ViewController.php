<?php

namespace App\Http\Controllers\Admin\SirsSpesialisasiBedah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = app('App\Http\Controllers\Admin\SirsSpesialisasiBedah\ReadController')->getAll();
    	return view('admin.sirs-spesialisasi-bedah.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.sirs-spesialisasi-bedah.create');
    }

    public function edit($id)
    {
    	$data = app('App\Http\Controllers\Admin\SirsSpesialisasiBedah\ReadController')->getById($id);
    	return view('admin.sirs-spesialisasi-bedah.create',['data'=>$data]);
    }
}
