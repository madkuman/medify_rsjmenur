<?php

namespace App\Http\Controllers\Kasus\TransferPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Resep;
use App\Models\Kasus\ResepDetail;
use App\Models\Kasus\TransferPasien;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;

        $resep = Resep::where('kasus_id',$kasus->id)->pluck('id')->toArray();
        $obat = ResepDetail::whereIn('kasus_resep_id',$resep)->pluck('obat_name')->toArray();
        $obat = array_unique($obat);

        $data["obat"] = $obat;
        $transfer_pasien = TransferPasien::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["transfer_pasien"] = $transfer_pasien;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.transfer-pasien.index", $data);
	}
}