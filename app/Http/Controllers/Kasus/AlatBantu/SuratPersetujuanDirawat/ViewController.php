<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratPersetujuanDirawat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\SuratPersetujuanDirawat;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $surat_persetujuan_dirawat = SuratPersetujuanDirawat::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["surat_persetujuan_dirawat"] = $surat_persetujuan_dirawat;
        $data["sidebar_active"] = "alat";

        return view("kasus.alatbantu.surat-persetujuan-dirawat.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $surat_persetujuan_dirawat = SuratPersetujuanDirawat::with(["creator"])->find($id);

        $data["surat_persetujuan_dirawat"] = $surat_persetujuan_dirawat;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.alatbantu.surat-persetujuan-dirawat.print", $data);
        return $pdf->stream("print.pdf");
    }
}