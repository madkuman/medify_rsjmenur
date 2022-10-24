<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenNapzaRawatJalanNonIPWL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AsesmenNapzaRawatJalanNonIPWL;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $asesmen_napza_rawat_jalan_non_ipwl = AsesmenNapzaRawatJalanNonIPWL::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["asesmen_napza_rawat_jalan_non_ipwl"] = $asesmen_napza_rawat_jalan_non_ipwl;
        $data["sidebar_active"] = "alat";
        $data['jenis_napza'] = ['Alkohol', 'Heroin', 'Metadon/Buprenorfin', 'Opiat lain/Analgesik', 'Barbiturat', 'Sedatif/Hipnotik', 'Amfetamin', 'Kanabis', 'Halusinogen', 'Inhalan'];

        return view("kasus.alatbantu.asesmen-napza-rawat-jalan-non-ipwl.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $asesmen_napza_rawat_jalan_non_ipwl = AsesmenNapzaRawatJalanNonIPWL::with(["creator"])->find($id);

        $data["asesmen_napza_non_ipwl"] = $asesmen_napza_rawat_jalan_non_ipwl;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.alatbantu.asesmen-napza-rawat-jalan-non-ipwl.print", $data);
        return $pdf->stream("print.pdf");
    }
}