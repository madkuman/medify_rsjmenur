<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TestingFormAsesmen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\TestingFormAsesmen;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $testing_form_asesmen = TestingFormAsesmen::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["testing_form_asesmen"] = $testing_form_asesmen;
        $data["sidebar_active"] = "alat";

        return view("kasus.alatbantu.testing-form-asesmen.index", $data);
	}
}