<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsuhanGizi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Auth;
use Carbon\Carbon;
use DB;

define('relasi', []);

class PostController extends Controller
{
	public function create($nomor_kasus, Request $req)
	{	
		DB::connection('kasus')->beginTransaction();
		$asuhan_gizi = [];
		$input = $req->all();

		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
            if(isset($req->id) && $req->id != 0){
				foreach($input as $key => $val){
					if($key == '_token')	continue;
					if($val == 'on') $val = 'YA';
					$asuhan_gizi[$key] = $val;
				}
				
				$alatBantu = AlatBantu::find($req->id);
				$alatBantu->val = json_encode($asuhan_gizi);
				$alatBantu->save();

				$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id,'create','alat-asuhan-gizi',$alatBantu->id);	

				$status = 1;
				$message = 'Asuhan Gizi berhasil diupdate';
				$title = 'Berhasil!';

				DB::connection('kasus')->commit();
            }else{
				foreach($input as $key => $val){
					if($key == '_token')	continue;
					if($val == 'on') $val = 'YA';
					$asuhan_gizi[$key] = $val;
				}

				$alatBantu = new AlatBantu;
				$alatBantu->kasus_id = $kasus->id;
				$alatBantu->type = "Asuhan Gizi";
				$alatBantu->created_by = Auth::user()->id;
				$alatBantu->val = json_encode($asuhan_gizi);
				$alatBantu->save();

				$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id,'create','alat-asuhan-gizi',$alatBantu->id);
				
				$status = 1;
				$message = 'Asuhan Gizi berhasil dibuat';
				$title = 'Berhasil!';

				DB::connection('kasus')->commit();
            }

            return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status)
				->with('active_nav', 'asesmen');

			
		} catch (Exception $e) {
			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Asuhan Gizi gagal dibuat/diupdate!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status)
				->with('active_nav', 'asesmen');
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
			$asuhan_gizi = AlatBantu::find($id);
			$asuhan_gizi->delete();

			$status = 1;
			$message = 'Asuhan Gizi berhasil dihapus!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-asuhan-gizi',$asuhan_gizi->id);

			DB::connection('kasus')->commit();
			
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status)
			->with('active_nav', 'asesmen');

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
				$message = 'Asuhan Gizi gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status)
				->with('active_nav', 'asesmen');
			}
		}
	}

	public function verifikasi($nomor_kasus, Request $req)
	{	
		DB::connection('kasus')->beginTransaction();
		$asuhan_gizi = [];

		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
            if(isset($req->id) && $req->id != 0){
				$alatBantu = AlatBantu::find($req->id);

				$alatBantu_val = json_decode($alatBantu->val);
				foreach ($alatBantu_val as $index => $value) {
					$asuhan_gizi[$index] = $value;
				}

				$asuhan_gizi['dpjp_verified_by'] = Auth::user()->id; 
				$asuhan_gizi['dpjp_verified_at'] = Carbon::now()->format('Y-m-d H:i:s'); 

				$alatBantu->val = json_encode($asuhan_gizi);
				$alatBantu->save();

				$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id,'create','alat-asuhan-gizi',$alatBantu->id);	

				$status = 1;
				$message = 'Asuhan Gizi terverifikasi';
				$title = 'Berhasil!';

				DB::connection('kasus')->commit();

            }else{
				$status = -1;
				$message = 'Asuhan Gizi Tidak Ditemukan!';
				$title = 'Gagal!';

				DB::connection('kasus')->commit();
            }

            return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status)
				->with('active_nav', 'asesmen');

			
		} catch (Exception $e) {
			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Asuhan gizi gagal diverifikasi!';
				$title = 'Gagal!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status)
				->with('active_nav', 'asesmen');
			}
		}
		
	}
}