<?php

namespace App\Http\Controllers\Kasus\BPJS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BPJSSEP;
use App\Models\Kasus\Kasus;
use DB;
use DateTime;
use Auth;
use Bugsnag;
use Carbon\Carbon;

class PostController extends Controller
{
	public function create($nomor_kasus, Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$sep = new BPJSSEP;
			$sep->kasus_id = $kasus->id;
			$sep->no_sep = $request->no_sep;
			$sep->no_bpjs = $request->no_bpjs;
			$sep->total_plafon = $request->plafon;
			$sep->save();

			$kasus->bpjs()->attach($sep->id);
			$kasus->sep_id = $sep->id;
			$kasus->save();

			$status = 1;
			$message = 'SEP baru berhasil dibuat!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','bpjs-sep',$sep->id,$kasus->id);

			
			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();

		}
	}

	public function edit($nomor_kasus, Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();

			$sep = BPJSSEP::where('no_sep',$request->no_sep)->first();
			$sep->total_plafon = $request->plafon;
			$sep->checked_by = Auth::user()->id;
			$sep->checked_at = Carbon::now();
			$sep->save();

			$kasus->sep_id = $sep->id;
			$kasus->save();

			$status = 1;
			$message = 'SEP berhasil diubah!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','bpjs-sep',$sep->id,$kasus->id);

			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();

			$status = 1;
			$message = 'SEP gagal berhasil diubah!';
			$title = 'Berhasil!';


			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
	}

	public function cekSEP($no_sep, $kasus_id)
	{
		try{
			DB::connection('kasus')->beginTransaction();
			$kasus = Kasus::find($kasus_id);
			$cekSEPLama = BPJSSEP::where('no_sep',$no_sep)->first();
			
			if(isset($cekSEPLama->id))
			{
				$kasus->bpjs()->attach($cekSEPLama->id);
			}
			DB::connection('kasus')->commit();
		}catch(\Exception $e){
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();
		}
	}

	public function updateDiagnosisAwal($sep_id, $kode_icd)
	{
		try{
			DB::connection('kasus')->beginTransaction();
			$sep = BPJSSEP::find($sep_id);
			if(isset($sep) && !isset($sep->diag_awal)){
				$sep->diagnosa_awal = $kode_icd;
				$res = app('App\Http\Controllers\BPJS\API\Sep\PostController')->updateSEP($sep->id, 0, $kode_icd);
				$sep->save();
			}
			DB::connection('kasus')->commit();
		}catch(\Exception $e){
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();
		}
	}

	//id yang ada pada app bpjs 
	public function updateDPJP($sep_id, $dpjp_id)
	{
		try{
			DB::connection('kasus')->beginTransaction();
			$sep = BPJSSEP::find($sep_id);
			if(isset($sep)){
				$sep->dpjp = $dpjp_id;
                // app('App\Http\Controllers\BPJS\API\Sep\PostController')->updateSEP($sep->id, $dpjp_id, 0);
				$sep->save();
			}
			DB::connection('kasus')->commit();
		}catch(\Exception $e){
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();
		}
	}

	//format yyyy-MM-dd hh:mm:ss
	public function updateTglPulang($sep_id, $tgl)
	{
		try{
			DB::connection('kasus')->beginTransaction();
			$sep = BPJSSEP::find($sep_id);
			if(isset($sep)){
				$sep->tgl_pulang = $tgl;
				// $hasil = app('App\Http\Controllers\BPJS\API\Sep\PostController')->sepPulang($sep->no_sep, $tgl);
				$sep->save();
			}
			DB::connection('kasus')->commit();
		}catch(\Exception $e){
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();
		}
	}

}
