<?php

namespace App\Http\Controllers\Admin\SirsSpesialisasiRujukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSSpesialisasiRujukan;
use App\Models\Hospital\SIRSSpesialisasiRujukanICD10;

class CreateController extends Controller
{
    public function create($data)
    {
    	$spesialisasi = new MasterSIRSSpesialisasiRujukan;
    	$spesialisasi->nama = $data['nama'];
    	$spesialisasi->save();

    	if(!empty($data['id-diagnosis']))
    	{
	    	$icd = new SIRSSpesialisasiRujukanICD10;
	    	$icd->sirs_id = $spesialisasi->id;
	    	$icd->diagnosis_id = $data['id-diagnosis'];
	    	$icd->save();
    	}

    	return $spesialisasi;
    }
}
