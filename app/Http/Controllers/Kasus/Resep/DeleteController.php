<?php

namespace App\Http\Controllers\Kasus\Resep;

use App\Models\Farmasi\TransaksiObat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Resep;
use App\Models\Kasus\Kasus;

use DB;
use Bugsnag;

class DeleteController extends Controller
{
	public function deleteResep(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
			$resep = Resep::find($request->id);
			$kasusId = $resep->kasus_id;
            $transId = $resep->transaksi_id;
            $transaksi = TransaksiObat::find($transId);
                if($transaksi && $transaksi->status != 0)
                {
                    DB::connection('kasus')->rollback();
                    DB::connection('mysql')->rollback();
                    $status = -1;
                    $message = 'Resep gagal dihapus! Transaksi sudah terlayani';
                    $title = 'Gagal!';
                    $nomorKasus = Kasus::where('id',$kasusId)->first();
                    return redirect('/kasus/'.$nomorKasus->nomor_kasus.'/datamedis/resep')
                        ->with('active_nav','resep')
                        ->with('message', $message)
                        ->with('title',$title)
                        ->with('status', $status);
                }
            app('App\Http\Controllers\Farmasi\Transaksi\DeleteController')->kasusDelete($transId);
			$resep->delete();

			$status = 1;
			$message = 'Resep berhasil dihapus!';
			$title = 'Berhasil!';
            $nomorKasus = Kasus::where('id',$kasusId)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasusId,'delete','resep',$resep->id);

			DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return redirect('/kasus/'.$nomorKasus->nomor_kasus.'/datamedis/resep')
            ->with('active_nav','resep')
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
