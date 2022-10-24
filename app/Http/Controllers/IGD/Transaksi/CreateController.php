<?php

namespace App\Http\Controllers\IGD\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Transaksi;
use App\Models\Pasien\Pasien;
use Carbon\Carbon;
use DB;
use Bugsnag;

class CreateController extends Controller
{
	public function create($data)
	{
		DB::connection('igd')->beginTransaction();
        try
        {
			$item = (object) $data;
			$transaksi = new Transaksi;
			$transaksi->ruangan_id = $item->ruangan_id;
			$transaksi->pasien_id = $item->pasien_id;
			if($item->kasus_id > 0)
			{
				$transaksi->kasus_id = $item->kasus_id;
			}
			$transaksi->waktu_masuk              = Carbon::now();    
			$transaksi->asal_rujukan             = $item->asal_rujukan; 
			$transaksi->nomor_sep                = $item->nomor_sep;
			$transaksi->pasien_pembayaran_id     = $item->bayar_id;      
			$transaksi->sirs_pelayanan_khusus_id = $item->sirs_pelayanan_khusus_id;
			//$transaksi->save();

			$pasien = Pasien::find($item->pasien_id);
			$transaksi->usia_masuk = $pasien->getAgeDayAttribute(Carbon::today()->toDateString());
			$transaksi->save();

			DB::connection('igd')->commit();
            return $transaksi;

        } catch (\Exception $e) {
           	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('igd')->rollback();
            
        }

	}
}
