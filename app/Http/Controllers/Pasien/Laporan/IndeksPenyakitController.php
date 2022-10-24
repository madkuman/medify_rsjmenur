<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;

class IndeksPenyakitController extends Controller
{
	public function get($start,$end,$layanan)
	{
		$diagnosis = Diagnosis::groupBy('icd_10')->orderBy('icd_10')->get();
		foreach($diagnosis as $item)
		{
			if($layanan == 'all'){
				$kasus = Kasus::whereBetween('created_at',array($start,$end))->whereHas('diagnosis', function($q) use ($item){
					$q->where('icd_10',$item->icd_10);
				})->where('tipe_mc','0')->with('lokasi.lokasi')->get();
			}
			elseif($layanan == 'ri'){
				$kasus = Kasus::whereBetween('created_at',array($start,$end))->whereHas('diagnosis', function($q) use ($item){
					$q->where('icd_10',$item->icd_10);
				})->where('tipe_mc','0')->where('tipe_ri',1)->with('lokasi.lokasi')->get();
			}
			elseif($layanan == 'igd'){
				$kasus = Kasus::whereBetween('created_at',array($start,$end))->whereHas('diagnosis', function($q) use ($item){
					$q->where('icd_10',$item->icd_10);
				})->where('tipe_mc','0')->where('tipe_igd',1)->with('lokasi.lokasi')->get();
			}
			elseif($layanan == 'rj'){
				$kasus = Kasus::whereBetween('created_at',array($start,$end))->whereHas('diagnosis', function($q) use ($item){
					$q->where('icd_10',$item->icd_10);
				})->where('tipe_mc','0')->where('tipe_rj',1)->with('lokasi.lokasi')->get();
			}

			$item->kasus = $kasus;
		}

		return $diagnosis;
	}
}
