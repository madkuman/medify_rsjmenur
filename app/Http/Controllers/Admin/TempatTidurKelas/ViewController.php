<?php

namespace App\Http\Controllers\Admin\TempatTidurKelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = app('App\Http\Controllers\Admin\TempatTidurKelas\ReadController')->getAll();
    	return view('admin.tempat-tidur-kelas.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.tempat-tidur-kelas.create');
    }

    public function edit($id)
    {
    	$data = app('App\Http\Controllers\Admin\TempatTidurKelas\ReadController')->getById($id);
    	return view('admin.tempat-tidur-kelas.create',['data'=>$data]);
    }
}
