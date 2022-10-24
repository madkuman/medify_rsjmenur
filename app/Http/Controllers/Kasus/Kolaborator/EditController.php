<?php

namespace App\Http\Controllers\Kasus\Kolaborator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kolaborator;
use App\Models\Kasus\Kasus;
use DB;
use Bugsnag;
use Carbon\Carbon;

class EditController extends Controller
{
	public function admin($nomor_kasus, Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$user_id = $request->id;


			$old_admin = Kolaborator::where('admin',1)->where('kasus_id',$kasus->id)->first();
			if(!empty($old_admin))
			{			
				$old_admin->admin = 0;
				$old_admin->save();
			}
			$kolaborator = Kolaborator::with('user')->where('user_id',$user_id)->where('kasus_id',$kasus->id)->first();
			$kolaborator->admin = 1;
			$kolaborator->save();

            $kasus->last_update_kolaborator = Carbon::now();
            $kasus->save();
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'edit','kolab-admin',$kolaborator->id);
			app('App\Http\Controllers\Kasus\BPJS\PostController')->updateDPJP($kasus->sep_id, $kolaborator->user->kode_dpjp);

			$status = 1;
			$message = 'Berhasil merubah admin!';
			$title = 'Berhasil!';
			
			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();

		}
	}

	public function tolakUndangan(Request $request)
	{
		$kolab = Kolaborator::find($request->id);
		$kolab->invitation = -1;
		$kolab->admin = 0;
		$kolab->save();

		$kasus = Kasus::find($kolab->kasus_id);
        $kasus->last_update_kolaborator = Carbon::now();
        $kasus->save();

		$status = 1;
		$message = 'Berhasil menolak undangan';
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}


	public function terimaUndangan(Request $request)
	{
		$kolab = Kolaborator::find($request->id);
		$kolab->invitation = 1;
		$kolab->save();

		$kasus = Kasus::find($kolab->kasus_id);
        $kasus->last_update_kolaborator = Carbon::now();
        $kasus->save();

		$status = 1;
		$message = 'Berhasil menerima undangan';
		$title = 'Selamat Datang!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function updateStatus($kolab_id,$status)
	{
		$kolab = Kolaborator::find($kolab_id);
		if(!empty($kolab->id))
		{
			$kolab->invitation = $status;
			$kolab->save();
			return $kolab;
		}
		return 0;
	}
}
