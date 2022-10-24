<?php

namespace App\Http\Controllers\Kasus\AlatBantu\NyeriPostOps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatNyeriPostOps;
use Auth;
use DB;

define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class PostController extends Controller
{
    public function create($nomor_kasus,Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$ekspresi = $request->ekspresi;
			$movement = $request->movement;
			$ventilator = $request->ventilator;

			$score = $ekspresi + $movement + $ventilator;
			if($score < 4) $class = 'Tidak Nyeri';
	        else if($score < 8) $class = 'Nyeri Sedang';
	        else if($score < 12) $class = 'Nyeri Berat';
	        else $class = 'Nyeri Hebat/Sangat Berat';

			$nyeri = new AlatNyeriPostOps;
			$nyeri->kasus_id = $kasus->id;
			$nyeri->ekspresi = $ekspresi;
			$nyeri->movement = $movement;
			$nyeri->ventilator = $ventilator;
			$nyeri->score = $score;
			$nyeri->class = $class;
			$nyeri->created_by = Auth::user()->id;
			$nyeri->save();


			$status = 1;
			$message = 'Asesmen berhasil dibuat';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-nyeri post ops',$nyeri->id);

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
				$message = 'Asesmen gagal dibuat';
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
			$nyeri = AlatNyeriPostOps::find($id);
			$nyeri->delete();

			$status = 1;
			$message = 'Asesmen berhasil dihapus!';
			$title = 'Berhasil!';

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
			
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-nyeri post ops',$nyeri->id);

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
				$message = 'Asesmen gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
