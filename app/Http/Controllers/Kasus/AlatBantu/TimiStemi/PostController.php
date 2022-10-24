<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TimiStemi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatTimiStemi;
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

			//DETERMINE AGE SCORE
			$year_prob = ($kasus->identitas->age_year < 65) ? 0 : (($kasus->identitas->age_year < 75) ? 2 : 3 ) ;
			$score = $year_prob+$request->dha_prob+$request->systol_bp_prob+$request->heartrate_prob+$request->killip_prob+$request->weight_prob+$request->aste_prob+$request->treat_time_prob;
			
			$stemi = new AlatTimiStemi;
			$stemi->kasus_id = $kasus->id;
			$stemi->year_prob = $year_prob;
			$stemi->dha_prob = $request->dha_prob;
			$stemi->systol_bp_prob = $request->systol_bp_prob;
			$stemi->heartrate_prob = $request->heartrate_prob;
			$stemi->killip_prob = $request->killip_prob;
			$stemi->weight_prob = $request->weight_prob;
			$stemi->aste_prob = $request->aste_prob;
			$stemi->treat_time_prob = $request->treat_time_prob;
			$stemi->score = $score;
			$stemi->created_by = Auth::user()->id;
			$stemi->save();

			$status = 1;
			$message = 'Asesmen TIMI Risk STEMI berhasil dibuat';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-timi stemi',$stemi->id);

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
				$message = 'Asesmen TIMI Risk STEMI gagal dibuat!';
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
			$stemi = AlatTimiStemi::find($id);
			$stemi->delete();

			$status = 1;
			$message = 'Asesmen TIMI Risk STEMI berhasil dihapus!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($stemi->kasus_id,'delete','alat-timi stemi',$stemi->id);

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
				$message = 'Asesmen TIMI Risk STEMI gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
