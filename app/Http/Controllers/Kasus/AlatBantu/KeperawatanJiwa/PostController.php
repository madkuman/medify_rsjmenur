<?php

namespace App\Http\Controllers\Kasus\AlatBantu\KeperawatanJiwa;

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

			$jiwa = [];
			$input = $req->all();
			foreach($input as $key => $val){
				if($key == '_token')	continue;
				$jiwa[$key] = $val=="on" ? 'Ya' : $val ;
			}

			$alatBantu = new AlatBantu;
			$alatBantu->kasus_id = $kasus->id;
			$alatBantu->type = "Keperawatan Jiwa";
			$alatBantu->created_by = Auth::user()->id;
			$alatBantu->val = json_encode($jiwa);
			$alatBantu->save();


			$status = 1;
			$message = 'Asesmen Keperawatan Jiwa berhasil dibuat';
			$title = 'Berhasil!';



			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-resume-pulang',$alatBantu->id);

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
			$jiwa = AlatBantu::find($id);
			$jiwa->delete();

			$status = 1;
			$message = 'Asesmen Keperawatan Jiwa berhasil dihapus!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-resume-pulang',$jiwa->id);

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
				$message = 'Asesmen Keperawatan Jiwa gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}