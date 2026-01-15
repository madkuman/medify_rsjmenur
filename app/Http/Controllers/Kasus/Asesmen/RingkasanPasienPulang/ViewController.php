<?php

namespace App\Http\Controllers\Kasus\Asesmen\RingkasanPasienPulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\RingkasanPasienPulang;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $ringkasan_pasien_pulang = RingkasanPasienPulang::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")
                ->with('query_axis_1', 'query_axis_3')->get();
        $tindakanAll = app('App\Http\Controllers\Kasus\Tindakan\ReadController')->fetchKasusTindakan($kasus->id, 0);
        $tindakanText = '';
        foreach($tindakanAll as $tindakans){
            $tindakanText.='- '.$tindakans->desc.'\n';
        }

        $data["ringkasan_pasien_pulang"] = $ringkasan_pasien_pulang;
        $data["tindakanText"] = $tindakanText;
        $data["sidebar_active"] = "resume";
        $data['active_nav'] = 'ringkasan_pasien_pulang';

        return view("kasus.resume.index", $data);
        return view("kasus.asesmen.ringkasan-pasien-pulang.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $ringkasan_pasien_pulang = RingkasanPasienPulang::with(["creator"])->where("kasus_id",$kasus->id)->where("id",$id)
                ->orderBy("id","desc")->first();

        $data["item"] = $ringkasan_pasien_pulang;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.asesmen.ringkasan-pasien-pulang.print", $data);
        return $pdf->stream("print.pdf");
    }
    function printnj(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $ringkasan_pasien_pulang = RingkasanPasienPulang::with(["creator"])->where("kasus_id",$kasus->id)->where("id",$id)
                ->orderBy("id","desc")->first();

        $data["item"] = $ringkasan_pasien_pulang;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.asesmen.ringkasan-pasien-pulang.printnj", $data);
        return $pdf->stream("print.pdf");
    }
}