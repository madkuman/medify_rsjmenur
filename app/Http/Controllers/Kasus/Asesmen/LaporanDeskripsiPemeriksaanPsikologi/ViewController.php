<?php

namespace App\Http\Controllers\Kasus\Asesmen\LaporanDeskripsiPemeriksaanPsikologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\LaporanDeskripsiPemeriksaanPsikologi;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $laporan_deskripsi_pemeriksaan_psikologi = LaporanDeskripsiPemeriksaanPsikologi::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["laporan_deskripsi_pemeriksaan_psikologi"] = $laporan_deskripsi_pemeriksaan_psikologi;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.laporan-deskripsi-pemeriksaan-psikologi.index", $data);
	}

    function print($nomor_kasus, $id,$path = null){
        $kasus = Kasus::with(["lokasi.lokasi.departemen", "identitas",
            "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator",
            "TransaksiRawatInap", "myInvitation"])->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $laporan_deskripsi_pemeriksaan_psikologi = LaporanDeskripsiPemeriksaanPsikologi::with(["creator"])->where("kasus_id",$kasus->id)->where("id",$id)
                ->orderBy("id","desc")->first();

        $data["laporan_deskripsi_pemeriksaan_psikologi"] = $laporan_deskripsi_pemeriksaan_psikologi;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.asesmen.laporan-deskripsi-pemeriksaan-psikologi.print", $data);
        if($path != null)
        {
            $pdf->save($path);
        }
        return $pdf->stream("print.pdf");
    }
}