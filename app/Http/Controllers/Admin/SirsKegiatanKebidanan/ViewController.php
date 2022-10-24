<?php

namespace App\Http\Controllers\Admin\SirsKegiatanKebidanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\SIRSKegiatanKebidananICD9;
use App\Models\Hospital\SIRSKegiatanKebidananICD10;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = app('App\Http\Controllers\Admin\SirsKegiatanKebidanan\ReadController')->getAll();
    	return view('admin.sirs-kegiatan-kebidanan.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.sirs-kegiatan-kebidanan.create');
    }

    public function edit($id)
    {
    	$data['data'] = app('App\Http\Controllers\Admin\SirsKegiatanKebidanan\ReadController')->getById($id);
        $data['icd_9'] = SIRSKegiatanKebidananICD9::where('sirs_id',$id)->get();
        $data['icd_10'] = SIRSKegiatanKebidananICD10::where('sirs_id',$id)->get();
    	return view('admin.sirs-kegiatan-kebidanan.create',$data);
    }
}
