<?php

namespace App\Http\Controllers\Admin\SirsSpesialisasiRujukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\SIRSSpesialisasiRujukanICD10;

class EditController extends Controller
{
    public function edit($id,$data)
    {
    	$pendidikan = app('App\Http\Controllers\Admin\SirsSpesialisasiRujukan\ReadController')->getById($id);
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	$flag = SIRSSpesialisasiRujukanICD10::where('sirs_id','=',$id)->where('diagnosis_id','=',$data['id-diagnosis'])->pluck('id');
    	if(!empty($data['id-diagnosis']) && !$flag->count())
    	{
	    	$pendidikan = new SIRSSpesialisasiRujukanICD10;
	    	$pendidikan->sirs_id = $id;
	    	$pendidikan->diagnosis_id = $data['id-diagnosis'];
	    	$pendidikan->save();
    	}

    	return $pendidikan;
    }	
}
