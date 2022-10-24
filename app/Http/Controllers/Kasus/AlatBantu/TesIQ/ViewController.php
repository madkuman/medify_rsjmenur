<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TesIQ;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\TesIq;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $tes_iq = TesIq::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["tes_iq"] = $tes_iq;
        $data["sidebar_active"] = "psikologi";

        return view("kasus.alatbantu.tes-iq.index", $data);
	}

    function print($nomor_kasus, $id,$path = null){
        $kasus = Kasus::with(["lokasi.lokasi.departemen", "identitas",
            "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator",
            "TransaksiRawatInap", "myInvitation"])->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $tes_iq = TesIq::with(["creator"])->where("kasus_id",$kasus->id)->find($id);

        $data["tes_iq"] = $tes_iq;
        $data["sidebar_active"] = "psikologi";

        // $customPaper = array(0,0,616,1344);
        // $pdf = DOMPDF::loadView("kasus.alatbantu.tes-iq.print", $data)->setPaper($customPaper);
        $pdf = DOMPDF::loadView("kasus.alatbantu.tes-iq.print", $data)->setPaper('legal', 'portrait');
        if($path != null)
        {
            $pdf->save($path);
        }
        return $pdf->stream("print.pdf");
    }
}