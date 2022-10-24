<?php

namespace App\Http\Controllers\Kasus\Asesmen\RencanaPemulanganPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\RencanaPemulanganPasien;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $rencana_pemulangan_pasien = RencanaPemulanganPasien::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["rencana_pemulangan_pasien"] = $rencana_pemulangan_pasien;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.rencana-pemulangan-pasien.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $rencana_pemulangan_pasien = RencanaPemulanganPasien::with(["creator"])->where("kasus_id",$kasus->id)->where("id",$id)
                ->orderBy("id","desc")->first();

        $data["item"] = $rencana_pemulangan_pasien;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.asesmen.rencana-pemulangan-pasien.print", $data);
        return $pdf->stream("print.pdf");
    }
}