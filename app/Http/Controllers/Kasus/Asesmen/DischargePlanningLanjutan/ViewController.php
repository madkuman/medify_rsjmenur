<?php

namespace App\Http\Controllers\Kasus\Asesmen\DischargePlanningLanjutan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\DischargePlanningLanjutan;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $discharge_planning_lanjutan = DischargePlanningLanjutan::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["discharge_planning_lanjutan"] = $discharge_planning_lanjutan;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.discharge-planning-lanjutan.index", $data);
	}
}