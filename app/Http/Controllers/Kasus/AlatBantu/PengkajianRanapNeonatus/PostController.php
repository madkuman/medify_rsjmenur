<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PengkajianRanapNeonatus;

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
		// dd($req);
		DB::connection('kasus')->beginTransaction();
		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$neonatus = [];
			$input = $req->all();
			foreach($input as $key => $val){
				if($key == '_token' || $key == 'neonatus_id') continue;
				$neonatus[$key] = $val;
			}

			$alatBantu = (!empty($input['neonatus_id'])) ? AlatBantu::find($input['neonatus_id']) : new AlatBantu;
			$alatBantu->kasus_id = $kasus->id;
			$alatBantu->type = "Neonatus";
			$alatBantu->created_by = Auth::user()->id;
			$alatBantu->val = json_encode($neonatus);
			$alatBantu->save();

			if (!empty($input['neonatus_id'])) {
				$status = 1;
				$message = 'Asesmen Neonatus berhasil diubah';
				$title = 'Berhasil!';

				$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id,'edit','alat-neonatus',$alatBantu->id);
			} else {
				$status = 1;
				$message = 'Asesmen Neonatus berhasil dibuat';
				$title = 'Berhasil!';

				$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id,'create','alat-neonatus',$alatBantu->id);
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
			$neonatus = AlatBantu::find($id);
			$neonatus->delete();

			$status = 1;
			$message = 'Asesmen Neonatus berhasil dihapus!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-neonatus',$neonatus->id);

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
				$message = 'Asesmen Neonatus gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}