<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Kasus\ICD10;
use App\Models\Kasus\Diagnosis;
use App\Models\KamarOperasi\Transaksi as TransaksiOperasi;

class LaporanKatarakController extends Controller
{
    public function get($request)
    {
    	//dd($request);
    	$start = Carbon::parse($request->katarak_date_start)->startOfDay();
    	$end = Carbon::parse($request->katarak_date_end)->endOfDay();
    	$data['bulan'] = $request->katarak_bulan;
    	$data['tahun'] = $request->katarak_tahun;
    	$query = ICD10::where('code_icd','like','%H25%')
    					->select('id')
    					->get();
    	$penyakit = $query->toArray();
    	// dd($query);
    	$data['katarak_diagnosis'] = Diagnosis::with(['kasus.pasien','icd10'])
                                    ->whereIn('icd_10', $penyakit)->whereHas('kasus', function($q) use($start, $end){
							    		$q->from(config('app.db_name').'_kasus.kasus')->whereNotNull('is_baru')->whereBetween('created_at', [$start, $end]);
							    	})->groupBy('kasus_id')->get();
    	$data['katarak_operasi'] = TransaksiOperasi::whereIn('diagnosis_id', $penyakit)->get();
    	// dd($data['katarak_diagnosis'], $data['katarak_operasi']);
    	return $data;
    }
}
