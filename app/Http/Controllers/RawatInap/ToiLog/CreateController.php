<?php

namespace App\Http\Controllers\RawatInap\ToiLog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\ToiLog;
use Carbon\Carbon;


class CreateController extends Controller
{
	public function create($tempat_tidur_id,$transaksi_id){

		$log = new ToiLog;
		$log->tempat_tidur_id = $tempat_tidur_id;
		$log->pasien_akhir_transaksi_id = $transaksi_id;
		$log->save();

		return $log;
	}
}
