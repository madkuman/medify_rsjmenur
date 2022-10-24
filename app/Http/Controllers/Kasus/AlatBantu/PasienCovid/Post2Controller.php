<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PasienCovid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Auth;
use DB;


define('relasi', []);

class Post2Controller extends Controller
{
    public function save($nomor_kasus,Request $request)
    {
        if(isset($request->is_format_baru)){
            $form = $this->save2($nomor_kasus,$request);

            $status = 1;
            if($request->id_covid != 0){
                $message = 'data skrining pasien covid-19 berhasil diedit';
            }
            else{
                $message = 'data skrining pasien covid-19 berhasil dibuat';
            }
			
            $title = 'Berhasil!';
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
		
        $demam = $request->input('demam');
        $bapil = $request->input('bapil');
        $nafas = $request->input('nafas');

        $score = abs($demam) + abs($bapil) + abs($nafas);

        $radio_normal =	$request->input('radio_normal') == 1 ? "Tidak Normal" : "Normal"; 
        $radio_unilateral = $request->input('radio_unilateral') == 1 ? "Infiltrat Unilateral" : "Tidak Infiltrat Unilateral"; 
        $radio_bilateral = $request->input('radio_bilateral') == 1 ? "Infiltrat Bilateral" : "Tidak Infiltrat Bilateral";
        $lab_leukosit = $request->input('lab_leukosit') == 1 ? "Leukosit Tidak Normal" : "Leukosit Normal"; 
        $lab_leukositosis = $request->input('lab_leukositosis') == 1 ? "Leukositosis" : "Tidak Leukositosis"; 
        $lab_leukopenia = $request->input('lab_leukopenia') == 1 ? "Leukopenia" : "Tidak Leukopenia"; 
        $lab_limfopenia = $request->input('lab_limfopenia') == 1 ? "Limfopenia" : "Tidak Limfopenia";

        $covid = new \stdclass();
        $covid->swab = $request->input('swab');
        $covid->hasil_swab = $request->input('hasil_swab');
        $covid->rapid_test = $request->input('rapid_test');
        $covid->hasil_rapid_test = $request->input('hasil_rapid_test');
        $covid->demam = $request->input('demam');
        $covid->bapil = $request->input('bapil');
        $covid->nafas = $request->input('nafas');
        $covid->travel = $request->input('travel_negara') || $request->input('travel_daerah') ? 1 : 0;
        $covid->negara = $request->input('negara');
        $covid->daerah = $request->input('daerah');
        $covid->radio = $request->radio ? implode(', ', [
                                    $radio_normal, 
                                    $radio_unilateral, 
                                    $radio_bilateral
                                ]
                            ) : null;
        $covid->lab = $request->lab ? implode(', ', [
                                    $lab_leukosit, 
                                    $lab_leukositosis, 
                                    $lab_leukopenia, 
                                    $lab_limfopenia
                                ]
                            ) : null;
        $covid->kontak = $request->input('kontak');
        $covid->score = $score;

        $covid->alasan = $request->alasan;

        if($request->id_covid != 0)
            $alatBantu = AlatBantu::find($request->id_covid);

        if(!isset($alatBantu))
            $alatBantu = new AlatBantu;
        $alatBantu->kasus_id = $kasus->id;
        $alatBantu->type = "covid";

// Kasus Suspek, 1
// Kasus Probable, 5
// Kasus Konfirmasi, 4
// Kontak Erat,  2 3
// Pelaku Perjalanan, 6
// Discarded, 0
// Kematian. 1 / 5 krs meninggal
		

        if(
            ((!empty($covid->demam) && !empty($covid->bapil)) || !empty($covid->nafas)) && ((!empty($covid->daerah) || !empty($covid->negara)) || !empty($covid->kontak))
        )
            $alatBantu->presentase = 1; // suspek
        elseif((!empty($covid->demam) && !empty($covid->bapil)) || !empty($covid->nafas))
            $alatBantu->presentase = 2; //probable
        elseif(!empty($covid->kontak))			
            $alatBantu->presentase = 2; //kontak erat
        elseif(!empty($covid->daerah) || !empty($covid->negara))
            $alatBantu->presentase = 6; //pelaku perjalanan
        else
            $alatBantu->presentase = 0;


        if(!empty($covid->rapid_test) && $covid->rapid_test == 1){
            if(!empty($covid->hasil_rapid_test) && $covid->hasil_rapid_test == 1)
                $alatBantu->presentase = 5; //probable
        }

        if(!empty($covid->swab) && $covid->swab == 1){
            if(!empty($covid->hasil_swab) && $covid->hasil_swab == 1)
                $alatBantu->presentase = 4; //konfirmasi
            elseif(isset($covid->hasil_swab) && $covid->hasil_swab == 0)
                $alatBantu->presentase = 0; //discarded
        }
        if($request->id_covid != 0)
            $alatBantu->updated_by = Auth::user()->id;
        else
            $alatBantu->created_by = Auth::user()->id;


        if(isset($covid->swab) && $covid->swab == 0)
        {
            if(!empty($covid->alasan) && ($alatBantu->presentase >= 1 || $alatBantu->presentase <= 3))
            {
                $alatBantu->presentase = 0;
            }
        }

        $alatBantu->val = json_encode($covid);
        $alatBantu->save();

        $status = 1;
        $message = 'data skrining pasien covid-19 berhasil dibuat';
        $title = 'Berhasil!';



// Kasus Suspek, 1
// Kasus Probable, 5
// Kasus Konfirmasi, 4
// Kontak Erat,  2 3
// Pelaku Perjalanan, 6
// Discarded, 0
// Kematian. 1 / 5 krs meninggal

        if($alatBantu->presentase == 1) $status_pasien = 'suspek';
        elseif($alatBantu->presentase == 2) $status_pasien = 'kontak erat';
        elseif($alatBantu->presentase == 3) $status_pasien = 'kontak erat';
        elseif($alatBantu->presentase == 4) $status_pasien = 'konfirmasi';
        elseif($alatBantu->presentase == 5) $status_pasien = 'probable';
        elseif($alatBantu->presentase == 6) $status_pasien = 'pelaku perjalanan';
        elseif($alatBantu->presentase == 0) $status_pasien = 'discarded';

        $data_covid = new \Illuminate\Http\Request();
        $data_covid = new Request([
            'status' => $status_pasien,
            'keterangan' => 'Berdasarkan Skrining Pasien COVID19',
            'diagnosis_utama' => 'on'
        ]);

        $covid19_status = app('App\Http\Controllers\Kasus\Covid19Status\PostController')
        ->updateStatusBaru($data_covid,$kasus->nomor_kasus);

        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasus->id,'create','alat-covid',$alatBantu->id);


        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }


