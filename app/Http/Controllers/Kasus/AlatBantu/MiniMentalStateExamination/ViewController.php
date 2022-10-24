<?php

namespace App\Http\Controllers\Kasus\AlatBantu\MiniMentalStateExamination;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\MiniMentalStateExamination;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $mini_mental_state_examination = MiniMentalStateExamination::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["mini_mental_state_examination"] = $mini_mental_state_examination;
        $data["sidebar_active"] = "alat";

        return view("kasus.alatbantu.mini-mental-state-examination.index", $data);
	}

    function print(Request $request, $nomor_kasus){
        $kasus = Kasus::with(relasi)->where("nomor_kasus", $nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $mini_mental_state_examination = MiniMentalStateExamination::with(["creator"])->where('kasus_id', $kasus->id)->get();

        $data["mini_mental_state_examination"] = $mini_mental_state_examination;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.alatbantu.mini-mental-state-examination.print", $data);
        return $pdf->stream("print.pdf");
    }
}