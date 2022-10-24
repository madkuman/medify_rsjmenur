<?php

namespace App\Http\Controllers\Kasus\Asesmen\EvaluasiPerencanaanPemulanganPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\EvaluasiPerencanaanPemulanganPasien;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $evaluasi_perencanaan_pemulangan_pasien = EvaluasiPerencanaanPemulanganPasien::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["evaluasi_perencanaan_pemulangan_pasien"] = $evaluasi_perencanaan_pemulangan_pasien;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.evaluasi-perencanaan-pemulangan-pasien.index", $data);
	}
}