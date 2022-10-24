<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratKeteranganPemeriksaanKematian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\SuratKeteranganPemeriksaanKematian;
use App\User;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $surat_keterangan_pemeriksaan_kematian = SuratKeteranganPemeriksaanKematian::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data['dokter'] = User::where('profesi',1)->get();
        $data["surat_keterangan_pemeriksaan_kematian"] = $surat_keterangan_pemeriksaan_kematian;
        $data["sidebar_active"] = "alat";

        return view("kasus.alatbantu.surat-keterangan-pemeriksaan-kematian.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $surat_keterangan_pemeriksaan_kematian = SuratKeteranganPemeriksaanKematian::with(["creator"])->find($id);

        $data["surat_keterangan_pemeriksaan_kematian"] = $surat_keterangan_pemeriksaan_kematian;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.alatbantu.surat-keterangan-pemeriksaan-kematian.print", $data);
        return $pdf->stream("print.pdf");
    }
}