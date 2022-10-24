<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PenilaianKualitasHidupLansia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\PenilaianKualitasHidupLansia;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus)
    {
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $penilaian_kualitas_hidup_lansia = PenilaianKualitasHidupLansia::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["penilaian_kualitas_hidup_lansia"] = $penilaian_kualitas_hidup_lansia;
        $data["sidebar_active"] = "alat";

        return view("kasus.alatbantu.penilaian-kualitas-hidup-lansia.index", $data);
	}

    function print(Request $request, $nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where("nomor_kasus", $nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $penilaian_kualitas_hidup_lansia = PenilaianKualitasHidupLansia::with(["creator"])->where('kasus_id', $kasus->id)->get();

        $data["penilaian_kualitas_hidup_lansia"] = $penilaian_kualitas_hidup_lansia;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.alatbantu.penilaian-kualitas-hidup-lansia.print", $data);
        return $pdf->stream("print.pdf");
    }
}