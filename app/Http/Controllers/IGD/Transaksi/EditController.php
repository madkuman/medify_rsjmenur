<?php

namespace App\Http\Controllers\IGD\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Transaksi;
use Carbon\Carbon;
use DB;
use Bugsnag;

class EditController extends Controller
{
	public function updateKasus($transaksi_id,$kasus_id)
	{
		DB::connection('igd')->beginTransaction();
        try
        {
    		$transaksi = Transaksi::find($transaksi_id);
    		$transaksi->kasus_id = $kasus_id;
    		$transaksi->save();
    		

    		DB::connection('igd')->commit();
            return $transaksi;

        } catch (\Exception $e) {
           	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('igd')->rollback();
            
        }
	}
    public function updateWaktuEntry($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->updated_at = Carbon::now();
        $transaksi->save();
        return $transaksi;
    }

    public function editTransaksiRM($transaksi_id,$transaksi_rm_id)
    {
        $transaksi = Transaksi::find($transaksi_id);
        $transaksi->rm_transaksi_id = $transaksi_rm_id;
        $transaksi->save();
        return $transaksi;
    }
}
