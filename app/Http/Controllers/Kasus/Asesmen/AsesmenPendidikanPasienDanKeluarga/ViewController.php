<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenPendidikanPasienDanKeluarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AsesmenPendidikanPasienDanKeluarga;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $asesmen_pendidikan_pasien_dan_keluarga = AsesmenPendidikanPasienDanKeluarga::with(["creator", "lembar"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["asesmen_pendidikan_pasien_dan_keluarga"] = $asesmen_pendidikan_pasien_dan_keluarga;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.asesmen-pendidikan-pasien-dan-keluarga.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $asesmen_pendidikan_pasien_dan_keluarga = AsesmenPendidikanPasienDanKeluarga::with(["creator", "lembar"])->where("kasus_id",$kasus->id)->where("id",$id)
                ->orderBy("id","desc")->first();

        $data["item"] = $asesmen_pendidikan_pasien_dan_keluarga;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.asesmen.asesmen-pendidikan-pasien-dan-keluarga.print", $data);
        return $pdf->stream("print.pdf");
    }
}