    public function delete($nomor_kasus,Request $request)
    {

        DB::connection('kasus')->beginTransaction();
        try
        {

            $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
            $id = $request->id;
            $covid = AlatBantu::find($id);
            $covid->delete();

            $status = 1;
            $message = 'Asesmen Skrining Covid-19 berhasil dihapus!';
            $title = 'Berhasil!';


            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasus->id,'delete','alat-covid',$covid->id);

            DB::connection('kasus')->commit();

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        }
        catch (\Exception $e) {

            DB::connection('kasus')->rollback();
			
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = -1;
            $message = 'Asesmen Skrining Covid-19 gagal dihapus!';
            $title = 'Error!';

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
    }

    public function save2($nomor_kasus,$request){
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $covid = new \stdclass();
        $covid->score = 0;//later
        $covid->demam_mayor = $request->demam_mayor;
        $covid->batuk_mayor = $request->batuk_mayor;
        $covid->nyeri_tenggorokan_mayor = $request->nyeri_tenggorokan_mayor;
        $covid->sesak_mayor = $request->sesak_mayor;
        $covid->anosmia_mayor = $request->anosmia_mayor;
        $covid->ageusia_mayor = $request->ageusia_mayor;

        $score_mayor = $request->demam_mayor + $request->batuk_mayor + $request->nyeri_tenggorokan_mayor + $request->sesak_mayor + $request->anosmia_mayor + $request->ageusia_mayor;

        $covid->nyeri_otot_minor = $request->nyeri_otot_minor;
        $covid->nyeri_kepala_minor = $request->nyeri_kepala_minor;
        $covid->diare_minor = $request->diare_minor;
        $covid->mual_minor = $request->mual_minor;
        $covid->pilek_minor = $request->pilek_minor;
        $covid->panas_dingin_minor = $request->panas_dingin_minor;
        $covid->kelelahan_minor = $request->kelelahan_minor;
        $covid->bingung_minor = $request->bingung_minor;
        $covid->nyeri_dada_minor = $request->nyeri_dada_minor;


        $covid->kontak_erat_epidemiologis = $request->kontak_erat_epidemiologis;
        $covid->kasus_endemik_epidemiologis = $request->kasus_endemik_epidemiologis;
        $covid->daerah_episentrum_epidemiologis = $request->daerah_episentrum_epidemiologis;

        $score_minor = $request->nyeri_otot_minor + $request->nyeri_kepala_minor + $request->diare_minor + $request->mual_minor
        + $request->pilek_minor +  $request->panas_dingin_minor + $request->kelelahan_minor + $request->bingung_minor + $request->nyeri_dada_minor
        + $request->kontak_erat_epidemiologis + $request->kasus_endemik_epidemiologis + $request->daerah_episentrum_epidemiologis;
		
        $covid->hasil_lab_antigen_positif = $request->hasil_lab_antigen_positif;
        $covid->hasil_lab_pcr_positif = $request->hasil_lab_pcr_positif;

        if($request->id_covid != 0)
            $alatBantu = AlatBantu::find($request->id_covid);

        if(!isset($alatBantu))
            $alatBantu = new AlatBantu;
        $alatBantu->kasus_id = $kasus->id;
        $alatBantu->type = "covid";
        $alatBantu->is_format_baru = 1;

        // if($alatBantu->presentase == 1) $status_pasien = 'suspek';
        // elseif($alatBantu->presentase == 2) $status_pasien = 'kontak erat';
        // elseif($alatBantu->presentase == 3) $status_pasien = 'kontak erat';
        // elseif($alatBantu->presentase == 4) $status_pasien = 'konfirmasi';
        // elseif($alatBantu->presentase == 5) $status_pasien = 'probable';
        // elseif($alatBantu->presentase == 6) $status_pasien = 'pelaku perjalanan';
        // elseif($alatBantu->presentase == 0) $status_pasien = 'discarded';
        $status_pasien = 'discarded';
        $alatBantu->presentase = 0;
        if($score_mayor >=2 && $request->demam_mayor == 1){
            $status_pasien = 'suspek';
            $alatBantu->presentase = 1;
        }
        else if($score_mayor >=1 && $score_minor >=2 ){
            $status_pasien = 'suspek';
            $alatBantu->presentase = 1;
        }
        if($request->hasil_lab_antigen_positif == 1){
            $status_pasien = 'suspek';
            $alatBantu->presentase = 1;
        }
        if($request->hasil_lab_pcr_positif == 1){
            $status_pasien = 'konfirmasi';
            $alatBantu->presentase = 4;
        }
        if($request->id_covid != 0)
            $alatBantu->updated_by = Auth::user()->id;
        else
            $alatBantu->created_by = Auth::user()->id;

        $alatBantu->val = json_encode($covid);
        $alatBantu->save();

        $data_covid = new \Illuminate\Http\Request();
        $data_covid = new Request([
            'status' => $status_pasien,
            'keterangan' => 'Berdasarkan Skrining Pasien COVID19',
            'diagnosis_utama' => 'on'
        ]);

        $covid19_status = app('App\Http\Controllers\Kasus\Covid19Status\PostController')
        ->updateStatus($data_covid,$kasus->nomor_kasus);

        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasus->id,'create','alat-covid',$alatBantu->id);
    }
}
