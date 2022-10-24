<?php

namespace App\Http\Controllers\Kasus\AlatBantu\APGAR;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatApgar;
use Auth;
use DB;


define('relasi', []);

class PostController extends Controller
{
	public function create($nomor_kasus,Request $request)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$app = $request->input('app');
		$pulse = $request->input('pulse');
		$grim = $request->input('grim');
		$act = $request->input('act');
		$resp = $request->input('resp');

		$score = abs($app) + abs($pulse) + abs($grim) + abs($act) + abs($resp);

		$apgar = new AlatApgar;
		$apgar->kasus_id = $kasus->id;
		$apgar->appearance = $request->input('app');
		$apgar->pulse = $request->input('pulse');
		$apgar->grimace = $request->input('grim');
		$apgar->activity = $request->input('act');
		$apgar->respiration = $request->input('resp');
		$apgar->score = $score;
		$apgar->created_by = Auth::user()->id;
		$apgar->save();


		$status = 1;
		$message = 'Apgar berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-apgar',$apgar->id);


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
			$apgar = AlatApgar::find($id);
			$apgar->delete();

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-apgar',$apgar->id);


			$status = 1;
			$message = 'APGAR berhasil dihapus!';
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
				$message = 'APGAR gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
