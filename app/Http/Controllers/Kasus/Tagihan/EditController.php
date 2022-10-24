<?php

namespace App\Http\Controllers\Kasus\Tagihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\TagihanDetail;
use Carbon\Carbon;
use DB;
use Bugsnag;

class EditController extends Controller
{
	public function create_bill($tagihan_id,$nominal)
	{
		try {
			$tagihan = Tagihan::find($tagihan_id);
			$tagihan->total_bill = $tagihan->total_bill + $nominal;
			$tagihan->save();
			return 1;
		}
		catch (\Exception $e) {
			return 0;
		}
	}

	public function edit_bill($tagihan_id,$nominal_baru,$nominal_lama)
	{
		try {
			$tagihan = Tagihan::find($tagihan_id);
			$tagihan->total_bill = $tagihan->total_bill - $nominal_lama + $nominal_baru;
			$tagihan->save();
			return 1;
		}
		catch (\Exception $e) {
			return 0;
		}
	}

	public function delete_bill($tagihan_id,$nominal)
	{
		try {
			$tagihan = Tagihan::find($tagihan_id);
			$tagihan->total_bill = $tagihan->total_bill - $nominal;
			$tagihan->save();
			return 1;
		}
		catch (\Exception $e) {
			return 0;
		}
	}

	public function checkout($tagihan_id)
	{
		$tagihan = Tagihan::find($tagihan_id);
		$tagihan->checkout = 1;
		$tagihan->checkout_at = Carbon::now();
		$tagihan->save();
		return 1;
	}

	public function cancel(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{
			$tagihan = Tagihan::find($request->id);
			$tagihan->checkout = null;
			$tagihan->checkout_at = null;
            	app('App\Http\Controllers\Keuangan\Piutang\DeleteController')->deleteKasusTagihan($tagihan->id);
            	app('App\Http\Controllers\Kasir\Transaksi\DeleteController')->deleteKasusTagihan($tagihan->id);
			
			if($tagihan->save())
			{
				DB::connection('kasus')->commit();
				$status = 1;
		       	$message = 'Pembatalan checkout berhasil dilakukan.';
		        	$title = 'Berhasil!';

				return back()
			        ->with('message', $message)
			        ->with('title', $title)
			        ->with('status', $status);
			}				
		}
		catch (\Exception $e) 
    		{
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();
        }
		
	}



	public function editPaid($tagihan_id, $status)
	{	
		$tagihan = Tagihan::find($tagihan_id);
		$tagihan->is_paid = $status;
		$tagihan->save();
		return 1;
	}
}
