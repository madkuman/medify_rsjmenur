<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Persalinan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Auth;
use DB;


define('relasi', []);

class PostController extends Controller
{
    public function create($nomor_kasus,Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$persalinan = [];
			$input = $request->all();
			foreach($input as $key => $val){
				if($key == '_token' || $key == 'persalinan_id') continue;
				$persalinan[$key] = $val;
			}
											
			$persalinan['kala_iii_iv'] = (int) $persalinan['kala_iii'] + (int) $persalinan['kala_iv'];

			$alatBantu = (!empty($input['persalinan_id'])) ? AlatBantu::find($input['persalinan_id']) : new AlatBantu ;
			$alatBantu->kasus_id = $kasus->id;
			$alatBantu->type = "Persalinan";
			$alatBantu->created_by = Auth::user()->id;
			$alatBantu->val = json_encode($persalinan);
			$alatBantu->save();

			if (!empty($input['persalinan_id'])) {
				$status = 1;
				$message = 'Asesmen Persalinan berhasil diubah';
				$title = 'Berhasil!';

				$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id,'edit','alat-persalinan',$alatBantu->id);
			} else {
				$status = 1;
				$message = 'Asesmen Persalinan berhasil dibuat';
				$title = 'Berhasil!';

				$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id,'create','alat-persalinan',$alatBantu->id);
			}

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
				$message = 'Asesmen Persalinan gagal dibuat!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}

	}

	public function createBayi($nomor_kasus, Request $request)
	{

		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$persalinan = [];
		$input = $request->all();
		foreach($input as $key => $val){
			if($key == '_token' || $key == 'persalinan_id') continue;
			$persalinan[$key] = $val;
		}

		$persalinan['score_total_1'] = (int) $persalinan["score_denyut_1"] + 
		(int) $persalinan["score_pernafasan_1"] + 
		(int) $persalinan["score_tonus_1"] + 
		(int) $persalinan["score_peka_1"] + 
		(int) $persalinan["score_warna_1"];

		$persalinan['score_total_5'] = (int) $persalinan["score_denyut_5"] + 
		(int) $persalinan["score_pernafasan_5"] + 
		(int) $persalinan["score_tonus_5"] + 
		(int) $persalinan["score_peka_5"] + 
		(int) $persalinan["score_warna_5"];

		$persalinan['score_total_10'] = (int) $persalinan["score_denyut_10"] + 
		(int) $persalinan["score_pernafasan_10"] + 
		(int) $persalinan["score_tonus_10"] + 
		(int) $persalinan["score_peka_10"] + 
		(int) $persalinan["score_warna_10"];

		$alatBantu = (!empty($input['persalinan_bayi_id'])) ? AlatBantu::find($input['persalinan_bayi_id']) : new AlatBantu ;
		$alatBantu->parent_id = $request->parent_id;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = "persalinan-bayi";
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->val = json_encode($persalinan);
		$alatBantu->save();

		if (!empty($input['persalinan_bayi_id'])) {
			$status = 1;
			$message = 'Asesmen Persalinan Bayi berhasil diubah';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'edit','alat-persalinan',$alatBantu->id);
		} else {
			$status = 1;
			$message = 'Asesmen Persalinan Bayi berhasil dibuat';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-persalinan',$alatBantu->id);
		}
		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);

			
			
	}

	public function delete($nomor_kasus,Request $request)
	{

		DB::connection('kasus')->beginTransaction();
		try
		{	
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
			$id = $request->id;
			$persalinan = AlatBantu::find($id);
			$persalinan->delete();

			$status = 1;
			$message = 'Asesmen Persalinan berhasil dihapus!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-persalinan',$persalinan->id);

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
				$message = 'Asesmen Persalinan gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
