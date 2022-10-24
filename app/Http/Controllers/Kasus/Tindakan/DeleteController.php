<?php

namespace App\Http\Controllers\Kasus\Tindakan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Tindakan;
use App\Models\Kasus\TagihanDetail;
use App\Models\Kasus\Kasus;
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
			$tindakan = Tindakan::find($request->id);
			$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();

			if(!empty($tindakan->tagihan_detail_id))
			{
				$tagihanDetail = TagihanDetail::find($tindakan->tagihan_detail_id);

				if(!empty($tagihanDetail)){
					$tagihanDetail->delete();
	
					//$nominal_negatif = $tindakan->price * -1;
	
	
					$tagihan = app('App\Http\Controllers\Kasus\Tagihan\EditController')->edit_bill($tagihanDetail->kasus_tagihan_id,0,$tindakan->price);
				}
			}


			$tindakan->delete();


			$status = 1;
			$message = 'Tindakan berhasil dihapus!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','tindakan',$tindakan->id);
			
			if(!empty($tindakan->icd_9)) $tab = 'icd9';
			else $tab = 'tindakan';

			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			return redirect('/kasus/'.$nomor_kasus.'/datamedis/'.$tab)
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
