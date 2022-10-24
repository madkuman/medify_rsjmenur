<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SkrinningUlangGizi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SkrinningUlangGizi;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$skrinning_ulang_gizi = new SkrinningUlangGizi;

        $total_skor = 0;
        foreach ($req->skor as $key => $value) {
            if (!is_null($value)) {
                $total_skor += $value;
            }
        }
    	
        if(!empty($req->tanggal)){        
            $skrinning_ulang_gizi->tanggal = Carbon::createFromFormat("d/m/Y", $req->tanggal);
        } else {
            $skrinning_ulang_gizi->tanggal = null;
        }
        $skrinning_ulang_gizi->jam = $req->jam;
        $skrinning_ulang_gizi->ruangan = $req->ruangan;
        $skrinning_ulang_gizi->dx_medis = $req->dx_medis;
        $skrinning_ulang_gizi->tinggi_badan = $req->tinggi_badan;
        $skrinning_ulang_gizi->berat_badan = $req->berat_badan;
        $skrinning_ulang_gizi->imt = $req->imt;
        $skrinning_ulang_gizi->imtu = $req->imtu;
        $skrinning_ulang_gizi->asupan_nutrisi = $req->asupan_nutrisi;
        $skrinning_ulang_gizi->status_gizi = $req->status_gizi;
        $skrinning_ulang_gizi->pasien_dengan_kondisi_khusus = $req->pasien_dengan_kondisi_khusus;
        $skrinning_ulang_gizi->sebutkan_pasien_dengan_kondisi_khusus = $req->sebutkan_pasien_dengan_kondisi_khusus;
        $skrinning_ulang_gizi->total_skor = $total_skor;
    	$skrinning_ulang_gizi->created_by = Auth::user()->id;
    	$skrinning_ulang_gizi->kasus_id = $kasus_id;
    	$skrinning_ulang_gizi->save();
    }
}