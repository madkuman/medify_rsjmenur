<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\ICD10;
use App\Models\Kasus\Diagnosis;

class LaporanSakitKronis extends Controller
{
	public function get($start,$end)
	{
        $bulan_start = $start->copy()->format('m');
        $bulan_end = $end->copy()->format('m');
        $bulan = app('App\Http\Controllers\Functions\DateFormatter')->intToMonth($bulan_end);
    	$data['bulan'] = ucfirst($bulan);
    	$penyakit = ICD10::where('code_icd','like','%B20%')
    					->orWhere('code_icd','like','%E11%')
    					->orWhere('code_icd','like','%E10%')
    					->orWhere('code_icd','like','%E11%')
    					->orWhere('code_icd','like','%E14%')
    					->orWhere('code_icd','like','%E04%')
    					->orWhere('code_icd','like','%I63%')
    					->orWhere('code_icd','like','%C50%')
    					->orWhere('code_icd','like','%A16%')
    					->orWhere('code_icd','like','%J45%')
    					->orWhere('code_icd','like','%I25%')
    					->orWhere('code_icd','like','%F20%')
    					->orWhere('code_icd','like','%C20%')
    					->orWhere('code_icd','like','%K29%')
    					->pluck('id')
    					->toArray();
    	$kasus_id = Diagnosis::whereIn('icd_10', $penyakit)->pluck('kasus_id')->toArray();

    	$data['kasus'] = Kasus::whereIn('id',$kasus_id)->whereBetween('krs_at', [$start, $end])->with('diagnosisUtama','resep.resepDetail')->get();
        return $data;
	}    
}
