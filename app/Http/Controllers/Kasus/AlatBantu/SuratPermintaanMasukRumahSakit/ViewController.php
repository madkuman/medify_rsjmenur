<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratPermintaanMasukRumahSakit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\SuratPermintaanMasukRumahSakit;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $surat_permintaan_masuk_rumah_sakit = SuratPermintaanMasukRumahSakit::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["surat_permintaan_masuk_rumah_sakit"] = $surat_permintaan_masuk_rumah_sakit;
        $data["sidebar_active"] = "alat";

        return view("kasus.alatbantu.surat-permintaan-masuk-rumah-sakit.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $surat_permintaan_masuk_rumah_sakit = SuratPermintaanMasukRumahSakit::with(["creator"])->find($id);

        $data["surat_permintaan_masuk_rumah_sakit"] = $surat_permintaan_masuk_rumah_sakit;
        $data["sidebar_active"] = "alat";

        // $customPaper = array(0,0,816,1344);
        // $pdf = DOMPDF::loadView("kasus.alatbantu.surat-permintaan-masuk-rumah-sakit.print", $data)->setPaper($customPaper);
        $pdf = DOMPDF::loadView("kasus.alatbantu.surat-permintaan-masuk-rumah-sakit.print", $data);
        return $pdf->stream("print.pdf");
    }
}