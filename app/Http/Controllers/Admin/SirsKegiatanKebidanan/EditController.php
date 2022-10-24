<?php

namespace App\Http\Controllers\Admin\SirsKegiatanKebidanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\SIRSKegiatanKebidananICD9;
use App\Models\Hospital\SIRSKegiatanKebidananICD10;

class EditController extends Controller
{
    public function edit($id,$data)
    {
    	$pendidikan = app('App\Http\Controllers\Admin\SirsKegiatanKebidanan\ReadController')->getById($id);
    	$pendidikan->nomor = $data['nomor'];
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	$flag_9 = SIRSKegiatanKebidananICD9::where('sirs_id','=',$id)->where('tindakan_id','=',$data['id-tindakan'])->pluck('id');
    	if(!empty($data['id-tindakan']) && !$flag_9->count())
    	{
	    	$icd9 = new SIRSKegiatanKebidananICD9;
	    	$icd9->sirs_id = $id;
	    	$icd9->tindakan_id = $data['id-tindakan'];
	    	$icd9->save();
    	}

    	$flag_10 = SIRSKegiatanKebidananICD10::where('sirs_id','=',$id)->where('diagnosis_id','=',$data['id-diagnosis'])->pluck('id');
    	if(!empty($data['id-diagnosis']) && !$flag_10->count())
    	{
	    	$icd10 = new SIRSKegiatanKebidananICD10;
	    	$icd10->sirs_id = $id;
	    	$icd10->diagnosis_id = $data['id-diagnosis'];
	    	$icd10->save();
    	}

    	return $pendidikan;
    }	
}
