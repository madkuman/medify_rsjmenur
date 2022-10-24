<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianUlangPasienTerminal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\PengkajianUlangPasienTerminal\PengkajianUlangPasienTerminal;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $pengkajian_ulang_pasien_terminal = PengkajianUlangPasienTerminal::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["pengkajian_ulang_pasien_terminal"] = $pengkajian_ulang_pasien_terminal;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.pengkajian-ulang-pasien-terminal.index", $data);
	}
}