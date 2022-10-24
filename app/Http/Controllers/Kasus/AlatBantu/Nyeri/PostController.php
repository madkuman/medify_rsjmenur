<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Nyeri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatNyeri;
use Auth;
use DB;


define('relasi', []);

class PostController extends Controller
{
    public function create($nomor_kasus,Request $request)
	{	
		// dd($request);
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$nyeri = new AlatNyeri;
		$nyeri->kasus_id = $kasus->id;
		$nyeri->penilaian_nyeri = $request->penilaian_nyeri;
		$nyeri->kondisi_nyeri = $request->kondisi_nyeri;
		$nyeri_hilang = '';
		$x = 0;
		for($i=0;$i<count($request->nyeri_hilang);$i++)
		{		
			$temp = explode(',',$request->nyeri_hilang[$i]);
			foreach ($temp as $item) {
					$nyeri_hilang .= $item;
					$x++;
					if($x <= count($request->nyeri_hilang) - 1)
					$nyeri_hilang .= ', ';
				}	
			$nyeri->nyeri_hilang = $nyeri_hilang;
		}
		// dd($pembelajaran);
		$nyeri->created_by = Auth::user()->id;
		$nyeri->provokatif = $request->provokatif;
		$nyeri->quality = $request->quality;
		$nyeri->region = $request->region;
		$nyeri->scala = $request->scala;
		$nyeri->time = $request->time;
		// dd($nyeri);
		$nyeri->save();


		$status = 1;
		$message = 'Skrining Nyeri berhasil dibuat';
		$title = 'Berhasil!';


		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-skrining nyeri',$nyeri->id);

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
			$nyeri = AlatNyeri::find($id);
			$nyeri->delete();

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-skrining nyeri',$nyeri->id);


			$status = 1;
			$message = 'Skrining Nyeri berhasil dihapus!';
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
				$message = 'Skrining Nyeri gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
