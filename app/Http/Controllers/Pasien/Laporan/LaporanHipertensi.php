<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\ICD10;
use App\Models\Kasus\Diagnosis;

class LaporanHipertensi extends Controller
{
    public function get($start,$end)
    {
        $data['start'] = $start;
        $data['end'] = $end;
    	$query = ICD10::where('code_icd','like','%I10%')
    					->orWhere('code_icd','like','%I11%')
    					->orWhere('code_icd','like','%I12%')
    					->orWhere('code_icd','like','%I13%')
    					->orWhere('code_icd','like','%I14%')
    					->orWhere('code_icd','like','%I15%')
    					->orWhere('code_icd','like','%I16%')
    					->select('id')
    					->get();
    	$penyakit = $query->toArray();
    	//dd($query);
    	$data['hipertensi'] = Diagnosis::with(['kasus.pasien'])
                                ->whereIn('icd_10', $penyakit)->whereHas('kasus', function($q) use($start, $end){
                                    $q->from(config('app.db_name').'_kasus.kasus')->whereBetween('created_at', [$start, $end]);
                                })->groupBy('kasus_id')->get();
    	return $data;
    }
}
