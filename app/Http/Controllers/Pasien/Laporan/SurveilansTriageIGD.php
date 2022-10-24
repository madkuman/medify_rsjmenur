<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Triage;
use App\Models\Kasus\Kasus;

class SurveilansTriageIGD extends Controller
{
    	public function get($start,$end)
    	{
    		$triage = Triage::whereNotNull('kasus_id')->whereBetween('created_at',[$start,$end])->with('kasus.diagnosis.icd10','kasus.identitas','kasus.pasien')->orderBy('id','desc')->take(1000)->get();
    		$data['triage'] = $triage;
    		return $data;
    	}
}
