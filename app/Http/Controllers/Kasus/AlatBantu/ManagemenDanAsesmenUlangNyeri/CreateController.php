<?php

namespace App\Http\Controllers\Kasus\AlatBantu\ManagemenDanAsesmenUlangNyeri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\ManagemenDanAsesmenUlangNyeri;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$managemen_dan_asesmen_ulang_nyeri = new ManagemenDanAsesmenUlangNyeri;
    	
        $managemen_dan_asesmen_ulang_nyeri->nama_obat = $req->nama_obat;
        $managemen_dan_asesmen_ulang_nyeri->dosis_dan_frekuensi = $req->dosis_dan_frekuensi;
        $managemen_dan_asesmen_ulang_nyeri->nama_dokter = $req->nama_dokter;
        if(!empty($req->tanggal)){        
            $managemen_dan_asesmen_ulang_nyeri->tanggal = Carbon::createFromFormat("d/m/Y", $req->tanggal);
        } else {
            $managemen_dan_asesmen_ulang_nyeri->tanggal = null;
        }
        $managemen_dan_asesmen_ulang_nyeri->jam = $req->jam;
        $managemen_dan_asesmen_ulang_nyeri->skor_nyeri = $req->skor_nyeri;
        $managemen_dan_asesmen_ulang_nyeri->tensi = $req->tensi;
        $managemen_dan_asesmen_ulang_nyeri->nadi = $req->nadi;
        $managemen_dan_asesmen_ulang_nyeri->nafas = $req->nafas;
        $managemen_dan_asesmen_ulang_nyeri->suhu = $req->suhu;
        $managemen_dan_asesmen_ulang_nyeri->intervensi_non_farmokologi = $req->intervensi_non_farmokologi;
        $managemen_dan_asesmen_ulang_nyeri->waktu_kajian_ulang = $req->waktu_kajian_ulang;
        $managemen_dan_asesmen_ulang_nyeri->nama_perawat = $req->nama_perawat;
    	$managemen_dan_asesmen_ulang_nyeri->created_by = Auth::user()->id;
    	$managemen_dan_asesmen_ulang_nyeri->kasus_id = $kasus_id;
    	$managemen_dan_asesmen_ulang_nyeri->save();
    }
}