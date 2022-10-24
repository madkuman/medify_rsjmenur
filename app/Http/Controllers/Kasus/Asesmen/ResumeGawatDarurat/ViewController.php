<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResumeGawatDarurat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\ResumeGawatDarurat;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $resume_gawat_darurat = ResumeGawatDarurat::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["resume_gawat_darurat"] = $resume_gawat_darurat;
        $data["sidebar_active"] = "resume";
        $data['active_nav'] = 'resume_gawat_darurat';

        return view("kasus.resume.index", $data);
        return view("kasus.asesmen.resume-gawat-darurat.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $resume_gawat_darurat = ResumeGawatDarurat::with(["creator"])->where("kasus_id",$kasus->id)->where("id",$id)
                ->orderBy("id","desc")->first();

        $data["item"] = $resume_gawat_darurat;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.asesmen.resume-gawat-darurat.print", $data);
        return $pdf->stream("print.pdf");
    }
}