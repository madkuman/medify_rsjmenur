<?php

namespace App\Http\Controllers\Kasus\Asesmen\DischargePlanningLanjutan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\DischargePlanningLanjutan;
use DB;

class EditController extends Controller
{
    public function edit(Request $req){
    	$discharge_planning_lanjutan = DischargePlanningLanjutan::find($req->id);
    	
		$discharge_planning_lanjutan->usia = $req->usia;
		$discharge_planning_lanjutan->dukungan_sosial = $req->dukungan_sosial;
        $discharge_planning_lanjutan->status_fungsional_mandiri = $req->status_fungsional_mandiri;
        $discharge_planning_lanjutan->status_fungsional_bergantung_mandi = $req->status_fungsional_bergantung_mandi;
        $discharge_planning_lanjutan->status_fungsional_bergantung_makan = $req->status_fungsional_bergantung_makan;
        $discharge_planning_lanjutan->status_fungsional_bergantung_ke_kamar_mandi = $req->status_fungsional_bergantung_ke_kamar_mandi;
        $discharge_planning_lanjutan->status_fungsional_bergantung_mobilisasi = $req->status_fungsional_bergantung_mobilisasi;
        $discharge_planning_lanjutan->status_fungsional_bergantung_bab = $req->status_fungsional_bergantung_bab;
        $discharge_planning_lanjutan->status_fungsional_bergantung_bak = $req->status_fungsional_bergantung_bak;
        $discharge_planning_lanjutan->status_fungsional_bergantung_pengobatan = $req->status_fungsional_bergantung_pengobatan;
        $discharge_planning_lanjutan->status_fungsional_bergantung__makanan = $req->status_fungsional_bergantung__makanan;
        $discharge_planning_lanjutan->status_fungsional_bergantung_keuangan = $req->status_fungsional_bergantung_keuangan;
        $discharge_planning_lanjutan->status_fungsional_bergantung_daya_beli = $req->status_fungsional_bergantung_daya_beli;
        $discharge_planning_lanjutan->status_fungsional_bergantung_transportasi = $req->status_fungsional_bergantung_transportasi;
		$discharge_planning_lanjutan->kognitif = $req->kognitif;
        $discharge_planning_lanjutan->perilaku_tenang = $req->perilaku_tenang;
        $discharge_planning_lanjutan->perilaku_bingung = $req->perilaku_bingung;
        $discharge_planning_lanjutan->perilaku_gelisah = $req->perilaku_gelisah;
        $discharge_planning_lanjutan->perilaku_tidak_bisa_tenang = $req->perilaku_tidak_bisa_tenang;
        $discharge_planning_lanjutan->perilaku_lainnya = $req->perilaku_lainnya;
		$discharge_planning_lanjutan->mobilisasi = $req->mobilisasi;
		$discharge_planning_lanjutan->sensorik = $req->sensorik;
		$discharge_planning_lanjutan->perawatan_sebelumnya = $req->perawatan_sebelumnya;
		$discharge_planning_lanjutan->masalah_medis = $req->masalah_medis;
		$discharge_planning_lanjutan->konsumi_obat = $req->konsumi_obat;
    	$discharge_planning_lanjutan->save();
    }
}