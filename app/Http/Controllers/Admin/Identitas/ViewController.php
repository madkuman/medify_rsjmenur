<?php

namespace App\Http\Controllers\Admin\Identitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisKartuIdentitas;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = JenisKartuIdentitas::all();
    	return view('admin.identitas.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.identitas.create');
    }

    public function edit($id)
    {
    	$data = JenisKartuIdentitas::where('id',$id)->first();
    	return view('admin.identitas.create',['data'=>$data]);
    }
}