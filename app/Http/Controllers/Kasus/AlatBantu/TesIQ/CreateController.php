<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TesIQ;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\TesIq;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$tes_iq = new TesIq;
    	
        if(!empty($req->tanggal_pemeriksaan)){        
            $tes_iq->tanggal_pemeriksaan = Carbon::createFromFormat("d/m/Y", $req->tanggal_pemeriksaan);
        } else {
            $tes_iq->tanggal_pemeriksaan = null;
        }
        $tes_iq->tujuan_tes = $req->tujuan_tes;
        $tes_iq->rujukan_dari = $req->rujukan_dari;
        $tes_iq->kecerdasan_umum = $req->kecerdasan_umum;
        $tes_iq->fleksibilitas_berpikir = $req->fleksibilitas_berpikir;
        $tes_iq->analisa_sintesa = $req->analisa_sintesa;
        $tes_iq->berpikir_konseptual = $req->berpikir_konseptual;
        $tes_iq->kesimpulan = $req->kesimpulan;
        $tes_iq->kemampuan_intelektual = $req->kemampuan_intelektual;
    	$tes_iq->created_by = Auth::user()->id;
    	$tes_iq->kasus_id = $kasus_id;
    	$tes_iq->save();
    	return $tes_iq;
    }
}