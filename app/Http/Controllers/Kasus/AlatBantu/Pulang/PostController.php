<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Pulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatPulang;
use Auth;
use DB;


define('relasi', []);

class PostController extends Controller
{
    public function create($nomor_kasus,Request $request)
	{	
		// dd($request);
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$pulang = new AlatPulang;
		$pulang->kasus_id = $kasus->id;
//		$pulang->home_care = $request->home_care;
//		$pulang->implant = $request->implant;
//		$pulang->pemesanan_alat = $request->pemesanan_alat;
//		$pulang->komunitas_tertentu = $request->komunitas_tertentu;
//		$pulang->tim_terapis = $request->tim_terapis;
//		$pulang->ahli_gizi = $request->ahli_gizi;
//		$pulang->alat_bantu = $request->alat_bantu;
//		$pulang->lain_lain = $request->lain_lain;
        $pulang->discharge_mobilitas = isset($request->discharge_mobilitas) ? 1 :0;
        $pulang->discharge_perawatan = isset($request->discharge_perawatan) ? 1 :0;
        $pulang->discharge_bantuan = isset($request->discharge_bantuan) ? 1 :0;
        $pulang->discharge_perawatan_diri = isset($request->discharge_perawatan_diri) ? 1 :0;
        $pulang->discharge_obat = isset($request->discharge_obat) ? 1 :0;
        $pulang->discharge_diet = isset($request->discharge_diet) ? 1 :0;
        $pulang->discharge_luka = isset($request->discharge_luka) ? 1 :0;
        $pulang->discharge_latihan = isset($request->discharge_latihan) ? 1 :0;
        $pulang->discharge_tenaga_khusus = isset($request->discharge_tenaga_khusus) ? 1 :0;
        $pulang->discharge_medis = isset($request->discharge_medis) ? 1 :0;
        $pulang->discharge_fisik = isset($request->discharge_fisik) ? 1 :0;
        $pulang->discharge_umur = isset($request->discharge_umur) ? 1 :0;
		$pulang->created_by = Auth::user()->id;
		// dd($pulang);
		$pulang->save();


		$status = 1;
		$message = 'Perencanaan pulang berhasil dibuat';
		$title = 'Berhasil!';


		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-pulang',$pulang->id);

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
			$pulang = AlatPulang::find($id);
			$pulang->delete();

			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-pulang',$pulang->id);


			$status = 1;
			$message = 'Perencanaan Pulang berhasil dihapus!';
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
				$message = 'GCS gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
