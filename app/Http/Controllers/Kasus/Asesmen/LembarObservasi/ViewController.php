<?php

namespace App\Http\Controllers\Kasus\Asesmen\LembarObservasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\LembarObservasi;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $lembar_observasi = LembarObservasi::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["lembar_observasi"] = $lembar_observasi;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.lembar-observasi.index", $data);
	}

    function print(Request $request, $nomor_kasus){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $lembar_observasi = LembarObservasi::with(["creator"])->where("kasus_id",$kasus->id)
                ->orderBy("id","asc")->get();

        $all_masuk = 0;
        $all_keluar = 0;

        foreach ($lembar_observasi as $item) {
            $all_masuk += $item->infus;
            $all_masuk += $item->per_os;
            $all_keluar += $item->urine;
            $all_keluar += $item->cairan_lain_lain;
        }
        $balans = $all_masuk - $all_keluar;

        $data["lembar_observasi"] = $lembar_observasi;
        $data["all_masuk"] = $all_masuk;
        $data["all_keluar"] = $all_keluar;
        $data["balans"] = $balans;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.asesmen.lembar-observasi.print", $data);
        return $pdf->stream("print.pdf");
    }
}