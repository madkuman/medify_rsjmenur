<?php

namespace App\Http\Controllers\Admin\SirsCaraBayar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = app('App\Http\Controllers\Admin\SirsCaraBayar\ReadController')->getAll();
    	return view('admin.sirs-cara-bayar.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.sirs-cara-bayar.create');
    }

    public function edit($id)
    {
    	$data = app('App\Http\Controllers\Admin\SirsCaraBayar\ReadController')->getById($id);
    	return view('admin.sirs-cara-bayar.create',['data'=>$data]);
    }
}
