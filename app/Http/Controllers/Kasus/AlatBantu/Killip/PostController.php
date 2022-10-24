<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Killip;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatKillip;
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
			
			$killip = new AlatKillip;
			$killip->kasus_id = $kasus->id;
			$killip->class = $request->class;
			$killip->created_by = Auth::user()->id;
			$killip->save();


			$status = 1;
			$message = 'Asesmen Killip berhasil dibuat';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-killip',$killip->id);

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
				$message = 'Asesmen Killip gagal dibuat!';
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
			$id = $request->id;
			$killip = AlatKillip::find($id);
			$killip->delete();

			$status = 1;
			$message = 'Asesmen Killip berhasil dihapus!';
			$title = 'Berhasil!';

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-killip',$killip->id);

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
				$message = 'Asesmen Killip gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
