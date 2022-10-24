<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PemeriksaanPsikologiVisum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\PemeriksaanPsikologiVisum;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $pemeriksaan_psikologi_visum = PemeriksaanPsikologiVisum::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["pemeriksaan_psikologi_visum"] = $pemeriksaan_psikologi_visum;
        $data["sidebar_active"] = "psikologi";

        return view("kasus.alatbantu.pemeriksaan-psikologi-visum.index", $data);
	}

    function print($nomor_kasus, $id,$path = null){
        $kasus = Kasus::with(["lokasi.lokasi.departemen", "identitas",
            "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator",
            "TransaksiRawatInap", "myInvitation"])->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $pemeriksaan_psikologi_visum = PemeriksaanPsikologiVisum::with(["creator"])->find($id);

        $data["pemeriksaan_psikologi_visum"] = $pemeriksaan_psikologi_visum;
        $data["sidebar_active"] = "psikologi";

        $pdf = DOMPDF::loadView("kasus.alatbantu.pemeriksaan-psikologi-visum.print", $data);
        if($path != null)
        {
            $pdf->save($path);
        }
        return $pdf->stream("print.pdf");
    }
}