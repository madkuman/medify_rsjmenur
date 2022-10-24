<?php

namespace App\Http\Controllers\Admin\SirsSpesialisasiRujukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\SIRSSpesialisasiRujukanICD10;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = app('App\Http\Controllers\Admin\SirsSpesialisasiRujukan\ReadController')->getAll();
    	return view('admin.sirs-spesialisasi-rujukan.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.sirs-spesialisasi-rujukan.create');
    }

    public function edit($id)
    {
    	$data['data'] = app('App\Http\Controllers\Admin\SirsSpesialisasiRujukan\ReadController')->getById($id);
        $data['icd'] = SIRSSpesialisasiRujukanICD10::where('sirs_id',$id)->get();
    	return view('admin.sirs-spesialisasi-rujukan.create', $data);
    }
}
