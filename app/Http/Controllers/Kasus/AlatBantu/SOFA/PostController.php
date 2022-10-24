<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SOFA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatSOFA;
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
			// dd($request);
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			//DETERMINE GCS
			$gcs_score = ($request->gcs_eye+$request->gcs_verbal+$request->gcs_motor);
			if($gcs_score < 6) $gcs_val = 4;
	        else if($gcs_score <= 9) $gcs_val = 3;
	        else if($gcs_score <= 12) $gcs_val = 2;
	        else if($gcs_score <= 14) $gcs_val = 1;
			else $gcs_val = 0;

			//DETERMINE PaO2/FiO2
			$mech_vent = (!empty($request->mech_vent)) ? $request->mech_vent : 0 ;
			if(empty($request->fio2) || $request->fio2 == 0) $ratio = 0;
			else $ratio = (float)$request->pao2*100.0/(float)$request->fio2;
			if($ratio >= 400) $ratio_val = 0;
	        else if($ratio >= 300) $ratio_val = 1;
	        else if($ratio >= 200) $ratio_val = 2;
	        else {
	        	if ($mech_vent > 0) {
					if($ratio < 100) $ratio_val = 4;
					else $ratio_val = 3;
				} else {
					$ratio_val = 2;
				}
	        }
	        $score = $gcs_val+$ratio_val+$request->platelets+$request->bilirubin+$request->cardiovascular+$request->creatinine;
			
			$sofa = new AlatSOFA;
			$sofa->kasus_id = $kasus->id;
			$sofa->gcs_eye = $request->gcs_eye;
			$sofa->gcs_verbal = $request->gcs_verbal;
			$sofa->gcs_motor = $request->gcs_motor;
			$sofa->pao2 = $request->pao2;
			$sofa->fio2 = $request->fio2;
			$sofa->mech_vent = $mech_vent;
			$sofa->platelets = $request->platelets;
			$sofa->bilirubin = $request->bilirubin;
			$sofa->cardiovascular = $request->cardiovascular;
			$sofa->creatinine = $request->creatinine;
			$sofa->score = $score;
			$sofa->created_by = Auth::user()->id;
			$sofa->save();

			$status = 1;
			$message = 'Asesmen SOFA berhasil dibuat';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-SOFA',$sofa->id);

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
				$message = 'Asesmen SOFA gagal dibuat!';
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
			$sofa = AlatSOFA::find($id);
			$sofa->delete();

			$status = 1;
			$message = 'Asesmen SOFA berhasil dihapus!';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-SOFA',$sofa->id);

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
				$message = 'Asesmen SOFA gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
