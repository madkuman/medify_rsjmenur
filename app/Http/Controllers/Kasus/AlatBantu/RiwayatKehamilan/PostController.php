<?php

namespace App\Http\Controllers\Kasus\AlatBantu\RiwayatKehamilan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Auth;
use DB;

define('relasi', []);

class PostController extends Controller
{
	public function create($nomor_kasus, Request $req)
	{	
		DB::connection('kasus')->beginTransaction();
		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
			$max = 0;
			$temp_num = 0;
			$temp = "";
			$riwayat_kehamilan = [];
			$input = $req->all();
			foreach($input as $key => $val){
				if($key == '_token') continue;
				if($key == 'kasus')	continue;
				if($temp != $key)
				{	
					$temp_num = count($val);
					if($max < $temp_num) $max = $temp_num;
					$temp = $key;
					$riwayat_kehamilan[$key] = $val;
				}
			}
			$riwayat_kehamilan['max'] = $max;

			$alatBantu = new AlatBantu;
			$alatBantu->kasus_id = $kasus->id;
			$alatBantu->type = "Riwayat Kehamilan";
			$alatBantu->created_by = Auth::user()->id;
			$alatBantu->val = json_encode($riwayat_kehamilan);
			$alatBantu->save();


			$status = 1;
			$message = 'Riwayat Kehamilan berhasil dibuat';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-riwayat-kehamilan',$alatBantu->id);

			DB::connection('kasus')->commit();
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		} catch (Exception $e) {
			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Riwayat Kehamilan gagal dibuat!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}

	public function delete($nomor_kasus,Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{	
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
			$id = $request->id;
			$riwayat_kehamilan = AlatBantu::find($id);
			$riwayat_kehamilan->delete();

			$status = 1;
			$message = 'Riwayat Kehamilan berhasil dihapus!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-riwayat-kehamilan',$riwayat_kehamilan->id);

			DB::connection('kasus')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch (\Exception $e) {


			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Riwayat Kehamilan gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}