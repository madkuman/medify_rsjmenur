<?php

namespace App\Http\Controllers\Kasus\Kolaborator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kolaborator;
use App\Models\Kasus\Kasus;
use DB;
use Bugsnag;
use Auth;
use Carbon\Carbon;

class PostController extends Controller
{
	public function delete(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$kolab = Kolaborator::find($request->id);
			$kasusId = $kolab->kasus_id;
			$kolab->delete();

			$status = 1;
			$message = 'Kolaborator berhasil dihapus!';
			$title = 'Berhasil!';

            $kasus = Kasus::find($kasusId);
            $kasus->last_update_kolaborator = Carbon::now();
            $kasus->save();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasusId,'delete','kolaborator',$kolab->id);

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

	public function keluarKasus($nomor_kasus)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
            	$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
			$kolab = Kolaborator::where('kasus_id',$kasus->id)->where('user_id',Auth::user()->id)->firstOrFail();
			$kolab->delete();

			$status = 1;
			$message = 'Anda berhasil keluar kasus!';
			$title = 'Berhasil!';

            $kasus->last_update_kolaborator = Carbon::now();
            $kasus->save();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','kolaborator',$kolab->id);

			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();

			return redirect('/')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {
			
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();

			$status = 1;
			$message = 'Gagal keluar kasus!';
			$title = 'Error!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}
}
