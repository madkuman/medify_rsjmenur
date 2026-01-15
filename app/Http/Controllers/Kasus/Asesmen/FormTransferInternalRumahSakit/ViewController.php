<?php

namespace App\Http\Controllers\Kasus\Asesmen\FormTransferInternalRumahSakit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\FormTransferInternalRumahSakit;
use DOMPDF;

define("relasi", [
    "lokasi.lokasi.departemen",
    "identitas",
    "pembayaran.perusahaan.tipe",
    "pasien",
    "kelas",
    "end_by_creator",
    "TransaksiRawatInap",
    "myInvitation"
]);

class ViewController extends Controller
{
    function index(Request $request, $nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where("nomor_kasus", $nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $form_transfer_internal_rumah_sakit = FormTransferInternalRumahSakit::with(["creator"])->where("kasus_id", $kasus->id)
            ->orderBy("id", "desc")->get();

        $data["form_transfer_internal_rumah_sakit"] = $form_transfer_internal_rumah_sakit;
        $data["sidebar_active"] = "alat";

        $resepAll = "";
        if (count($kasus->resep) > 0) {
            foreach ($kasus->resep as $resep) {
                foreach ($resep->resepDetail as $detail) {
                    if ($detail->kategori == 'racikan') {
                        $resepAll .= '- ' . $detail->racikan . '\n';
                    } else {
                        $resepAll .= '- ' . $detail->obat_name . ', ' . $detail->jumlah . ', ' . $detail->type . '\n';
                    }
                }
            }
        }
        $data["resepAll"] = $resepAll;

        return view("kasus.asesmen.form-transfer-internal-rumah-sakit.index", $data);
    }

    function print(Request $request, $nomor_kasus, $id)
    {
        $kasus = Kasus::with(relasi)->where("nomor_kasus", $nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $form_transfer_internal_rumah_sakit = FormTransferInternalRumahSakit::with(["creator"])->where("kasus_id", $kasus->id)->where("id", $id)
            ->orderBy("id", "desc")->first();

        $data["item"] = $form_transfer_internal_rumah_sakit;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.asesmen.form-transfer-internal-rumah-sakit.print", $data);
        return $pdf->stream("print.pdf");
    }
}
