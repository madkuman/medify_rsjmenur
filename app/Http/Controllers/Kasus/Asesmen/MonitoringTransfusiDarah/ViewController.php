<?php

namespace App\Http\Controllers\Kasus\Asesmen\MonitoringTransfusiDarah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\MonitoringTransfusiDarah;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $monitoring_transfusi_darah = MonitoringTransfusiDarah::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["monitoring_transfusi_darah"] = $monitoring_transfusi_darah;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.monitoring-transfusi-darah.index", $data);
	}
}