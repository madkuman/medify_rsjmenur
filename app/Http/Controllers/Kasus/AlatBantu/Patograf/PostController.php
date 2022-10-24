<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Patograf;

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
		try {
			DB::connection('kasus')->beginTransaction();
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$patograf = [];
			$input = $req->all();
			foreach($input as $key => $val){
				if($key == '_token' || $key == 'patograf_id') continue;
				$patograf[$key] = $val;
			}

			$alatBantu = (!empty($input['patograf_id'])) ? AlatBantu::find($input['patograf_id']) : new AlatBantu;
			$alatBantu->kasus_id = $kasus->id;
			$alatBantu->type = "Patograf";
			$alatBantu->created_by = Auth::user()->id;
			$alatBantu->val = json_encode($patograf);
			$alatBantu->save();

			if (!empty($input['patograf_id'])) {
				$status = 1;
				$message = 'Asesmen Patograf berhasil diubah';
				$title = 'Berhasil!';

				$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id,'edit','alat-patograf',$alatBantu->id);
			} else {
				$status = 1;
				$message = 'Asesmen Patograf berhasil dibuat';
				$title = 'Berhasil!';

				$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id,'create','alat-patograf',$alatBantu->id);
			}

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
				$message = 'Asesmen Persalinan gagal dibuat!';
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
			$patograf = AlatBantu::find($id);
			$patograf->delete();

			$status = 1;
			$message = 'Asesmen Patograf berhasil dihapus!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-patograf',$patograf->id);

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
				$message = 'Asesmen Partograf gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}