<?php

namespace App\Http\Controllers\Kasus\Psikologi\LaporanHasilPemeriksaanPsikologiRekruitmen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\LaporanHasilPemeriksaanPsikologiRekruitmen;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $laporan_psikologi_rekruitmen = LaporanHasilPemeriksaanPsikologiRekruitmen::with(["creator"])
                        ->where("kasus_id",$kasus->id)
                        ->orderBy("id","desc")->get();

        $data["laporan_psikologi_rekruitmen"] = $laporan_psikologi_rekruitmen;
        $data["sidebar_active"] = "psikologi";

        return view("kasus.psikologi.laporan-hasil-pemeriksaan-psikologi-rekruitmen.index", $data);
	}

    function print($nomor_kasus, $id,$path){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $laporan_psikologi_rekruitmen = LaporanHasilPemeriksaanPsikologiRekruitmen::with(["creator"])->find($id);

        $data["laporan_psikologi_rekruitmen"] = $laporan_psikologi_rekruitmen;
        $data["sidebar_active"] = "psikologi";

        $pdf = DOMPDF::loadView("kasus.psikologi.laporan-hasil-pemeriksaan-psikologi-rekruitmen.print", $data)->setPaper('legal', 'portrait');
        if($path != null)
        {
            $pdf->save($path);
        }
        return $pdf->stream("print.pdf");
    }
}