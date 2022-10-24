<?php

namespace App\Http\Controllers\RawatInap\ToiLog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\ToiLog;
use Carbon\Carbon;

class EditController extends Controller
{
	public function updateMrs($tempat_tidur_id,$transaksi_id)
	{
		$log = ToiLog::where('tempat_tidur_id',$tempat_tidur_id)->whereNull('pasien_baru_transaksi_id')->first();
		if(!empty($log->id)){

			$log->pasien_baru_mrs_at = Carbon::now();
			$log->pasien_baru_transaksi_id = $transaksi_id;
			$log->save();

			$log->selisih_hari = $log->pasien_baru_mrs_at->diffInDays($log->pasien_akhir_krs_at);
			$log->save();
		}

		$log = app('App\Http\Controllers\RawatInap\ToiLog\CreateController')
			->create($tempat_tidur_id,$transaksi_id);

		return $log;

	}

	public function updateKrs($tempat_tidur_id,$transaksi_id)
	{
		$log = ToiLog::where('tempat_tidur_id',$tempat_tidur_id)->where('pasien_akhir_transaksi_id',$transaksi_id)->first();
		if(!empty($log->id)){
			$log->pasien_akhir_krs_at = Carbon::now();
			$log->save();
		}
		else
		{
			$log = app('App\Http\Controllers\RawatInap\ToiLog\CreateController')
			->create($tempat_tidur_id,$transaksi_id);
			$log->pasien_akhir_krs_at = Carbon::now();
			$log->save();
		}
		return $log;
	}
}
