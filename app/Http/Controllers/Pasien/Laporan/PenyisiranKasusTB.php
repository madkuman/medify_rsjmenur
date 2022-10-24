<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\ICD10;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;

class PenyisiranKasusTB extends Controller
{
    	public function get($start,$end)
    	{
    		$query = ICD10::where('code_icd','like','%A15%')
		    		->orWhere('code_icd','like','%A16%')
		    		->orWhere('code_icd','like','%A17%')
		    		->orWhere('code_icd','like','%A18%')
		    		->orWhere('code_icd','like','%A19%')
		    		->select('id')
		    		->get();
    		$dx = $query->toArray();
    		$kasus_ids = Diagnosis::whereIn('icd_10',$dx)->whereBetween('created_at',[$start,$end])->pluck('kasus_id')->toArray();
    		$kasus = Kasus::whereIn('id',$kasus_ids)->with('lokasi.lokasi','pasien.alamat_kota','diagnosis.icd10','identitas')->orderBy('created_at')->get();
    		$data['kasus'] = $kasus;
    		$data['dx_tb'] = $dx;
    		return $data;


    	}
}

