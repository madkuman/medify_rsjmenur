<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianPraInduksiAnestesiDanSedasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\PengkajianPraInduksiAnestesiDanSedasi;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $pengkajian_pra_induksi_anestesi_dan_sedasi = PengkajianPraInduksiAnestesiDanSedasi::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["pengkajian_pra_induksi_anestesi_dan_sedasi"] = $pengkajian_pra_induksi_anestesi_dan_sedasi;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.pengkajian-pra-induksi-anestesi-dan-sedasi.index", $data);
	}
}