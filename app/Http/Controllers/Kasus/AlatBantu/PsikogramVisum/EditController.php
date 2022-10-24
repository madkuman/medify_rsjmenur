<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PsikogramVisum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PsikogramVisum;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$psikogram_visum = PsikogramVisum::find($req->id);
    	
        if(!empty($req->tanggal_pemeriksaan)){        
            $psikogram_visum->tanggal_pemeriksaan = Carbon::createFromFormat("d/m/Y", $req->tanggal_pemeriksaan);
        } else {
            $psikogram_visum->tanggal_pemeriksaan = null;
        }
        $psikogram_visum->tujuan_pemeriksaan = $req->tujuan_pemeriksaan;
        $psikogram_visum->rujukan_dari = $req->rujukan_dari;
        $psikogram_visum->intelegensi_umum = $req->intelegensi_umum;
        $psikogram_visum->daya_nalar = $req->daya_nalar;
        $psikogram_visum->daya_analisa_sintesa = $req->daya_analisa_sintesa;
        $psikogram_visum->fleksibilitas_berpikir = $req->fleksibilitas_berpikir;
        $psikogram_visum->kemampuan_berkomunikasi = $req->kemampuan_berkomunikasi;
        $psikogram_visum->kemampuan_pengambilan_keputusan = $req->kemampuan_pengambilan_keputusan;
        $psikogram_visum->kreativitas = $req->kreativitas;
        $psikogram_visum->potensi_kerja = $req->potensi_kerja;
        $psikogram_visum->perencanaan_kerja = $req->perencanaan_kerja;
        $psikogram_visum->daya_tahan_kerja = $req->daya_tahan_kerja;
        $psikogram_visum->inisiatif = $req->inisiatif;
        $psikogram_visum->motivasi_dorongan_ambisi = $req->motivasi_dorongan_ambisi;
        $psikogram_visum->komitmen_pada_tugas = $req->komitmen_pada_tugas;
        $psikogram_visum->stabilitas_emosi = $req->stabilitas_emosi;
        $psikogram_visum->kerja_sama = $req->kerja_sama;
        $psikogram_visum->kepekaan_sosial = $req->kepekaan_sosial;
        $psikogram_visum->updated_by = Auth::user()->id;
    	$psikogram_visum->save();
    	return $psikogram_visum;
    }
}