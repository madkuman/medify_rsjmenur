<?php

namespace App\Http\Controllers\Kasus\Asesmen\RingkasanPasienPulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RingkasanPasienPulang;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$ringkasan_pasien_pulang = RingkasanPasienPulang::find($req->id);
    	
        $ringkasan_pasien_pulang->keluhan_utama = $req->keluhan_utama;
        $ringkasan_pasien_pulang->perjalanan_penyakit_pasien = $req->perjalanan_penyakit_pasien;
        $ringkasan_pasien_pulang->keluhan_lain = $req->keluhan_lain;
        $ringkasan_pasien_pulang->riwayat_penyakit_sebelumnya = $req->riwayat_penyakit_sebelumnya;
        $ringkasan_pasien_pulang->riwayat_keluarga = $req->riwayat_keluarga;
        $ringkasan_pasien_pulang->riwayat_penyakit_lain_lain = $req->riwayat_penyakit_lain_lain;
        $ringkasan_pasien_pulang->fisik = $req->fisik;
        $ringkasan_pasien_pulang->psikiatrik = $req->psikiatrik;
        $ringkasan_pasien_pulang->laboratorium = $req->laboratorium;
        $ringkasan_pasien_pulang->radiologi = $req->radiologi;
        $ringkasan_pasien_pulang->pemeriksaan_lain_lain = $req->pemeriksaan_lain_lain;
        $ringkasan_pasien_pulang->indikasi_mrs_diagnosa_masuk = $req->indikasi_mrs_diagnosa_masuk;
        $ringkasan_pasien_pulang->axis_1 = $req->axis_1;
        $ringkasan_pasien_pulang->icd_10_axis_1 = $req->icd_10_axis_1;
        $ringkasan_pasien_pulang->axis_2 = $req->axis_2;
        $ringkasan_pasien_pulang->icd_10_axis_2 = $req->icd_10_axis_2;
        $ringkasan_pasien_pulang->axis_3 = $req->axis_3;
        $ringkasan_pasien_pulang->icd_10_axis_3 = $req->icd_10_axis_3;
        $ringkasan_pasien_pulang->axis_4 = $req->axis_4;
        $ringkasan_pasien_pulang->axis_5 = $req->axis_5;
        $ringkasan_pasien_pulang->diagnosa_sekunder = $req->diagnosa_sekunder;
        $ringkasan_pasien_pulang->icd_10_diagnosa_sekunder = $req->icd_10_diagnosa_sekunder;
        $ringkasan_pasien_pulang->diagnosa_komplikasi = $req->diagnosa_komplikasi;
        $ringkasan_pasien_pulang->icd_10_diagnosa_komplikasi = $req->icd_10_diagnosa_komplikasi;
        $ringkasan_pasien_pulang->masalah_utama_yang_dihadapi = $req->masalah_utama_yang_dihadapi;
        $ringkasan_pasien_pulang->konsultasi = $req->konsultasi;
        $ringkasan_pasien_pulang->pengobatan_medis = $req->pengobatan_medis;
        $ringkasan_pasien_pulang->tindakan_medis_operatif_non_operatif = $req->tindakan_medis_operatif_non_operatif;
        $ringkasan_pasien_pulang->perjalanan_penyakit_selama_perawatan = $req->perjalanan_penyakit_selama_perawatan;
        $ringkasan_pasien_pulang->keadaan_waktu_krs = $req->keadaan_waktu_krs;
        $ringkasan_pasien_pulang->sebab_meninggal = $req->sebab_meninggal;
        $ringkasan_pasien_pulang->tindak_lanjut = $req->tindak_lanjut;
        $ringkasan_pasien_pulang->catatan_khusus = $req->catatan_khusus;
        $ringkasan_pasien_pulang->updated_by = Auth::user()->id;
    	$ringkasan_pasien_pulang->save();
    }
}