<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\ICD10;

class LaporanPenderitaKanker extends Controller
{
	public function get($start,$end)
	{	
		$icd10 = ICD10::where('tags','LIKE','%kanker%')->pluck('id')->toArray();

		$kasus = Kasus::whereBetween('created_at',[$start,$end])
		->whereHas('diagnosis',function($q) use ($icd10){
			$q->whereIn('icd_10',$icd10);
		})->with('pasien','identitas','pembayaran.perusahaan.tipe','diagnosis.icd10')->get();

		return $kasus;
	}
}
