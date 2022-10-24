<?php

namespace App\Http\Controllers\Admin\TempatTidurJenis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = app('App\Http\Controllers\Admin\TempatTidurJenis\ReadController')->getAll();
    	return view('admin.tempat-tidur-jenis.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.tempat-tidur-jenis.create');
    }

    public function edit($id)
    {
    	$data = app('App\Http\Controllers\Admin\TempatTidurJenis\ReadController')->getById($id);
    	return view('admin.tempat-tidur-jenis.create',['data'=>$data]);
    }
}
