<?php

namespace App\Http\Controllers\Kasus\VitalSign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\VitalSign;
use App\Models\Kasus\Kasus;
use Auth;
use DB;
use Bugsnag;

class EditController extends Controller
{
    public function edit($nomor_kasus, Request $request)
	{
		DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();

			$vital = VitalSign::find($request->id);
			$vital->kasus_id = $kasus->id;
			$vital->temperatur = str_replace(",",".",$request->temperatur);
			$vital->nadi = str_replace(",",".",$request->nadi);
			$vital->pernapasan = str_replace(",",".",$request->pernapasan); 
			$vital->sistol = str_replace(",",".",$request->sistol);
			$vital->diastol = str_replace(",",".",$request->diastol);
			$vital->skala_nyeri = $request->skala_nyeri;
			$vital->spo2 = str_replace(",",".",$request->spo2);
			$vital->o2 = str_replace(",",".",$request->o2);
			$vital->maternal = str_replace(",",".",$request->maternal);
			$vital->penilaian_nyeri = $request->penilaian_nyeri;
			$vital->provokatif = $request->provokatif;
			$vital->quality = $request->quality;
			$vital->region = $request->region;
			$vital->scala = $request->scala;
			$vital->time = $request->time;
			$vital->nyeri_hilang = $request->nyeri_hilang;
			$vital->porsi_makan = $request->porsi_makan;
			$vital->gcs = $request->gcs;
			$vital->avpu = $request->avpu;
			$vital->cairan_infus = str_replace(",",".",$request->cairan_infus);
			$vital->cairan_per_os = str_replace(",",".",$request->cairan_per_os);
			$vital->cairan_lain = str_replace(",",".",$request->cairan_lain);
			$vital->produksi_urine = str_replace(",",".",$request->produksi_urine);
			$vital->rencana_tindakan = $request->rencana_tindakan;
			$vital->gula_darah_sewaktu = str_replace(",",".",$request->gula_darah_sewaktu);
			$vital->berat_badan = $request->berat_badan;
			$vital->ews = $request->ews;
			$vital->imews = $request->imews;
			$vital->pews = $request->pews;
			
			$sistol = (!empty($request->sistol) ? $request->sistol : 0);
			$diastol = (!empty($request->diastol) ? $request->diastol : 0);
			$sistol_map = ($sistol != 0 ? $sistol/3 : 0);
			$diastol_map = ($diastol != 0 ? $diastol*2/3 : 0);

			$vital->map_sistol_diastol =  $sistol_map + $diastol_map;

			$vital->updated_by = Auth::user()->id;
			$vital->save();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'edit','vital',$vital->id);

			$status = 1;
			$message = 'Vital Sign berhasil diubah!';
			$title = 'Berhasil!';

			DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return redirect('/kasus/'.$nomor_kasus.'/datamedis/vital-sign')
			->with('active_nav','vital')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
	}
}
