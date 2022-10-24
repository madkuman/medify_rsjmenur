<?php

namespace App\Http\Controllers\Kasus\Tindakan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function subscribe(Request $req, $nomor_kasus)
    {
    	
		DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
        	$tindakan = app('App\Http\Controllers\Kasus\Tindakan\EditController')
			->subscribe($req->id);
			
			DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();

            $status = 1;
			$message = 'Tindakan berhasil dijadwalkan secara rutin!';
			$title = 'Berhasil!';
            return redirect('/kasus/'.$nomor_kasus.'/datamedis/tindakan')
            ->with('active_nav','tindakan')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }
    public function unsubscribe(Request $req, $nomor_kasus)
    {
    	DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {

        	$tindakan = app('App\Http\Controllers\Kasus\Tindakan\EditController')
			->unsubscribe($req->id);
			
			DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();

            $status = 1;
			$message = 'Jadwal rutin tindakan berhasil dihentikan!';
			$title = 'Berhasil!';
            return redirect('/kasus/'.$nomor_kasus.'/datamedis/tindakan')
            ->with('active_nav','tindakan')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }
    public function kesalahanTindakan(Request $req, $nomor_kasus)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {

            $tindakan = app('App\Http\Controllers\Kasus\Tindakan\EditController')
                ->kesalahanTindakan($req->id);

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();

            $status = 1;
            $message = 'Kesalahan tindakan berhasil dimasukkan!';
            $title = 'Berhasil!';
            return redirect('/kasus/'.$nomor_kasus.'/datamedis/tindakan')
                ->with('active_nav','tindakan')
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
