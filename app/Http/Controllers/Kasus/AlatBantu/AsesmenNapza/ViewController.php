<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenNapza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AsesmenNapza;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $asesmen_napza = AsesmenNapza::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["asesmen_napza"] = $asesmen_napza;
        $data["sidebar_active"] = "alat";

        return view("kasus.alatbantu.asesmen-napza.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $asesmen_napza = AsesmenNapza::with(["creator"])->find($id);

        $data["asesmen_napza"] = $asesmen_napza;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.alatbantu.asesmen-napza.print", $data);
        return $pdf->stream("print.pdf");
    }
}