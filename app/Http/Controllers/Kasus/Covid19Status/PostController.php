<?php

namespace App\Http\Controllers\Kasus\Covid19Status;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use DB;

class PostController extends Controller
{
	public function updateStatus(Request $request, $nomor_kasus){
    	DB::connection('kasus')->beginTransaction();
		try
		{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			
			$covid19_status = app('App\Http\Controllers\Kasus\Covid19Status\CreateController')
			->create($kasus->id,'form',$request->status,$request->keterangan);

			if($request->status == 'positif')
			{
				$has_dx_covid = app('App\Http\Controllers\Kasus\Diagnosis\ReadController')->hasDiagnosis($kasus->id,'B34.2');

				if(!$has_dx_covid){
					$dx_id = app('App\Http\Controllers\Kasus\Diagnosis\ReadController')->searchByCodeICD('B34.2','id');

		            $dx = new \Illuminate\Http\Request();
		            $dx->replace([
		                'nomor-kasus' => $nomor_kasus,
		                'id-diagnosis' => $dx_id,
		                'utama' => $request->diagnosis_utama ?? null,
		            ]);

					$dx = app('App\Http\Controllers\Kasus\Diagnosis\CreateController')->createNewDiagnosis($dx);
				}
			}

			$status = 1;
			$message = 'Status Covid-19 berhasil diupdate!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'update','covid19-status',$covid19_status->id);

			DB::connection('kasus')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch (\Exception $e) {
			DB::connection('kasus')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			
			$status = -1;
			$message = 'Asesmen Skrining Covid-19 gagal dihapus!';
			$title = 'Error!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}
}
