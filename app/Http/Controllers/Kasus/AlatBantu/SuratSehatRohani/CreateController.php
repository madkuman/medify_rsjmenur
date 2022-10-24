<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratSehatRohani;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratSehatRohani;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$surat_sehat_rohani = new SuratSehatRohani;
    	
        $surat_sehat_rohani->kecerdasan_umum = $req->kecerdasan_umum;
        $surat_sehat_rohani->fleksibilitas_berpikir = $req->fleksibilitas_berpikir;
        $surat_sehat_rohani->sistematika_berpikir = $req->sistematika_berpikir;
        $surat_sehat_rohani->analisa_sintesa = $req->analisa_sintesa;
        $surat_sehat_rohani->berpikir_konseptual = $req->berpikir_konseptual;
        $surat_sehat_rohani->stabilitas_emosi = $req->stabilitas_emosi;
        $surat_sehat_rohani->kerja_sama = $req->kerja_sama;
        $surat_sehat_rohani->kepekaan_sosial = $req->kepekaan_sosial;
        $surat_sehat_rohani->kemampuan_adaptasi = $req->kemampuan_adaptasi;
        $surat_sehat_rohani->motivasi = $req->motivasi;
        $surat_sehat_rohani->tujuan_tes = $req->tujuan_tes;
        $surat_sehat_rohani->keperluan = $req->keperluan;
        if(!empty($req->tanggal)){        
            $surat_sehat_rohani->tanggal = Carbon::createFromFormat("d/m/Y", $req->tanggal);
        } else {
            $surat_sehat_rohani->tanggal = null;
        }
        $surat_sehat_rohani->rujukan_dari = $req->rujukan_dari;
        $surat_sehat_rohani->kemampuan_intelektual = $req->kemampuan_intelektual;
    	$surat_sehat_rohani->created_by = Auth::user()->id;
    	$surat_sehat_rohani->kasus_id = $kasus_id;
    	$surat_sehat_rohani->save();
    	return $surat_sehat_rohani;
    }
}