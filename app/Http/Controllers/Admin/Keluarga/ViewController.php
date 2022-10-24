<?php

namespace App\Http\Controllers\Admin\Keluarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisHubunganKeluarga;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = JenisHubunganKeluarga::all();
    	return view('admin.keluarga.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.keluarga.create');
    }

    public function edit($id)
    {
    	$data = JenisHubunganKeluarga::where('id',$id)->first();
    	return view('admin.keluarga.create',['data'=>$data]);
    }
}