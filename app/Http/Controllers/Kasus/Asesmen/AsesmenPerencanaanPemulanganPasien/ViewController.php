<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenPerencanaanPemulanganPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AsesmenPerencanaanPemulanganPasien;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $asesmen_perencanaan_pemulangan_pasien = AsesmenPerencanaanPemulanganPasien::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["asesmen_perencanaan_pemulangan_pasien"] = $asesmen_perencanaan_pemulangan_pasien;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.asesmen-perencanaan-pemulangan-pasien.index", $data);
	}
}