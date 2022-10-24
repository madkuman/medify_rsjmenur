<?php

namespace App\Http\Controllers\Kasus\AlatBantu\MiniMentalStateExamination;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\MiniMentalStateExamination;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$mini_mental_state_examination = new MiniMentalStateExamination;
    	
        $mini_mental_state_examination->hari_tanggal_bulan_tahun_musim = $req->hari_tanggal_bulan_tahun_musim;
        $mini_mental_state_examination->kita_berada_dimana = $req->kita_berada_dimana;
        $mini_mental_state_examination->nama_tiga_buah_benda = $req->nama_tiga_buah_benda;
        $mini_mental_state_examination->hitung_berturut_turut = $req->hitung_berturut_turut;
        $mini_mental_state_examination->tanya_nama_benda = $req->tanya_nama_benda;
        $mini_mental_state_examination->nama_benda_benda = $req->nama_benda_benda;
        $mini_mental_state_examination->jumlah_percobaan = $req->jumlah_percobaan;
        $mini_mental_state_examination->ulangi_kalimat_berikut = $req->ulangi_kalimat_berikut;
        $mini_mental_state_examination->laksanakan_perintah = $req->laksanakan_perintah;
        $mini_mental_state_examination->bacalah_dan_laksanakan_perintah = $req->bacalah_dan_laksanakan_perintah;
        $mini_mental_state_examination->tulis_sebuah_kalimat = $req->tulis_sebuah_kalimat;
        $mini_mental_state_examination->tirulah_gambar = $req->tirulah_gambar;
    	$mini_mental_state_examination->created_by = Auth::user()->id;
    	$mini_mental_state_examination->kasus_id = $kasus_id;

        $total_skor = 0;
        $total_skor += $req->hari_tanggal_bulan_tahun_musim;
        $total_skor += $req->kita_berada_dimana;
        $total_skor += $req->nama_tiga_buah_benda;
        $total_skor += $req->hitung_berturut_turut;
        $total_skor += $req->tanya_nama_benda;
        $total_skor += $req->nama_benda_benda;
        $total_skor += $req->ulangi_kalimat_berikut;
        $total_skor += $req->laksanakan_perintah;
        $total_skor += $req->bacalah_dan_laksanakan_perintah;
        $total_skor += $req->tulis_sebuah_kalimat;
        $total_skor += $req->tirulah_gambar;

        $mini_mental_state_examination->total_skor = $total_skor;
    	$mini_mental_state_examination->save();
    }
}