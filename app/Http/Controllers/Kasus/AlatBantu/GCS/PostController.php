<?php

namespace App\Http\Controllers\Kasus\AlatBantu\GCS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatGcs;
use Auth;
use DB;


define('relasi', []);

class PostController extends Controller
{
    public function create($nomor_kasus,Request $request)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$membuka_mata = $request->input('membuka_mata');
		$respon_verbal = $request->input('respon_verbal');
		$respon_motorik = $request->input('respon_motorik');

		$score = abs($membuka_mata) + abs($respon_verbal) + abs($respon_motorik);

		$gcs = new AlatGcs;
		$gcs->kasus_id = $kasus->id;
		$gcs->membuka_mata = $request->input('membuka_mata');
		$gcs->respon_verbal = $request->input('respon_verbal');
		$gcs->respon_motorik = $request->input('respon_motorik');
		$gcs->score = $score;
		$gcs->created_by = Auth::user()->id;
		$gcs->save();


		$status = 1;
		$message = 'GCS berhasil dibuat';
		$title = 'Berhasil!';


		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-GCS',$gcs->id);

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);

	}
	public function delete($nomor_kasus,Request $request)
	{

		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$id = $request->id;
			$gcs = AlatGcs::find($id);
			$gcs->delete();

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-GCS',$gcs->id);


			$status = 1;
			$message = 'GCS berhasil dihapus!';
			$title = 'Berhasil!';


			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch (\Exception $e) {


			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'GCS gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
