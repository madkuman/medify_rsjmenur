<?php

namespace App\Http\Controllers\Kasus\Diagnosis;

use App\Models\Kasus\CPPT;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\ICD10;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BPJSSEP;
use Auth;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function createNewDiagnosis(Request $request) {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            $nomorKasus = $request->input('nomor-kasus');
            $kasusId = Kasus::where('nomor_kasus', $nomorKasus)->pluck('id')->first();
            $kasus = Kasus::find($kasusId);
            $countDiag = Diagnosis::where('kasus_id', $kasusId)->count();
            $judul_kasus = 0;

            $diagnosis = new Diagnosis();
            $diagnosis->kasus_id = $kasusId;
            $diagnosis->type = $request->type;
            $diagnosis->icd_10 = $request->input('id-diagnosis');
            $diagnosis->created_by = Auth::user()->id;
            $diagnosis->lokasi_id = $kasus->lokasi->lokasi_id;
            $diagnosis->save();

            if($request->type == 'utama')
            {
                $diagnosis->utama = 1;
                $diagnosis->save();
                $kasus->judul_kasus = $diagnosis->icd10->long_desc;
                $kasus->judul_kasus_changed = 1;
                $kasus->save();
            }
            if(config('app.bpjs_enable', false) && isset($kasus->sep_id) && $kasus->sep_id != 0 && $countDiag == 0){
                $sep = BPJSSEP::find($kasus->sep_id);
                $icd = ICD10::find($diagnosis->icd_10);
                app('App\Http\Controllers\Kasus\BPJS\PostController')
                        ->updateDiagnosisAwal($sep->id, $icd->code_icd);
            }

            $covid_status = $kasus->covid_status->status ?? 'none';
            if($covid_status != 'positif'){
                if($diagnosis->icd10->code_icd == 'B34.2')
                {
                    $covid19_status = app('App\Http\Controllers\Kasus\Covid19Status\CreateController')->create($kasus->id,'diagnosis','konfirmasi','Berdasarkan Diagnosa Dokter');
                }
            }

            $user_id = Auth::user()->id;
            $icd_10 = $diagnosis->icd_10;

            $log = app('App\Http\Controllers\Kasus\ViewDiagnosisUserTotal\CreateController')->create($user_id,$icd_10);

            $status = 1;
            $message = 'Diagnosis baru berhasil dibuat!';
            $title = 'Berhasil!';

            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasusId,'create','diagnosis',$diagnosis->id);

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return redirect('/kasus/'.$nomorKasus.'/datamedis/diagnosis')
            ->with('active_nav','diagnosis')
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
