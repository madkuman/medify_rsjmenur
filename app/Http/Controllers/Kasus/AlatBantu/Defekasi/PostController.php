<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Defekasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatDefekasi;
use Auth;
use DB;


define('relasi', []);

class PostController extends Controller
{
	public function create($nomor_kasus,Request $request)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();


		$defekasi = new AlatDefekasi;
		$defekasi->kasus_id = $kasus->id;
		$defekasi->kelainan = $request->input('kelainan');
		$defekasi->konsistensi = $request->konsistensi;
		$defekasi->frekuensi = $request->frekuensi;
		$defekasi->warna = $request->warna;
		$defekasi->created_by = Auth::user()->id;
		$defekasi->save();


		$status = 1;
		$message = 'nilai eliminasi defikasi berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-eliminasi defekasi',$defekasi->id);


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
			$defekasi = AlatDefekasi::find($id);
			$defekasi->delete();

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-eliminiasi defekasi',$defekasi->id);


			$status = 1;
			$message = 'Nilai defekasi berhasil dihapus!';
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
				$message = 'defekasi gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
