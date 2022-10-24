<?php

namespace App\Http\Controllers\Kasus\Psikologi\IdentifikasiPotensiPsikologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\IdentifikasiPotensiPsikologi;
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
        $identifikasi_potensi_psikologi = IdentifikasiPotensiPsikologi::with(["creator", 'dokterPemeriksa'])
            ->where("kasus_id", $kasus->id)
    		->orderBy("id", "desc")->get();

        $data['dokters'] = User::whereIn('profesi',[1,4])->get();
        $data["identifikasi_potensi_psikologi"] = $identifikasi_potensi_psikologi;
        $data["sidebar_active"] = "psikologi";

        return view("kasus.psikologi.identifikasi-potensi-psikologi.index", $data);
	}

    function print($nomor_kasus, $id,$path){
        $kasus = Kasus::with(relasi)->where("nomor_kasus", $nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $identifikasi_potensi_psikologi = IdentifikasiPotensiPsikologi::with(["creator", "dokterPemeriksa"])->find($id);

        $data["identifikasi_potensi_psikologi"] = $identifikasi_potensi_psikologi;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.psikologi.identifikasi-potensi-psikologi.print", $data);
        if($path != null)
        {
            $pdf->save($path);
        }
        return $pdf->stream("print.pdf");
    }
}