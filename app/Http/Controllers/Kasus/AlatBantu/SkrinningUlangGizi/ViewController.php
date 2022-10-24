<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SkrinningUlangGizi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\SkrinningUlangGizi;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $skrinning_ulang_gizi = SkrinningUlangGizi::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["skrinning_ulang_gizi"] = $skrinning_ulang_gizi;
        $data["sidebar_active"] = "alat";

        return view("kasus.alatbantu.skrinning-ulang-gizi.index", $data);
	}

    function print(Request $request, $nomor_kasus){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $skrinning_ulang_gizi = SkrinningUlangGizi::with(["creator"])->where('kasus_id', $kasus->id)->get();

        $data["skrinning_ulang_gizi"] = $skrinning_ulang_gizi;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.alatbantu.skrinning-ulang-gizi.print", $data);
        return $pdf->stream("print.pdf");
    }
}