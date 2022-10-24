<?php

namespace App\Http\Controllers\Kasus\Psikologi\BakatMinatDewasa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\BakatMinatDewasa;
use App\User;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus", $nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $bakat_minat_dewasa = BakatMinatDewasa::with(["creator"])
            ->where("kasus_id", $kasus->id)
    		->orderBy("id", "desc")->get();

        $data['dokters'] = User::where('profesi',1)->get();
        $data["bakat_minat_dewasa"] = $bakat_minat_dewasa;
        $data["sidebar_active"] = "psikologi";

        return view("kasus.psikologi.bakat-minat-dewasa.index", $data);
	}

    function print($nomor_kasus, $id,$path = null){
        $kasus = Kasus::with(["lokasi.lokasi.departemen", "identitas",
            "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator",
            "TransaksiRawatInap", "myInvitation"])->where("nomor_kasus", $nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $bakat_minat_dewasa = BakatMinatDewasa::with(["creator"])->find($id);

        $data["bakat_minat_dewasa"] = $bakat_minat_dewasa;
        $data["sidebar_active"] = "alat";

        // $customPaper = array(0,0,616,2344);
        // $pdf = DOMPDF::loadView("kasus.psikologi.bakat-minat-dewasa.print", $data)->setPaper($customPaper);
        $pdf = DOMPDF::loadView("kasus.psikologi.bakat-minat-dewasa.print", $data);
        if($path != null)
        {
            $pdf->save($path);
        }

        return $pdf->stream("print.pdf");
    }
}