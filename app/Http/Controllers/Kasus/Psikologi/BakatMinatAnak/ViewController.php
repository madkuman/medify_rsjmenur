<?php

namespace App\Http\Controllers\Kasus\Psikologi\BakatMinatAnak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\BakatMinatAnak;
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
        $bakat_minat_anak = BakatMinatAnak::with(["creator"])
            ->where("kasus_id", $kasus->id)
    		->orderBy("id", "desc")->get();

        $data['dokters'] = User::whereIn('profesi',[1,4])->get();
        $data["bakat_minat_anak"] = $bakat_minat_anak;
        $data["sidebar_active"] = "psikologi";

        return view("kasus.psikologi.bakat-minat-anak.index", $data);
	}

    function print($nomor_kasus, $id,$path = null){
        $kasus = Kasus::with(["lokasi.lokasi.departemen", "identitas",
            "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator",
            "TransaksiRawatInap", "myInvitation"])->where("nomor_kasus", $nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $bakat_minat_anak = BakatMinatAnak::with(["creator", "dokterPemeriksa"])->find($id);

        $data["bakat_minat_anak"] = $bakat_minat_anak;
        $data["sidebar_active"] = "alat";

        // $customPaper = array(0,0,616,2344);
        // $pdf = DOMPDF::loadView("kasus.psikologi.bakat-minat-anak.print", $data)->setPaper($customPaper);
        $pdf = DOMPDF::loadView("kasus.psikologi.bakat-minat-anak.print", $data)->setPaper('legal', 'portrait');
        if($path != null)
        {
            $pdf->save($path);
        }

        return $pdf->stream("print.pdf");
    }
}