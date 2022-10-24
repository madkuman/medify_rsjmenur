<?php

namespace App\Http\Controllers\Kasus\Psikologi\PemeriksaanPsikologisAnak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use DOMPDF;

class ViewController extends Controller
{
    public function print($nomor_kasus, $id,$path = null)
    {
        $kasus = Kasus::with(["lokasi.lokasi.departemen", "identitas",
            "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator",
            "TransaksiRawatInap", "myInvitation"])->where("nomor_kasus", $nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $pemeriksaan_psikologis_anak = app(\App\Http\Controllers\Kasus\Psikologi\PemeriksaanPsikologisAnak\ReadController::class)->getById($id);;

        $data["pemeriksaan_psikologis_anak"] = $pemeriksaan_psikologis_anak;
        $data["sidebar_active"] = "psikologis";

        $pdf = DOMPDF::loadView("kasus.psikologi.pemeriksaan-psikologis-anak.print", $data);
        if($path != null)
        {
            $pdf->save($path);
        }
        return $pdf->stream("print.pdf");
    }
}
