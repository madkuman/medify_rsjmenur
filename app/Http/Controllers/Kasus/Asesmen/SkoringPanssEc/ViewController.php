<?php

namespace App\Http\Controllers\Kasus\Asesmen\SkoringPanssEc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\SkoringPanssEc;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $skoring_panss_ec = SkoringPanssEc::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["skoring_panss_ec"] = $skoring_panss_ec;
        $data["sidebar_active"] = "alat";

        return view("kasus.asesmen.skoring-panss-ec.index", $data);
	}

    function print(Request $request, $nomor_kasus){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $skoring_panss_ec = SkoringPanssEc::with(["creator"])->where("kasus_id",$kasus->id)
                ->orderBy("id","asc")->get();

        $all_data[0][0] = 'GADUH GELISAH ';
        $all_data[1][0] = 'PERMUSUHAN ';
        $all_data[2][0] = 'KETEGANGAN ';
        $all_data[3][0] = 'KETIDAK KOOPERATIFAN ';
        $all_data[4][0] = 'PENGENDALIAN IMPULS YANG BURUK ';;
        $all_data[5][0] = 'TOTAL';
        $all_data[6][0] = 'Tanggal dan Jam Pelaksanaan Skoring';        
        $all_data[7][0] = 'Tempat  Pelaksanaan Skoring';
        $all_data[8][0] = 'Penilai';

        $j = 1;
        foreach ($skoring_panss_ec as $skoring) {
            $all_data[0][$j] = $skoring->gaduh_gelisah;
            $all_data[1][$j] = $skoring->permusuhan;
            $all_data[2][$j] = $skoring->ketegangan;
            $all_data[3][$j] = $skoring->ketidak_kooperatifan;
            $all_data[4][$j] = $skoring->pengendalian_impuls_yang_buruk;
            $all_data[5][$j] = $skoring->total;
            $all_data[6][$j] = date('j/m/y', strtotime($skoring->tanggal_pelaksanaan_skoring)) .' '. $skoring->jam_pelaksanaan_skoring;;            
            $all_data[7][$j] = $skoring->tempat_pelaksanaan_skoring;
            $all_data[8][$j] = $skoring->creator->name;
            $j++;
        }

        $data["all_data"] = $all_data;
        $data["sidebar_active"] = "alat"; 
        set_time_limit(300);       
        $pdf = DOMPDF::loadView("kasus.asesmen.skoring-panss-ec.print", $data)->setPaper('a4', 'landscape');
        return $pdf->stream("print.pdf");
    }
}