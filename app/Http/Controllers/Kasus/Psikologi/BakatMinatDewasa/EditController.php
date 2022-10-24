<?php

namespace App\Http\Controllers\Kasus\Psikologi\BakatMinatDewasa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BakatMinatDewasa;
use Carbon\Carbon;
use DB;
use Auth;

class EditController extends Controller
{
    public function edit($req){
        $bakat_minat_dewasa = BakatMinatDewasa::find($req->id);
        $minat = [];

        if(!empty($req->tanggal_pemeriksaan)){        
            $bakat_minat_dewasa->tanggal_pemeriksaan = Carbon::createFromFormat("d/m/Y", $req->tanggal_pemeriksaan);
        } else {
            $bakat_minat_dewasa->tanggal_pemeriksaan = null;
        }

        $bakat_minat_dewasa->tujuan_tes = $req->tujuan_tes;
        $bakat_minat_dewasa->intelegensi_umum = $req->intelegensi_umum;
        $bakat_minat_dewasa->daya_nalar = $req->daya_nalar;
        $bakat_minat_dewasa->daya_analisa_sintesa = $req->daya_analisa_sintesa;
        $bakat_minat_dewasa->fleksibilitas_berpikir = $req->fleksibilitas_berpikir;
        $bakat_minat_dewasa->daya_ingat = $req->daya_ingat;
        $bakat_minat_dewasa->kecepatan_kerja = $req->kecepatan_kerja;
        $bakat_minat_dewasa->ketelitian = $req->ketelitian;
        $bakat_minat_dewasa->daya_tahan_kerja = $req->daya_tahan_kerja;
        $bakat_minat_dewasa->stabilitas_emosi = $req->stabilitas_emosi;
        $bakat_minat_dewasa->penyesuaian_diri = $req->penyesuaian_diri;
        $bakat_minat_dewasa->motivasi_dorongan_ambisi = $req->motivasi_dorongan_ambisi;
        $bakat_minat_dewasa->kerja_sama = $req->kerja_sama;
        $bakat_minat_dewasa->kemampuan_verbal = $req->kemampuan_verbal;
        $bakat_minat_dewasa->kemampuan_numerik = $req->kemampuan_numerik;
        $bakat_minat_dewasa->kesimpulan = $req->kesimpulan;
        
        foreach ($req->minat as $key => $value) {
            $minat[] = $value;
        }

        $bakat_minat_dewasa->minat = json_encode($minat);

        $bakat_minat_dewasa->updated_by = Auth::user()->id;
        $bakat_minat_dewasa->updated_at = date('Y-m-d H:i:s');
        $bakat_minat_dewasa->save();
        return $bakat_minat_dewasa;
    }
}