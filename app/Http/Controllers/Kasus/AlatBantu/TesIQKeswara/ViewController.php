<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TesIQKeswara;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\TesIqKeswara;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $tes_iq_keswara = TesIqKeswara::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["tes_iq_keswara"] = $tes_iq_keswara;
        $data["sidebar_active"] = "psikologi";

        return view("kasus.alatbantu.tes-iq-keswara.index", $data);
	}

    function print($nomor_kasus, $id,$path = null){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $tes_iq_keswara = TesIqKeswara::with(["creator"])->find($id);

        $data["tes_iq_keswara"] = $tes_iq_keswara;
        $data["sidebar_active"] = "psikologi";

        $pdf = DOMPDF::loadView("kasus.alatbantu.tes-iq-keswara.print", $data)->setPaper('legal', 'portrait');
        if($path != null)
        {
            $pdf->save($path);
        }
        return $pdf->stream("print.pdf");
    }
}