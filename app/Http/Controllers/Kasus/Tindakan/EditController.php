<?php

namespace App\Http\Controllers\Kasus\Tindakan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Tindakan;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\TagihanDetail;
use DB;
use Auth;
use Bugsnag;

class EditController extends Controller
{

	public function edit(Request $request, $nomor_kasus)
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
				$old_price = $tagihanDetail->subtotal;

				$tagihanDetail->desc = $request->desc;
				$tagihanDetail->subtotal = $request->price;
				$tagihanDetail->unit_price = $request->price;
				$tagihanDetail->tarif_id = $request->tarif_id;
				$tagihanDetail->tarif_tipe_id = $request->tarif_tipe_id;
				$tagihanDetail->tarif_kelas = $request->tarif_kelas;
				$tagihanDetail->departemen_id = $request->departemen_id;
				$tagihanDetail->save();

				$new_nominal = $request->price;

				$tagihan = app('App\Http\Controllers\Kasus\Tagihan\EditController')->edit_bill($tagihanDetail->kasus_tagihan_id,$new_nominal,$old_price);
			}

			if (!empty($request->icd_9)) {
				$tindakan->icd_9 = $request->icd_9;
			}
			
			$tindakan->desc = $request->desc;
			$tindakan->price= $request->price;
			$tindakan->save();


			$status = 1;
			$message = 'Tindakan berhasil diubah!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'edit','tindakan',$tindakan->id);

			
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

	public function subscribe($id)
	{
		$tindakan = Tindakan::find($id);
		$tindakan->subscribe = 1;
		$tindakan->subscribed_by = Auth::user()->id;
		$tindakan->save();
	}

	public function unsubscribe($id)
	{
		$tindakan = Tindakan::find($id);
		$tindakan->subscribe = 0;
		$tindakan->save();
	}

	public function massUnsubscribe($kasus_id)
	{
		$list_tindakan = Tindakan::where('kasus_id', $kasus_id)->get();

		if (!empty($list_tindakan)) {
			foreach ($list_tindakan as $key => $tindakan) {
				$tindakan->subscribe = 0;
				$tindakan->save();
			}
		}

		return $list_tindakan;
	}

    public function kesalahanTindakan($id)
    {
        $tindakan = Tindakan::find($id);
        $tindakan->kesalahan_tindakan = 1;
        $tindakan->kesalahan_tindakan_by = Auth::user()->id;
        $tindakan->kesalahan_tindakan_at=today();
        $tindakan->save();
    }

}
