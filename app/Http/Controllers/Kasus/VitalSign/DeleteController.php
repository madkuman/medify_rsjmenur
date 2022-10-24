<?php

namespace App\Http\Controllers\Kasus\VitalSign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\VitalSign;
use App\Models\Kasus\Kasus;
use Auth;
use DB;
use Bugsnag;


class DeleteController extends Controller
{
    public function delete(Request $request, $nomor_kasus)
	{	
		DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
			$vital = VitalSign::find($request->id);
			$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();

			$vital->delete();

			$status = 1;
			$message = 'Vital Sign berhasil dihapus!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','vital',$vital->id);

			DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return redirect('/kasus/'.$nomor_kasus.'/datamedis/vital-sign')
			->with('active_nav','vital')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
	}
}
