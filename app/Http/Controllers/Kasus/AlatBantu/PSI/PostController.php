<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PSI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatPSI;
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

			//DETERMINE class
			
			$age = $kasus->identitas->age_year;
			$sex = $kasus->identitas->jenis_kelamin == 'L' ? 0 : 10;
			$age_score = $age - $sex;
			$score = $age_score+$request->nursing_home_res+array_sum($request->comorbid)+array_sum($request->pe)+array_sum($request->lab);
			if ($kasus->identitas->age_year <= 50 && array_sum($request->comorbid)+array_sum($request->pe)+array_sum($request->lab) == 0) {
				$class = 'Risk class I, 0.1% mortality';
			} else {
				if($score <= 70) $class = 'Risk class II, 0.6-0.9% mortality';
		        else if($score <= 90) $class = 'Risk class III, 0.9-2.8% mortality';
		        else if($score <= 130) $class = 'Risk class IV, 8.2-9.3% mortality';
		        else $class = 'Risk class V, 27.0-29.2% mortality';
			}
			
			$psi = new AlatPSI;
			$psi->kasus_id = $kasus->id;
			$psi->nursing_home_res = $request->nursing_home_res;
			$psi->neoplastic = $request->comorbid[0];
			$psi->liver = $request->comorbid[1];
			$psi->chf = $request->comorbid[2];
			$psi->cerebrovascular = $request->comorbid[3];
			$psi->renal = $request->comorbid[4];
			$psi->altered_mental = $request->pe[0];
			$psi->resp_rate = $request->pe[1];
			$psi->systol_bp = $request->pe[2];
			$psi->temp = $request->pe[3];
			$psi->pulse = $request->pe[4];
			$psi->ph = $request->lab[0];
			$psi->bun = $request->lab[1];
			$psi->sodium = $request->lab[2];
			$psi->glucose = $request->lab[3];
			$psi->hematocrit = $request->lab[4];
			$psi->ppo2 = $request->lab[5];
			$psi->pleural_eff = $request->lab[6];
			$psi->score = $score;
			$psi->class = $class;
			$psi->created_by = Auth::user()->id;
			$psi->save();

			$status = 1;
			$message = 'Asesmen PSI berhasil dibuat';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-PSI',$psi->id);

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
				$message = 'Asesmen PSI gagal dibuat!';
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
			$psi = AlatPSI::find($id);
			$psi->delete();

			$status = 1;
			$message = 'Asesmen PSI berhasil dihapus!';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-PSI',$psi->id);

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
				$message = 'Asesmen PSI gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
