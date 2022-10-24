<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenRisikoJatuhPsikiatri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenRisikoJatuhPsikiatri;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$asesmen_risiko_jatuh_psikiatri = new AsesmenRisikoJatuhPsikiatri;
    	
        $asesmen_risiko_jatuh_psikiatri->usia = $req->usia;
        $asesmen_risiko_jatuh_psikiatri->usia_skor = $req->usia_skor ?? "8";
        $asesmen_risiko_jatuh_psikiatri->status_mental = $req->status_mental;
        $asesmen_risiko_jatuh_psikiatri->status_mental_skor = $req->status_mental_skor ?? "-4";
        $asesmen_risiko_jatuh_psikiatri->eliminasi = $req->eliminasi;
        $asesmen_risiko_jatuh_psikiatri->eliminasi_skor = $req->eliminasi_skor ?? "8";
        $asesmen_risiko_jatuh_psikiatri->ambulasi = $req->ambulasi;
        $asesmen_risiko_jatuh_psikiatri->ambulasi_skor = $req->ambulasi_skor ?? "7";
        $asesmen_risiko_jatuh_psikiatri->nutrisi = $req->nutrisi;
        $asesmen_risiko_jatuh_psikiatri->nutrisi_skor = $req->nutrisi_skor ?? "12";
        $asesmen_risiko_jatuh_psikiatri->gangguan_pola_tidur = $req->gangguan_pola_tidur;
        $asesmen_risiko_jatuh_psikiatri->gangguan_pola_tidur_skor = $req->gangguan_pola_tidur_skor ?? "8";
        $asesmen_risiko_jatuh_psikiatri->riwayat_jatuh = $req->riwayat_jatuh;
        $asesmen_risiko_jatuh_psikiatri->riwayat_jatuh_skor = $req->riwayat_jatuh_skor ?? "8";

        $asesmen_risiko_jatuh_psikiatri->pengobatan_tanpa = $req->pengobatan_tanpa ?? "0";
        $asesmen_risiko_jatuh_psikiatri->pengobatan_jantung = $req->pengobatan_jantung ?? "0";
        $asesmen_risiko_jatuh_psikiatri->pengobatan_psikotoprik = $req->pengobatan_psikotoprik ?? "0";
        $asesmen_risiko_jatuh_psikiatri->pengobatan_tambahan = $req->pengobatan_tambahan ?? "0";
        $asesmen_risiko_jatuh_psikiatri->diagnosa_bipolar = $req->diagnosa_bipolar ?? "0";
        $asesmen_risiko_jatuh_psikiatri->diagnosa_obat = $req->diagnosa_obat ?? "0";
        $asesmen_risiko_jatuh_psikiatri->diagnosa_gangguan = $req->diagnosa_gangguan ?? "0";
        $asesmen_risiko_jatuh_psikiatri->diagnosa_demensia = $req->diagnosa_demensia ?? "0";

        $asesmen_risiko_jatuh_psikiatri->pengobatan_tanpa_skor = $req->pengobatan_tanpa_skor ?? "0";
        $asesmen_risiko_jatuh_psikiatri->pengobatan_jantung_skor = $req->pengobatan_jantung_skor ?? "0";
        $asesmen_risiko_jatuh_psikiatri->pengobatan_psikotoprik_skor = $req->pengobatan_psikotoprik_skor ?? "0";
        $asesmen_risiko_jatuh_psikiatri->pengobatan_tambahan_skor = $req->pengobatan_tambahan_skor ?? "0";
        $asesmen_risiko_jatuh_psikiatri->diagnosa_bipolar_skor = $req->diagnosa_bipolar_skor ?? "0";
        $asesmen_risiko_jatuh_psikiatri->diagnosa_obat_skor = $req->diagnosa_obat_skor ?? "0";
        $asesmen_risiko_jatuh_psikiatri->diagnosa_gangguan_skor = $req->diagnosa_gangguan_skor ?? "0";
        $asesmen_risiko_jatuh_psikiatri->diagnosa_demensia_skor = $req->diagnosa_demensia_skor ?? "0";

        if(!empty($req->tanggal_risiko_jatuh)){
            $asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh = Carbon::createFromFormat("d/m/Y", $req->tanggal_risiko_jatuh);
        } else {
            $asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh = null;
        }
        $asesmen_risiko_jatuh_psikiatri->jam_risiko_jatuh = $req->jam_risiko_jatuh;
        $asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning = $req->pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning;
        $asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning = $req->pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning;
        $asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda = $req->pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda;
        $asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda = $req->pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda;
        $asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_motivasi_keluarga = $req->pasien_skor_lebih_dari_90_motivasi_keluarga;
        $asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station = $req->pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station;
        $asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil = $req->pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil;
        $asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_orientasikan_pasien = $req->pasien_skor_lebih_dari_90_orientasikan_pasien;
        $asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_orientasikan_pasien = $req->pasien_skor_lebih_dari_90_orientasikan_pasien;
        if(!empty($req->tanggal_pasien)){        
            $asesmen_risiko_jatuh_psikiatri->tanggal_pasien = Carbon::createFromFormat("d/m/Y", $req->tanggal_pasien);
        } else {
            $asesmen_risiko_jatuh_psikiatri->tanggal_pasien = null;
        }
        $asesmen_risiko_jatuh_psikiatri->jam_pasien = $req->jam_pasien;
    	$asesmen_risiko_jatuh_psikiatri->created_by = Auth::user()->id;
    	$asesmen_risiko_jatuh_psikiatri->kasus_id = $kasus_id;
    	$asesmen_risiko_jatuh_psikiatri->save();
    }
}