<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResikoKekerasanFisik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use MPDF;

define("relasi", [
    "lokasi.lokasi.departemen", "identitas",
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator",
    "TransaksiRawatInap", "myInvitation"
]);

class ViewController extends Controller
{
    function index(Request $request, $nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where("nomor_kasus", $nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $data["alatbantu"] = app(\App\Http\Controllers\Kasus\Asesmen\ResikoKekerasanFisik\ReadController::class)
            ->get($kasus->id);
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.resiko-kekerasan-fisik.index", $data);
    }

    function print(Request $request, $nomor_kasus, $id)
    {
        $kasus = Kasus::with(['pasien'])->where("nomor_kasus", $nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $data["alatbantu"] = app(\App\Http\Controllers\Kasus\Asesmen\ResikoKekerasanFisik\ReadController::class)
            ->getById($id);

        $pdf = MPDF::loadView("kasus.asesmen.resiko-kekerasan-fisik.print", $data, [], ['format' => 'A4-P']);
        return $pdf->stream("print.pdf");
    }
}
