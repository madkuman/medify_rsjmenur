<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TesIQKeswara;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\TesIqKeswara;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$tes_iq_keswara = new TesIqKeswara;
    	
        if(!empty($req->tanggal_pemeriksaan)){        
            $tes_iq_keswara->tanggal_pemeriksaan = Carbon::createFromFormat("d/m/Y", $req->tanggal_pemeriksaan);
        } else {
            $tes_iq_keswara->tanggal_pemeriksaan = null;
        }
        $tes_iq_keswara->alasan_pengiriman = $req->alasan_pengiriman;
        $tes_iq_keswara->bisa_bekerja_sama = $req->bisa_bekerja_sama;
        $tes_iq_keswara->aktif = $req->aktif;
        $tes_iq_keswara->sikap_tenang = $req->sikap_tenang;
        $tes_iq_keswara->mudah_menjawab = $req->mudah_menjawab;
        $tes_iq_keswara->yakin = $req->yakin;
        $tes_iq_keswara->kritis = $req->kritis;
        $tes_iq_keswara->cepat = $req->cepat;
        $tes_iq_keswara->hati_hati = $req->hati_hati;
        $tes_iq_keswara->berpikir_cepat = $req->berpikir_cepat;
        $tes_iq_keswara->rapi = $req->rapi;
        $tes_iq_keswara->perilaku_tenang = $req->perilaku_tenang;
        $tes_iq_keswara->mengetahui = $req->mengetahui;
        $tes_iq_keswara->bekerja_keras = $req->bekerja_keras;
        $tes_iq_keswara->reaksi_gagal_tenang = $req->reaksi_gagal_tenang;
        $tes_iq_keswara->reaksi_tenang = $req->reaksi_tenang;
        $tes_iq_keswara->semakin_giat = $req->semakin_giat;
        $tes_iq_keswara->cara_bicara_baik = $req->cara_bicara_baik;
        $tes_iq_keswara->jawaban_jelas = $req->jawaban_jelas;
        $tes_iq_keswara->spontan = $req->spontan;
        $tes_iq_keswara->reaksi_cepat = $req->reaksi_cepat;
        $tes_iq_keswara->coba_coba = $req->coba_coba;
        $tes_iq_keswara->gerakan_baik = $req->gerakan_baik;
        $tes_iq_keswara->koordinasi_baik = $req->koordinasi_baik;
        $tes_iq_keswara->intelegensi_umum = $req->intelegensi_umum;
        $tes_iq_keswara->pengertian_umum = $req->pengertian_umum;
        $tes_iq_keswara->kemampuan_visual_motor = $req->kemampuan_visual_motor;
        $tes_iq_keswara->kemampuan_berhitung = $req->kemampuan_berhitung;
        $tes_iq_keswara->kemampuan_mengingat_dan_berkonsentrasi = $req->kemampuan_mengingat_dan_berkonsentrasi;
        $tes_iq_keswara->perbendaharaan_kata = $req->perbendaharaan_kata;
        $tes_iq_keswara->pemahaman_dan_penalaran = $req->pemahaman_dan_penalaran;
        $tes_iq_keswara->ringkasan_dan_saran = $req->ringkasan_dan_saran;
        $tes_iq_keswara->catatan = $req->catatan;
    	$tes_iq_keswara->created_by = Auth::user()->id;
    	$tes_iq_keswara->kasus_id = $kasus_id;
    	$tes_iq_keswara->save();
    	return $tes_iq_keswara;
    }
}