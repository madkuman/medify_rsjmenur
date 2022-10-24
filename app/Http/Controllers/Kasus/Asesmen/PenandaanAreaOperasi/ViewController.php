<?php

namespace App\Http\Controllers\Kasus\Asesmen\PenandaanAreaOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\PenandaanAreaOperasi;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $penandaan_area_operasi = PenandaanAreaOperasi::with(["creator"])->where("kasus_id",$kasus->id)
        ->orderBy("id","desc")->get();

        $data["penandaan_area_operasi"] = $penandaan_area_operasi;
        $data["sidebar_active"] = "operasi";

        return view("kasus.asesmen.penandaan-area-operasi.index", $data);
    }

    function form(Request $request, $nomor_kasus,$id = null){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $penandaan_area_operasi = PenandaanAreaOperasi::where('id',$id)->with('notes')->first();
        $data["operasi"] = $penandaan_area_operasi;
        $data["sidebar_active"] = "operasi";
        $data['is_edit'] = 1;

        return view("kasus.asesmen.penandaan-area-operasi.form", $data);
    }

    function view(Request $request, $nomor_kasus,$id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $penandaan_area_operasi = PenandaanAreaOperasi::where('id',$id)->with('notes')->first();

        $data["operasi"] = $penandaan_area_operasi;
        $data["sidebar_active"] = "alat";
        $data['is_edit'] = 0;

        return view("kasus.asesmen.penandaan-area-operasi.form", $data);
    }
}