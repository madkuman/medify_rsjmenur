<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Flacc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatFlacc;
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
			$score = $request->wajah + $request->kaki + $request->aktivitas + $request->menangis + $request->consolability;
			$flacc = new AlatFlacc;
			$flacc->kasus_id = $kasus->id;
			$flacc->wajah = $request->wajah;
			$flacc->kaki = $request->kaki;
			$flacc->aktivitas = $request->aktivitas;
			$flacc->menangis = $request->menangis;
			$flacc->consolability = $request->consolability;
			$flacc->score = $score;
			$flacc->created_by = Auth::user()->id;
			$flacc->save();


			$status = 1;
			$message = 'Asesmen Flacc berhasil dibuat';
			$title = 'Berhasil!';
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')->create($kasus->id,'create','alat-flacc',$flacc->id);

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
				$message = 'Asesmen Flacc gagal dibuat!';
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
			$flacc = AlatFlacc::find($id);
			$flacc->delete();

			$status = 1;
			$message = 'Asesmen Flacc berhasil dihapus!';
			$title = 'Berhasil!';

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-flacc', $id);

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
				$message = 'Asesmen Flacc gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
