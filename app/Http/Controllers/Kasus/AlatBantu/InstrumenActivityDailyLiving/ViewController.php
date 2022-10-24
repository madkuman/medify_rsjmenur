<?php

namespace App\Http\Controllers\Kasus\AlatBantu\InstrumenActivityDailyLiving;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\InstrumenActivityDailyLiving;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $instrumen_activity_daily_living = InstrumenActivityDailyLiving::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["instrumen_activity_daily_living"] = $instrumen_activity_daily_living;
        $data["sidebar_active"] = "alat";

        return view("kasus.alatbantu.instrumen-activity-daily-living.index", $data);
	}

    function print(Request $request, $nomor_kasus){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $instrumen_activity_daily_living = InstrumenActivityDailyLiving::with(["creator"])->where('kasus_id', $kasus->id)->get();

        $data["instrumen_activity_daily_living"] = $instrumen_activity_daily_living;
        $data["sidebar_active"] = "alat";
        
        $customPaper = array(0,0,816,1344);
        $pdf = DOMPDF::loadView("kasus.alatbantu.instrumen-activity-daily-living.print", $data)->setPaper($customPaper);
        // $pdf = DOMPDF::loadView("kasus.alatbantu.instrumen-activity-daily-living.print", $data);
        return $pdf->stream("print.pdf");
    }
}