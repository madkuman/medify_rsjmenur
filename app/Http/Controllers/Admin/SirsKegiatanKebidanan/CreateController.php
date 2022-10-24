<?php

namespace App\Http\Controllers\Admin\SirsKegiatanKebidanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKegiatanKebidanan;
use App\Models\Hospital\SIRSKegiatanKebidananICD9;
use App\Models\Hospital\SIRSKegiatanKebidananICD10;

class CreateController extends Controller
{
    public function create($data)
    {
    	$pendidikan = new MasterSIRSKegiatanKebidanan;
    	$pendidikan->nomor = $data['nomor'];
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	if(!empty($data['id-tindakan']))
    	{
	    	$icd9 = new SIRSKegiatanKebidananICD9;
	    	$icd9->sirs_id = $pendidikan->id;
	    	$icd9->tindakan_id = $data['id-tindakan'];
	    	$icd9->save();
    	}

    	if(!empty($data['id-diagnosis']))
    	{
	    	$icd10 = new SIRSKegiatanKebidananICD10;
	    	$icd10->sirs_id = $pendidikan->id;
	    	$icd10->diagnosis_id = $data['id-diagnosis'];
	    	$icd10->save();
    	}

    	return $pendidikan;
    }
}
