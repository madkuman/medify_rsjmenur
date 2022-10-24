<?php

namespace App\Http\Controllers\Kasus\AlatBantu\ApacheII;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatApacheII;
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
			$gcs_val = 15-($request->gcs_eye+$request->gcs_verbal+$request->gcs_motor);

			//DETERMINE AGE SCORE
			$age = $kasus->identitas->age_year;
			if($age <= 44) $age_val = 0;
	        else if($age <= 54) $age_val = 2;
	        else if($age <= 64) $age_val = 3;
	        else if($age <= 74) $age_val = 5;
	        else $age_val = 6;

	        //DETERMINE TEMP SCORE
			if($request->temp < 30) $temp_val = 4;
	        else if($request->temp < 32) $temp_val = 3;
	        else if($request->temp < 34) $temp_val = 2;
	        else if($request->temp < 36) $temp_val = 1;
	        else if($request->temp < 38.5) $temp_val = 0;
	        else if($request->temp < 39) $temp_val = 1;
	        else if($request->temp < 41) $temp_val = 3;
	        else $temp_val = 4;

	        //DETERMINE MAP SCORE
			if($request->map <= 49) $map_val = 4;
	        else if($request->map <= 69) $map_val = 2;
	        else if($request->map <= 109) $map_val = 0;
	        else if($request->map <= 129) $map_val = 2;
	        else if($request->map <= 159) $map_val = 3;
	        else $map_val = 4;

	        //DETERMINE HEARTRATE SCORE
			if($request->heartrate < 40) $heartrate_val = 4;
	        else if($request->heartrate < 55) $heartrate_val = 3;
	        else if($request->heartrate < 70) $heartrate_val = 2;
	        else if($request->heartrate < 110) $heartrate_val = 0;
	        else if($request->heartrate < 140) $heartrate_val = 2;
	        else if($request->heartrate < 180) $heartrate_val = 3;
	        else $heartrate_val = 4;

	        //DETERMINE RESP RATE SCORE
			if($request->resp_rate < 6) $resp_rate_val = 4;
	        else if($request->resp_rate < 10) $resp_rate_val = 2;
	        else if($request->resp_rate < 12) $resp_rate_val = 1;
	        else if($request->resp_rate < 35) $resp_rate_val = 0;
	        else if($request->resp_rate < 35) $resp_rate_val = 1;
	        else if($request->resp_rate < 50) $resp_rate_val = 3;
	        else $resp_rate_val = 4;

	        //DETERMINE PH SCORE
			if($request->ph < 7.15) $ph_val = 4;
	        else if($request->ph < 7.25) $ph_val = 3;
	        else if($request->ph < 7.33) $ph_val = 2;
	        else if($request->ph < 7.5) $ph_val = 0;
	        else if($request->ph < 7.6) $ph_val = 1;
	        else if($request->ph < 7.7) $ph_val = 3;
	        else $ph_val = 4;

	        //DETERMINE SODIUM SCORE
			if($request->sodium < 111) $sodium_val = 4;
	        else if($request->sodium < 120) $sodium_val = 3;
	        else if($request->sodium < 130) $sodium_val = 2;
	        else if($request->sodium < 150) $sodium_val = 0;
	        else if($request->sodium < 155) $sodium_val = 1;
	        else if($request->sodium < 160) $sodium_val = 2;
	        else if($request->sodium < 180) $sodium_val = 3;
	        else $sodium_val = 4;

	        //DETERMINE POTASSIUM SCORE
			if($request->potassium < 2.5) $potassium_val = 4;
	        else if($request->potassium < 3) $potassium_val = 2;
	        else if($request->potassium < 3.5) $potassium_val = 1;
	        else if($request->potassium < 5.5) $potassium_val = 0;
	        else if($request->potassium < 6) $potassium_val = 1;
	        else if($request->potassium < 7) $potassium_val = 3;
	        else $potassium_val = 4;

	        //DETERMINE CREATININE SCORE
			if($request->creatinine < 0.6) $creatinine_val = 2;
	        else if($request->creatinine < 1.5) $creatinine_val = 0;
	        else if($request->creatinine < 2){
	        	$creatinine_val = ($request->renal == 0) ? 2 : 4 ;
	        }
	        else if($request->creatinine < 3.5){
	        	$creatinine_val = ($request->renal == 0) ? 3 : 6 ;
	        }
	        else{
	        	$creatinine_val = ($request->renal == 0) ? 4 : 8 ;
	        }

			//DETERMINE HEMATOCRIT SCORE
			if($request->hematocrit < 20) $hematocrit_val = 4;
	        else if($request->hematocrit < 30) $hematocrit_val = 2;
	        else if($request->hematocrit < 46) $hematocrit_val = 0;
	        else if($request->hematocrit < 50) $hematocrit_val = 1;
	        else if($request->hematocrit < 60) $hematocrit_val = 2;
	        else $hematocrit_val = 4;

	        //DETERMINE WHITE BLOOD SCORE
			if($request->white_blood < 1) $white_blood_val = 4;
	        else if($request->white_blood < 3) $white_blood_val = 2;
	        else if($request->white_blood < 15) $white_blood_val = 0;
	        else if($request->white_blood < 20) $white_blood_val = 1;
	        else if($request->white_blood < 40) $white_blood_val = 2;
	        else $white_blood_val = 4;

	        $score = $gcs_val+$age_val+$temp_val+$map_val+$heartrate_val+$resp_rate_val+$ph_val+$sodium_val+$potassium_val+$creatinine_val+$hematocrit_val+$white_blood_val+$request->history;
	        $score = (!empty($request->pao2)) ? $score+$request->pao2 : $score+$request->aa_grad ;
			
			$apache = new AlatApacheII;
			$apache->kasus_id = $kasus->id;
			$apache->gcs_eye = $request->gcs_eye;
			$apache->gcs_verbal = $request->gcs_verbal;
			$apache->gcs_motor = $request->gcs_motor;
			$apache->fio2 = $request->fio2;
			if (!empty($request->pao2)) {
				$apache->pao2 = $request->pao2;
			} else {
				$apache->aa_grad = $request->aa_grad;
			}
			$apache->history = $request->history;
			$apache->renal = $request->renal;
			$apache->temp = $request->temp;
			$apache->map = $request->map;
			$apache->heartrate = $request->heartrate;
			$apache->resp_rate = $request->resp_rate;
			$apache->ph = $request->ph;
			$apache->sodium = $request->sodium;
			$apache->potassium = $request->potassium;
			$apache->creatinine = $request->creatinine;
			$apache->hematocrit = $request->hematocrit;
			$apache->white_blood = $request->white_blood;
			$apache->score = $score;
			$apache->created_by = Auth::user()->id;
			$apache->save();

			$status = 1;
			$message = 'Asesmen Apache II berhasil dibuat';
			$title = 'Berhasil!';



			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-apache II',$apache->id);

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
				$message = 'Asesmen Apache II gagal dibuat!';
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

			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$id = $request->id;
			$apache = AlatApacheII::find($id);
			$apache->delete();

			$status = 1;
			$message = 'Asesmen Apache II berhasil dihapus!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-apache II',$apache->id);

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
				$message = 'Asesmen Apache II gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
