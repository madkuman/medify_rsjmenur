<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratSehatRohani;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\SuratSehatRohani;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $surat_sehat_rohani = SuratSehatRohani::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["surat_sehat_rohani"] = $surat_sehat_rohani;
        $data["sidebar_active"] = "psikologi";

        return view("kasus.alatbantu.surat-sehat-rohani.index", $data);
	}

    function print($nomor_kasus, $id,$path = null){
        $kasus = Kasus::with(["lokasi.lokasi.departemen", "identitas",
            "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator",
            "TransaksiRawatInap", "myInvitation"])->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $surat_sehat_rohani = SuratSehatRohani::with(["creator"])->find($id);

        $data["surat_sehat_rohani"] = $surat_sehat_rohani;
        $data["sidebar_active"] = "sehat-rohani";
        
        $customPaper = array(0,0,616,1200);
        $pdf = DOMPDF::loadView("kasus.alatbantu.surat-sehat-rohani.print", $data)->setPaper($customPaper);

        if($path != null)
        {
            $pdf->save($path);
        }

        return $pdf->stream("print.pdf");
    }
}