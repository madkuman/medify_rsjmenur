<?php

namespace App\Http\Controllers\Kasus\AlatBantu\GeriatricDepressionScale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\GeriatricDepressionScale;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $geriatric_depression_scale = GeriatricDepressionScale::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["geriatric_depression_scale"] = $geriatric_depression_scale;
        $data["sidebar_active"] = "alat";

        return view("kasus.alatbantu.geriatric-depression-scale.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $geriatric_depression_scale = GeriatricDepressionScale::with(["creator"])->find($id);

        $data["gds"] = $geriatric_depression_scale;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.alatbantu.geriatric-depression-scale.print", $data);
        return $pdf->stream("print.pdf");
    }
}