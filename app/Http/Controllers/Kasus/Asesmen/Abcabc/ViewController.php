<?php

namespace App\Http\Controllers\Kasus\Asesmen\Abcabc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Abcabc;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $abcabc = Abcabc::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["abcabc"] = $abcabc;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.abcabc.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $abcabc = Abcabc::with(["creator"])->where("kasus_id",$kasus->id)->where("id",$id)
                ->orderBy("id","desc")->first();

        $data["abcabc"] = $abcabc;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.asesmen.abcabc.print", $data)->setPaper('a4', 'landscape');
        // return view("kasus.asesmen.abcabc.print", $data);
        return $pdf->stream("print.pdf");
    }
}