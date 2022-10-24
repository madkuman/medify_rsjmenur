<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianAwalAnestesiDanSedasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\PengkajianAwalAnestesiDanSedasi;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $pengkajian_awal_anestesi_dan_sedasi = PengkajianAwalAnestesiDanSedasi::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["pengkajian_awal_anestesi_dan_sedasi"] = $pengkajian_awal_anestesi_dan_sedasi;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.pengkajian-awal-anestesi-dan-sedasi.index", $data);
	}
}