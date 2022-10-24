<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratKeteranganDalamPerawatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\SuratKeteranganDalamPerawatan;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation", "diagnosisUtama"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $surat_keterangan_dalam_perawatan = SuratKeteranganDalamPerawatan::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["surat_keterangan_dalam_perawatan"] = $surat_keterangan_dalam_perawatan;
        $data["sidebar_active"] = "alat";

        return view("kasus.alatbantu.surat-keterangan-dalam-perawatan.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $surat_keterangan_dalam_perawatan = SuratKeteranganDalamPerawatan::with(["creator"])->find($id);

        $data["surat_keterangan_dalam_perawatan"] = $surat_keterangan_dalam_perawatan;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.alatbantu.surat-keterangan-dalam-perawatan.print", $data);
        return $pdf->stream("print.pdf");
    }
}