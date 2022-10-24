<?php

namespace App\Http\Controllers\Kasus\AlatBantu\ManagemenDanAsesmenUlangNyeri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\ManagemenDanAsesmenUlangNyeri;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $managemen_dan_asesmen_ulang_nyeri = ManagemenDanAsesmenUlangNyeri::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["managemen_dan_asesmen_ulang_nyeri"] = $managemen_dan_asesmen_ulang_nyeri;
        $data["sidebar_active"] = "alat";

        return view("kasus.alatbantu.managemen-dan-asesmen-ulang-nyeri.index", $data);
	}

    public function print($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $managemen_dan_asesmen_ulang_nyeri = ManagemenDanAsesmenUlangNyeri::with(["creator"])->where("kasus_id",$kasus->id)->orderBy('tanggal', 'desc')->get();
        $data["managemen_dan_asesmen_ulang_nyeri"] = $managemen_dan_asesmen_ulang_nyeri;

        $pdf = DOMPDF::loadView('kasus.alatbantu.managemen-dan-asesmen-ulang-nyeri.print', $data, [])->setPaper('a4', 'landscape');
        return $pdf->stream('magemen_asesmen_ulang_nyeri.pdf');
    }
}