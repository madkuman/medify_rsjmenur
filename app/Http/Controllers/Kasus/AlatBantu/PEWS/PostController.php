<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PEWS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatPews;
use Auth;
use DB;


define('relasi', []);

class PostController extends Controller
{
	public function create($nomor_kasus,Request $request)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$perilaku = $request->perilaku;
		$vaskular = $request->vaskular;
		$respirasi = $request->respirasi;

		$score = $perilaku + $vaskular + $respirasi;

		$pews = new AlatPews;
		$pews->kasus_id = $kasus->id;
		$pews->perilaku = $perilaku;
		$pews->vaskular = $vaskular;
		$pews->respirasi = $respirasi;
		$pews->score = $score;
		$pews->created_by = Auth::user()->id;
		$pews->save();


		$status = 1;
		$message = 'PEWS berhasil dibuat';
		$title = 'Berhasil!';


		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-PEWS',$pews->id);

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
			$pews = AlatPews::find($id);
			$pews->delete();

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-PEWS',$pews->id);


			$status = 1;
			$message = 'Asesmen PEWS berhasil dihapus!';
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
				$message = 'Asesmen PEWS gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
