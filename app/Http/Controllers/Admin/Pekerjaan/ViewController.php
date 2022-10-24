<?php

namespace App\Http\Controllers\Admin\Pekerjaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisPekerjaan;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = JenisPekerjaan::all();
    	return view('admin.pekerjaan.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.pekerjaan.create');
    }

    public function edit($id)
    {
    	$data = JenisPekerjaan::where('id',$id)->first();
    	return view('admin.pekerjaan.create',['data'=>$data]);
    }
}