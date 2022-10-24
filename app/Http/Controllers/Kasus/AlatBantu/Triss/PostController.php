<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Triss;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatTriss;
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
			
			//CALCULATE ISS
			$iss = [];
			array_push($iss, (int)$request->headneck);
			array_push($iss, (int)$request->face);
			array_push($iss, (int)$request->chest);
			array_push($iss, (int)$request->abdomen);
			array_push($iss, (int)$request->extremity);
			array_push($iss, (int)$request->external);
			rsort($iss);
			if (in_array(6, $iss)) {
				$iss_score = 75;
			} else {
				$iss_score = pow($iss[0], 2) + pow($iss[1], 2) + pow($iss[2], 2);
			}
			
			//CALCULATE RTS
			$gcs_score = ($request->gcs_eye+$request->gcs_verbal+$request->gcs_motor);
			if($gcs_score > 12) $gcs_val = 4;
	        else if($gcs_score > 8) $gcs_val = 3;
	        else if($gcs_score > 5) $gcs_val = 2;
	        else if($gcs_score > 3) $gcs_val = 1;
			else $gcs_val = 0;
			if($request->systol_bp > 89) $sbp_val = 4;
	        else if($request->systol_bp > 75) $sbp_val = 3;
	        else if($request->systol_bp > 49) $sbp_val = 2;
	        else if($request->systol_bp > 0) $sbp_val = 1;
			else $sbp_val = 0;
			if($request->resp_rate > 29) $rr_val = 3;
	        else if($request->resp_rate > 9) $rr_val = 4;
	        else if($request->resp_rate > 5) $rr_val = 2;
	        else if($request->resp_rate > 0) $rr_val = 1;
			else $rr_val = 0;
			$rts_score = (0.9368*$gcs_val)+(0.7326*$sbp_val)+(0.2908*$rr_val);

			//CALCULATE SURVIVAL PROBABILITY
			$blunt = -0.4499 + (0.8085*$rts_score) + (-0.0835*$iss_score) + (-1.743*($kasus->identitas->age_year < 55 ? 0 : 1));
			$penetrating = -2.5355 + (0.9934*$rts_score) + (-0.0651*$iss_score) + (-1.136*($kasus->identitas->age_year < 55 ? 0 : 1));
			$blunt_prob = 1/(1 + exp(-$blunt));
			$penetrating_prob = 1/(1 + exp(-$penetrating));

			$triss = new AlatTriss;
			$triss->kasus_id = $kasus->id;
			$triss->headneck = $request->headneck;
			$triss->face = $request->face;
			$triss->chest = $request->chest;
			$triss->abdomen = $request->abdomen;
			$triss->extremity = $request->extremity;
			$triss->external = $request->external;
			$triss->gcs_eye = $request->gcs_eye;
			$triss->gcs_verbal = $request->gcs_verbal;
			$triss->gcs_motor = $request->gcs_motor;
			$triss->systol_bp = $request->systol_bp;
			$triss->resp_rate = $request->resp_rate;
			$triss->iss_score = $iss_score;
			$triss->rts_score = $rts_score;
			$triss->blunt_prob = $blunt_prob*100;
			$triss->penetrating_prob = $penetrating_prob*100;
			$triss->created_by = Auth::user()->id;
			$triss->save();


			$status = 1;
			$message = 'Asesmen TRISS berhasil dibuat';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-triss',$triss->id);

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
				$message = 'Asesmen TRISS gagal dibuat!';
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
			$triss = AlatTriss::find($id);
			$triss->delete();

			$status = 1;
			$message = 'Asesmen TRISS berhasil dihapus!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($triss->kasus_id,'delete','alat-triss',$triss->id);

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
				$message = 'Asesmen TRISS gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
