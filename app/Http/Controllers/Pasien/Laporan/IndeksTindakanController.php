<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Tindakan;
use App\Models\Kasus\Kasus;

class IndeksTindakanController extends Controller
{
	public function get($start,$end,$layanan)
	{
		$tindakan = Tindakan::whereNotNull('icd_9')->groupBy('icd_9')->orderBy('icd_9')->get();
		foreach($tindakan as $item)
		{
			if($layanan == 'all'){
				$kasus = Kasus::whereBetween('created_at',array($start,$end))->whereHas('tindakan_icd9', function($q) use ($item){
					$q->where('icd_9',$item->icd_9);
				})->where('tipe_mc','0')->with('lokasi.lokasi')->get();
			}
			elseif($layanan == 'ri'){
				$kasus = Kasus::whereBetween('created_at',array($start,$end))->whereHas('tindakan_icd9', function($q) use ($item){
					$q->where('icd_9',$item->icd_9);
				})->where('tipe_mc','0')->where('tipe_ri',1)->with('lokasi.lokasi')->get();
			}
			elseif($layanan == 'igd'){
				$kasus = Kasus::whereBetween('created_at',array($start,$end))->whereHas('tindakan_icd9', function($q) use ($item){
					$q->where('icd_9',$item->icd_9);
				})->where('tipe_mc','0')->where('tipe_igd',1)->with('lokasi.lokasi')->get();
			}
			elseif($layanan == 'rj'){
				$kasus = Kasus::whereBetween('created_at',array($start,$end))->whereHas('tindakan_icd9', function($q) use ($item){
					$q->where('icd_9',$item->icd_9);
				})->where('tipe_mc','0')->where('tipe_rj',1)->with('lokasi.lokasi')->get();
			}

			$item->kasus = $kasus;
		}

		return $tindakan;
	}
	
}
