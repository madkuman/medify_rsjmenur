<?php

namespace App\Http\Controllers\Kasus\Operasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\OperasiPermintaan;
use DB;
use Auth;
use Bugsnag;

class DeleteController extends Controller
{
    public function tolak(Request $request)
    {	
    	DB::connection('kasus')->beginTransaction();
    	try
    	{
    		$permintaan = OperasiPermintaan::where('id',$request->id)->first();
    		//dd($permintaan);
    		app('App\Http\Controllers\KamarOperasi\Transaksi\DeleteController')->batalKasus($permintaan->transaksi_id);
    		$permintaan->deleted_by = Auth::user()->id;
    		$permintaan->save();
    		//$permintaan->delete();
    		
    		DB::connection('kasus')->commit();
    		
    		$status = 1;
            $message = 'Pembatalan permintaan operasi berhasil dilakukan.';
            $title = 'Berhasil!';

            return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);

    	}
    	catch (\Exception $e) 
    	{
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();
        }    	
    }
}
