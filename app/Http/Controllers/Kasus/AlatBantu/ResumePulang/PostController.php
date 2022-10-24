<?php

namespace App\Http\Controllers\Kasus\AlatBantu\ResumePulang;

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

			$resume_pulang = [];
			$input = $req->all();
			$luka = "";
			foreach($input as $key => $val){
				if($key == '_token' || $key == 'resume_id') continue;
				elseif ($key == 'luka') {
					foreach ($val as $k => $item) {
						if ($k == 0) {
							$luka .= $item;
						} else {
							$luka .= ','.$item;
						}
						
					}
				}
				$resume_pulang[$key] = $val;
			}
			$resume_pulang['luka'] = $luka;

			$alatBantu = (!empty($input['resume_id'])) ? AlatBantu::find($input['resume_id']) : new AlatBantu ;
			$alatBantu->kasus_id = $kasus->id;
			$alatBantu->type = "Resume Pulang";
			$alatBantu->created_by = Auth::user()->id;
			$alatBantu->val = json_encode($resume_pulang);
			$alatBantu->save();

			if (!empty($input['resume_id'])) {
				$status = 1;
				$message = 'Asesmen Resume Pulang berhasil diubah';
				$title = 'Berhasil!';

				$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id,'edit','alat-Resume Pulang',$alatBantu->id);
			} else {
				$status = 1;
				$message = 'Asesmen Resume Pulang berhasil dibuat';
				$title = 'Berhasil!';

				$log = app('App\Http\Controllers\Kasus\Log\CreateController')
				->create($kasus->id,'create','alat-Resume Pulang',$alatBantu->id);
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
			$resume_pulang = AlatBantu::find($id);
			$resume_pulang->delete();

			$status = 1;
			$message = 'Asesmen Resume Pulang berhasil dihapus!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-resume-pulang',$resume_pulang->id);

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
				$message = 'Asesmen Resume Pulang gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}