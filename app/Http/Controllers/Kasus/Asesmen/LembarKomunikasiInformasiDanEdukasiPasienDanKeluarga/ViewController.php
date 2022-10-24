<?php

namespace App\Http\Controllers\Kasus\Asesmen\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga = LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga"] = $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.lembar-komunikasi-informasi-dan-edukasi-pasien-dan-keluarga.index", $data);
	}

    function print(Request $request, $nomor_kasus){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga = LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga::with(["creator"])->where("kasus_id",$kasus->id)
                ->orderBy("id","asc")->get();

        $data["lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga"] = $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.asesmen.lembar-komunikasi-informasi-dan-edukasi-pasien-dan-keluarga.print", $data);
        return $pdf->stream("print.pdf");
    }
}