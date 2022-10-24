<?php

namespace App\Http\Controllers\Admin\Agama;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisAgama;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = JenisAgama::all();
    	return view('admin.agama.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.agama.create');
    }

    public function edit($id)
    {
    	$data = JenisAgama::where('id',$id)->first();
    	return view('admin.agama.create',['data'=>$data]);
    }
}
