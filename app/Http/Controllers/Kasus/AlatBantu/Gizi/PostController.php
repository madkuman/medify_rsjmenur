<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Gizi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatGizi;
use Auth;
use DB;


define('relasi', []);

class PostController extends Controller
{

	public function create($nomor_kasus,Request $request)
	{	
		DB::connection('kasus')->beginTransaction();
		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
			$gizi = new AlatGizi;
			if(count($kasus->anak) > 0)
			{
				$asupan_kebidanan = $request->asupan_kebidanan;
				$gangguan_metabolisme = $request->gangguan_metabolisme;
				$bb_kebidanan = $request->bb_kebidanan;
				$hb_hct = $request->hb_hct;
				$score = $asupan_kebidanan + $gangguan_metabolisme + $bb_kebidanan + $hb_hct;
				$gizi->asupan_kebidanan = $asupan_kebidanan;
				$gizi->gangguan_metabolisme = $gangguan_metabolisme;
				$gizi->bb_kebidanan = $bb_kebidanan;
				$gizi->hb_hct = $hb_hct;
				$gizi->score = $score;
			}
			else if($kasus->pasien->age >= 17)
			{
				$turun_bb = $request->turun_bb;
				$asupan_turun = $request->asupan_turun;
				$score = $turun_bb + $asupan_turun;
				$gizi->asupan_turun = $asupan_turun;
				$gizi->turun_bb = $turun_bb;
				$gizi->score = $score;
				
			}
			else if($kasus->pasien->age < 17)
			{
				$turun_bb_anak = $request->turun_bb_anak;
				$kurus = $request->kurus;
				$malnutrisi = $request->malnutrisi;
				$kondisi_lain = $request->kondisi_lain;
				$score = $turun_bb_anak + $kurus + $malnutrisi + $kondisi_lain;
				$gizi->kasus_id = $kasus->id;
				$gizi->kurus = $kurus;
				$gizi->turun_bb_anak = $turun_bb_anak;
				$gizi->kondisi_lain = $kondisi_lain;
				$gizi->malnutrisi = $malnutrisi;
				$gizi->score = $score;			
			}
			// dd($score,$turun_bb,$request->turun_bb);
			$gizi->kasus_id = $kasus->id;
			$gizi->created_by = Auth::user()->id;
			$gizi->save();

			$status = 1;
			$message = 'Skrining Gizi berhasil dibuat';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-skrining gizi',$gizi->id);
			DB::connection('kasus')->commit();
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
	
		} catch (Exception $e) {
			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Asesmen Persalinan gagal dibuat!';
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
		DB::connection('mysql')->beginTransaction();
		try
		{	
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
			$id = $request->id;
			$gizi = AlatGizi::find($id);
			$gizi->delete();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-skrining-gizi',$gizi->id);


			$status = 1;
			$message = 'Skrining berhasil dihapus!';
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
				$message = 'MEWS gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
