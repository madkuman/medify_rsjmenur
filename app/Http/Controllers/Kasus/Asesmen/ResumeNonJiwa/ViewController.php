<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResumeNonJiwa;

use App\Models\Kasus\ResumeNonJiwa;
use App\Models\RawatJalan\Poliklinik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $data["poli"] = Poliklinik::all();
        $resume_non_jiwa = ResumeNonJiwa::with(["creator"])->where("kasus_id",$kasus->id)
        		->with('poli')->orderBy("id","desc")->get();

        $data["resume_non_jiwa"] = $resume_non_jiwa;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.resume-non-jiwa.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $resume_non_jiwa = ResumeNonJiwa::with(["creator"])->where("kasus_id",$kasus->id)->where("id",$id)
                ->orderBy("id","desc")->first();

        $data["item"] = $resume_non_jiwa;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.asesmen.resume-non-jiwa.print", $data);
        return $pdf->stream("print.pdf");
    }
}