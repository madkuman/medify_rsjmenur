<?php

namespace App\Http\Controllers\Admin\Pernikahan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisPernikahan;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = JenisPernikahan::all();
    	return view('admin.pernikahan.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.pernikahan.create');
    }

    public function edit($id)
    {
    	$data = JenisPernikahan::where('id',$id)->first();
    	return view('admin.pernikahan.create',['data'=>$data]);
    }
}