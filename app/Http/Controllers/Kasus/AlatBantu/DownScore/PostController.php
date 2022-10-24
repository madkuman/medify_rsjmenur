<?php

namespace App\Http\Controllers\Kasus\AlatBantu\DownScore;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatDownScore;
use Auth;
use DB;

define('relasi', ['lokasi', 'admin', 'identitas', 'pembayaran', 'pasien', 'kelas', 'myRole', 'myRoleWithoutEnd']);

class PostController extends Controller
{
    public function create($nomor_kasus,Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
			$score = $request->retraksi + $request->sianosis + $request->frekuensi_nafas + $request->air_entry + $request->merintih;
			$down_score = new AlatDownScore;
			$down_score->kasus_id = $kasus->id;
			$down_score->retraksi = $request->retraksi;
			$down_score->sianosis = $request->sianosis;
			$down_score->frekuensi_nafas = $request->frekuensi_nafas;
			$down_score->air_entry = $request->air_entry;
			$down_score->merintih = $request->merintih;
			$down_score->score = $score;
			$down_score->created_by = Auth::user()->id;
			$down_score->save();


			$status = 1;
			$message = 'Asesmen Down Score berhasil dibuat';
			$title = 'Berhasil!';
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')->create($kasus->id,'create','alat-down score',$down_score->id);

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
				$message = 'Asesmen Down Score gagal dibuat!';
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
			$down_score = AlatDownScore::find($id);
			$down_score->delete();

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
			
			$status = 1;
			$message = 'Asesmen Down Score berhasil dihapus!';
			$title = 'Berhasil!';
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-down score', $id);

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
				$message = 'Asesmen Down Score gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
