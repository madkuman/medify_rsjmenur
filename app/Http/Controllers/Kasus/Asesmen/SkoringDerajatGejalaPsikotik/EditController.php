<?php

namespace App\Http\Controllers\Kasus\Asesmen\SkoringDerajatGejalaPsikotik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SkoringDerajatGejalaPsikotik;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$skoring_derajat_gejala_psikotik = SkoringDerajatGejalaPsikotik::find($req->id);
    	
        if(!empty($req->tanggal_pelaksanaan_skoring)){        
            $skoring_derajat_gejala_psikotik->tanggal_pelaksanaan_skoring = Carbon::createFromFormat("d/m/Y", $req->tanggal_pelaksanaan_skoring);
        } else {
            $skoring_derajat_gejala_psikotik->tanggal_pelaksanaan_skoring = null;
        }
        $skoring_derajat_gejala_psikotik->jam_pelaksanaan_skoring = $req->jam_pelaksanaan_skoring;
        $skoring_derajat_gejala_psikotik->tempat_pelaksanaan_skoring = $req->tempat_pelaksanaan_skoring;
        $skoring_derajat_gejala_psikotik->penampilan = $req->penampilan;
        $skoring_derajat_gejala_psikotik->aktivitas_sosial = $req->aktivitas_sosial;
        $skoring_derajat_gejala_psikotik->sikap = $req->sikap;
        $skoring_derajat_gejala_psikotik->cara_bicara = $req->cara_bicara;
        $skoring_derajat_gejala_psikotik->cara_berpikir = $req->cara_berpikir;
        $skoring_derajat_gejala_psikotik->perilaku = $req->perilaku;
        $skoring_derajat_gejala_psikotik->fungsi_intelek_dan_orientasi = $req->fungsi_intelek_dan_orientasi;
        $skoring_derajat_gejala_psikotik->pengendalian_emosi = $req->pengendalian_emosi;
        $skoring_derajat_gejala_psikotik->fungsi_persepsi = $req->fungsi_persepsi;
        $skoring_derajat_gejala_psikotik->tilikan = $req->tilikan;

        $skoring_derajat_gejala_psikotik->total = 
        $skoring_derajat_gejala_psikotik->penampilan +
        $skoring_derajat_gejala_psikotik->aktivitas_sosial +
        $skoring_derajat_gejala_psikotik->sikap +
        $skoring_derajat_gejala_psikotik->cara_bicara +
        $skoring_derajat_gejala_psikotik->cara_berpikir +
        $skoring_derajat_gejala_psikotik->perilaku +
        $skoring_derajat_gejala_psikotik->fungsi_intelek_dan_orientasi +
        $skoring_derajat_gejala_psikotik->pengendalian_emosi +
        $skoring_derajat_gejala_psikotik->fungsi_persepsi +
        $skoring_derajat_gejala_psikotik->tilikan ;

        $skoring_derajat_gejala_psikotik->updated_by = Auth::user()->id;
    	$skoring_derajat_gejala_psikotik->save();
    }
}