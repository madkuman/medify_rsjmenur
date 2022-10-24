<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PsikogramVisum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\PsikogramVisum;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $psikogram_visum = PsikogramVisum::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["psikogram_visum"] = $psikogram_visum;
        $data["sidebar_active"] = "psikogram-visum";

        return view("kasus.alatbantu.psikogram-visum.index", $data);
	}

    function print($nomor_kasus, $id,$path = null){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $psikogram_visum = PsikogramVisum::with(["creator"])->find($id);

        $data["psikogram_visum"] = $psikogram_visum;
        $data["sidebar_active"] = "psikogram-visum";
        // dd($data);
        $customPaper = array(0,0,616,1244);
        $pdf = DOMPDF::loadView("kasus.alatbantu.psikogram-visum.print", $data)->setPaper($customPaper);
        if($path != null)
        {
            $pdf->save($path);
        }
        // $pdf = DOMPDF::loadView("kasus.alatbantu.psikogram-visum.print", $data);
        return $pdf->stream("print.pdf");
    }
}