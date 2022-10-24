<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenRisikoJatuhPsikiatri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AsesmenRisikoJatuhPsikiatri;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $asesmen_risiko_jatuh_psikiatri = AsesmenRisikoJatuhPsikiatri::with(["creator"])->where("kasus_id",$kasus->id)
        ->orderBy("tanggal_risiko_jatuh","desc")->get();

        $data["asesmen_risiko_jatuh_psikiatri"] = $asesmen_risiko_jatuh_psikiatri;
        $data["sidebar_active"] = "alat";

        return view("kasus.alatbantu.asesmen-risiko-jatuh-psikiatri.index", $data);
    }

    function print(Request $request, $nomor_kasus){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $asesmen_risiko_jatuh_psikiatri = AsesmenRisikoJatuhPsikiatri::with(["creator"])->where('kasus_id', $kasus->id)->orderBy('tanggal_risiko_jatuh', 'asc')->get();
        $allItem = [];
        $halaman = ceil(count($asesmen_risiko_jatuh_psikiatri)/8);
        for ($i=0; $i < $halaman; $i++) {
            for ($j=0; $j < 8 ; $j++) { 
                if(isset($asesmen_risiko_jatuh_psikiatri[$i*8 + $j])){
                    $allItem[$i][$j]['usia_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['usia_skor'];
                    $allItem[$i][$j]['status_mental_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['status_mental_skor'];
                    $allItem[$i][$j]['eliminasi_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['eliminasi_skor'];
                    $allItem[$i][$j]['ambulasi_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['ambulasi_skor'];
                    $allItem[$i][$j]['nutrisi_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['nutrisi_skor'];
                    $allItem[$i][$j]['gangguan_pola_tidur_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['gangguan_pola_tidur_skor'];
                    $allItem[$i][$j]['riwayat_jatuh_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['riwayat_jatuh_skor'];
                    $allItem[$i][$j]['tanggal_risiko_jatuh'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['tanggal_risiko_jatuh'];
                    $allItem[$i][$j]['jam_risiko_jatuh'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['jam_risiko_jatuh'];
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning'];
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning'];
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda'];
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda'];
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_motivasi_keluarga'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pasien_skor_lebih_dari_90_motivasi_keluarga'];
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station'];
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil'];
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_orientasikan_pasien'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pasien_skor_lebih_dari_90_orientasikan_pasien'];
                    $allItem[$i][$j]['tanggal_pasien'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['tanggal_pasien'];
                    $allItem[$i][$j]['jam_pasien'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['jam_pasien'];
                    $allItem[$i][$j]['creator'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['creator'];

                    $allItem[$i][$j]['pengobatan_tanpa_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pengobatan_tanpa_skor'];
                    $allItem[$i][$j]['pengobatan_jantung_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pengobatan_jantung_skor'];
                    $allItem[$i][$j]['pengobatan_psikotoprik_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pengobatan_psikotoprik_skor'];
                    $allItem[$i][$j]['pengobatan_tambahan_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pengobatan_tambahan_skor'];

                    $allItem[$i][$j]['diagnosa_bipolar_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['diagnosa_bipolar_skor'];
                    $allItem[$i][$j]['diagnosa_obat_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['diagnosa_obat_skor'];
                    $allItem[$i][$j]['diagnosa_gangguan_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['diagnosa_gangguan_skor'];
                    $allItem[$i][$j]['diagnosa_demensia_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['diagnosa_demensia_skor'];

                    $allItem[$i][$j]['pengobatan_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pengobatan_tanpa_skor'] + $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pengobatan_jantung_skor'] + $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pengobatan_psikotoprik_skor'] + $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['pengobatan_tambahan_skor'];
                    $allItem[$i][$j]['diagnosa_skor'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['diagnosa_bipolar_skor'] + $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['diagnosa_obat_skor'] + $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['diagnosa_gangguan_skor'] + $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['diagnosa_demensia_skor'];

                    $pengobatan_skor = $allItem[$i][$j]['pengobatan_skor'];
                    $diagnosa_skor = $allItem[$i][$j]['diagnosa_skor'];

                    $allItem[$i][$j]['total'] = $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['usia_skor'] + $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['status_mental_skor'] + $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['eliminasi_skor'] + $pengobatan_skor + $diagnosa_skor + $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['ambulasi_skor'] + $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['nutrisi_skor'] + $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['gangguan_pola_tidur_skor'] + $asesmen_risiko_jatuh_psikiatri[$i*8 + $j]['riwayat_jatuh_skor'];
                    
                }
                else{
                    $allItem[$i][$j]['usia'] = null;
                    $allItem[$i][$j]['status_mental'] = null;
                    $allItem[$i][$j]['eliminasi'] = null;
                    $allItem[$i][$j]['pengobatan'] = null;
                    $allItem[$i][$j]['diagnosa'] = null;
                    $allItem[$i][$j]['ambulasi'] = null;
                    $allItem[$i][$j]['nutrisi'] = null;
                    $allItem[$i][$j]['gangguan_pola_tidur'] = null;
                    $allItem[$i][$j]['riwayat_jatuh'] = null;
                    $allItem[$i][$j]['tanggal_risiko_jatuh'] = null;
                    $allItem[$i][$j]['jam_risiko_jatuh'] = null;
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning'] = null;
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning'] = null;
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda'] = null;
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda'] = null;
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_motivasi_keluarga'] = null;
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station'] = null;
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil'] = null;
                    $allItem[$i][$j]['pasien_skor_lebih_dari_90_orientasikan_pasien'] = null;
                    $allItem[$i][$j]['tanggal_pasien'] = null;
                    $allItem[$i][$j]['jam_pasien'] = null;
                    $allItem[$i][$j]['total'] = null;
                }
            } 
        }

        // foreach ($asesmen_risiko_jatuh_psikiatri as $key => $value) {
        //     $allItem['tanggal_risiko_jatuh'][$key] = $value->tanggal_risiko_jatuh;
        //     $allItem['jam_risiko_jatuh'][$key] = $value->jam_risiko_jatuh;
        //     $allItem['usia_skor'][$key] = $value->usia_skor;
        //     $allItem['status_mental_skor'][$key] = $value->status_mental_skor;
        //     $allItem['eliminasi_skor'][$key] = $value->eliminasi_skor;
        // }
        // $data["total"] = $asesmen_risiko_jatuh_psikiatri->usia_skor + $asesmen_risiko_jatuh_psikiatri->status_mental_skor + $asesmen_risiko_jatuh_psikiatri->eliminasi_skor + $asesmen_risiko_jatuh_psikiatri->pengobatan_skor + $asesmen_risiko_jatuh_psikiatri->diagnosa_skor + $asesmen_risiko_jatuh_psikiatri->ambulasi_skor + $asesmen_risiko_jatuh_psikiatri->nutrisi_skor + $asesmen_risiko_jatuh_psikiatri->gangguan_pola_tidur_skor + $asesmen_risiko_jatuh_psikiatri->riwayat_jatuh_skor;
        
        $data["asesmen_risiko_jatuh_psikiatri"] = $asesmen_risiko_jatuh_psikiatri;
        $data["allItem"] = $allItem;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.alatbantu.asesmen-risiko-jatuh-psikiatri.print", $data);
        return $pdf->stream("print.pdf");
    }
}