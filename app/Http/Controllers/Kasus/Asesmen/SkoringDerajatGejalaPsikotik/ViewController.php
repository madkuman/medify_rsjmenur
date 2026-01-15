<?php

namespace App\Http\Controllers\Kasus\Asesmen\SkoringDerajatGejalaPsikotik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\SkoringDerajatGejalaPsikotik;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $skoring_derajat_gejala_psikotik = SkoringDerajatGejalaPsikotik::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["skoring_derajat_gejala_psikotik"] = $skoring_derajat_gejala_psikotik;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.skoring-derajat-gejala-psikotik.index", $data);
	}

    function print(Request $request, $nomor_kasus){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $skoring_derajat_gejala_psikotik = SkoringDerajatGejalaPsikotik::with(["creator"])->where("kasus_id",$kasus->id)
                ->orderBy("id","asc")->get();

        $all_data[0][0] = 'Penampilan ';
        $all_data[1][0] = 'Aktivitas Sosial ';
        $all_data[2][0] = 'Sikap ';
        $all_data[3][0] = 'Cara Bicara ';
        $all_data[4][0] = 'Cara Berpikir ';
        $all_data[5][0] = 'Perilaku ';
        $all_data[6][0] = 'Fungsi Intelek dan Orientasi ';
        $all_data[7][0] = 'Pengendalian Emosi ';
        $all_data[8][0] = 'Fungsi Persepsi ';
        $all_data[9][0] = 'Tilikan';
        $all_data[10][0] = 'Total';
        $all_data[11][0] = 'Tanggal Pelaksanaan Skoring';
        $all_data[12][0] = 'Jam';
        $all_data[13][0] = 'Tempat Pelaksanaan Skoring';
        $all_data[14][0] = 'Penilai';

        $j = 1;
        foreach ($skoring_derajat_gejala_psikotik as $skoring) {
            $all_data[0][$j] = $skoring->penampilan;
            $all_data[1][$j] = $skoring->aktivitas_sosial;
            $all_data[2][$j] = $skoring->sikap;
            $all_data[3][$j] = $skoring->cara_bicara;
            $all_data[4][$j] = $skoring->cara_berpikir;
            $all_data[5][$j] = $skoring->perilaku;
            $all_data[6][$j] = $skoring->fungsi_intelek_dan_orientasi;
            $all_data[7][$j] = $skoring->pengendalian_emosi;
            $all_data[8][$j] = $skoring->fungsi_persepsi;
            $all_data[9][$j] = $skoring->tilikan;
            $all_data[10][$j] = $skoring->total;
            $all_data[11][$j] = date('j/m/y', strtotime($skoring->tanggal_pelaksanaan_skoring));
            $all_data[12][$j] = $skoring->jam_pelaksanaan_skoring;
            $all_data[13][$j] = $skoring->tempat_pelaksanaan_skoring;
            $all_data[14][$j] = $skoring->creator->name;
            $j++;
        }

        $data["all_data"] = $all_data;
        $data["sidebar_active"] = "alat";        
        $pdf = DOMPDF::loadView("kasus.asesmen.skoring-derajat-gejala-psikotik.print", $data)->setPaper('a4', 'landscape');
        return $pdf->stream("print.pdf");
    }
}