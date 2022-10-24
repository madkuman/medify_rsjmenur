<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Miksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatMiksi;
use Auth;
use DB;


define('relasi', []);

class PostController extends Controller
{
	public function create($nomor_kasus,Request $request)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$miksi = new AlatMiksi;
		$miksi->kasus_id = $kasus->id;
		$miksi->kelainan = $request->input('kelainan');
		$miksi->warna = $request->warna;
		$miksi->jumlah = $request->jumlah;
		$miksi->created_by = Auth::user()->id;
		$miksi->save();


		$status = 1;
		$message = 'nilai eliminasi miksi berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-eliminasi miksi',$miksi->id);


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
			$miksi = AlatMiksi::find($id);
			$miksi->delete();

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-eliminasi miksi',$miksi->id);


			$status = 1;
			$message = 'Nilai miksi berhasil dihapus!';
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
				$message = 'miksi gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
