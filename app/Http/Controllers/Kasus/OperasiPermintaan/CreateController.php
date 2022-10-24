<?php

namespace App\Http\Controllers\Kasus\OperasiPermintaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\OperasiPermintaan;
use App\Models\Kasus\Kasus;
use Auth;
use DB;
use Bugsnag;

class CreateController extends Controller
{
	public function create($kasus_id,$transaksi_id, $keterangan)
	{
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
    		$permintaan = new OperasiPermintaan;
    		$permintaan->kasus_id = $kasus_id;
    		$permintaan->transaksi_id = $transaksi_id;
    		$permintaan->created_by = Auth::user()->id;
            $permintaan->keterangan = $keterangan;
    		$permintaan->save();

    		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
    		->create($kasus_id,'create','permintaan-operasi',$permintaan->id);

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return $permintaan;

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }
}
