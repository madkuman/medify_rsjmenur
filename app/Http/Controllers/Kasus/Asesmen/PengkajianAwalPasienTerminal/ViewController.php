<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianAwalPasienTerminal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AsesmenAwalPasienTerminal\PengkajianAwalPasienTerminal;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $pengkajian_awal_pasien_terminal = PengkajianAwalPasienTerminal::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["pengkajian_awal_pasien_terminal"] = $pengkajian_awal_pasien_terminal;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.pengkajian-awal-pasien-terminal.index", $data);
	}
}