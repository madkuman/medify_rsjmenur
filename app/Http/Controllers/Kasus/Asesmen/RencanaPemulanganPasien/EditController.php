<?php

namespace App\Http\Controllers\Kasus\Asesmen\RencanaPemulanganPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RencanaPemulanganPasien;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$rencana_pemulangan_pasien = RencanaPemulanganPasien::find($req->id);
    	
        $rencana_pemulangan_pasien->alasan_masuk = $req->alasan_masuk;
        $rencana_pemulangan_pasien->diagnosa_masuk = $req->diagnosa_masuk;
        $rencana_pemulangan_pasien->diagnosa_keperawatan_saat_mrs = $req->diagnosa_keperawatan_saat_mrs;
        $rencana_pemulangan_pasien->estimasi_lamanya_perawatan_pasien = $req->estimasi_lamanya_perawatan_pasien;
        $rencana_pemulangan_pasien->keadaan_krs = $req->keadaan_krs;
        $rencana_pemulangan_pasien->diagnosa_keluar = $req->diagnosa_keluar;
        $rencana_pemulangan_pasien->diagnosa_keperawatan_saat_krs = $req->diagnosa_keperawatan_saat_krs;
        $rencana_pemulangan_pasien->lama_dirawat = $req->lama_dirawat;
        $rencana_pemulangan_pasien->pemeriksaan_penunjang_laboratorium = $req->pemeriksaan_penunjang_laboratorium;
        $rencana_pemulangan_pasien->pemeriksaan_penunjang_eeg = $req->pemeriksaan_penunjang_eeg;
        $rencana_pemulangan_pasien->pemeriksaan_penunjang_bm = $req->pemeriksaan_penunjang_bm;
        $rencana_pemulangan_pasien->pemeriksaan_penunjang_ekg = $req->pemeriksaan_penunjang_ekg;
        $rencana_pemulangan_pasien->pemeriksaan_penunjang_foto_rontgen = $req->pemeriksaan_penunjang_foto_rontgen;
        $rencana_pemulangan_pasien->pemeriksaan_penunjang_lainnya = $req->pemeriksaan_penunjang_lainnya;
        $rencana_pemulangan_pasien->pemeriksaan_penunjang_lainnya = $req->pemeriksaan_penunjang_lainnya;
        $rencana_pemulangan_pasien->pemeriksaan_penunjang_lain_lain = $req->pemeriksaan_penunjang_lain_lain;
        $rencana_pemulangan_pasien->pasien_tinggal_dengan_suami_istri = $req->pasien_tinggal_dengan_suami_istri;
        $rencana_pemulangan_pasien->pasien_tinggal_dengan_sendiri = $req->pasien_tinggal_dengan_sendiri;
        $rencana_pemulangan_pasien->pasien_tinggal_dengan_orang_tua = $req->pasien_tinggal_dengan_orang_tua;
        $rencana_pemulangan_pasien->pasien_tinggal_dengan_anak = $req->pasien_tinggal_dengan_anak;
        $rencana_pemulangan_pasien->pasien_tinggal_dengan_keluarga_lain = $req->pasien_tinggal_dengan_keluarga_lain;
        $rencana_pemulangan_pasien->pasien_tinggal_dengan_lainnya = $req->pasien_tinggal_dengan_lainnya;
        $rencana_pemulangan_pasien->pasien_tinggal_dengan_lainnya = $req->pasien_tinggal_dengan_lainnya;
        $rencana_pemulangan_pasien->pasien_tinggal_dengan_lain_lain = $req->pasien_tinggal_dengan_lain_lain;
        $rencana_pemulangan_pasien->keterangan_lain_lain = $req->keterangan_lain_lain;
        $rencana_pemulangan_pasien->rencana_kegiatan_pasien_saat_pulang_bekerja = $req->rencana_kegiatan_pasien_saat_pulang_bekerja;
        $rencana_pemulangan_pasien->rencana_kegiatan_pasien_saat_pulang_sekolah = $req->rencana_kegiatan_pasien_saat_pulang_sekolah;
        $rencana_pemulangan_pasien->rencana_kegiatan_pasien_saat_pulang_lainnya = $req->rencana_kegiatan_pasien_saat_pulang_lainnya;
        $rencana_pemulangan_pasien->rencana_kegiatan_pasien_saat_pulang_lainnya = $req->rencana_kegiatan_pasien_saat_pulang_lainnya;
        $rencana_pemulangan_pasien->keterangan_pekerjaan = $req->keterangan_pekerjaan;
        $rencana_pemulangan_pasien->keterangan_jenjang_pendidikan = $req->keterangan_jenjang_pendidikan;
        $rencana_pemulangan_pasien->keterangan_kegiatan_lain = $req->keterangan_kegiatan_lain;
        $rencana_pemulangan_pasien->perlu_bantuan_dalam_hal_minum_obat = $req->perlu_bantuan_dalam_hal_minum_obat;
        $rencana_pemulangan_pasien->perlu_bantuan_dalam_hal_mandi = $req->perlu_bantuan_dalam_hal_mandi;
        $rencana_pemulangan_pasien->perlu_bantuan_dalam_hal_makan = $req->perlu_bantuan_dalam_hal_makan;
        $rencana_pemulangan_pasien->perlu_bantuan_dalam_hal_berhias = $req->perlu_bantuan_dalam_hal_berhias;
        $rencana_pemulangan_pasien->perlu_bantuan_dalam_hal_toiletting = $req->perlu_bantuan_dalam_hal_toiletting;
        $rencana_pemulangan_pasien->perlu_bantuan_dalam_hal_toiletting = $req->perlu_bantuan_dalam_hal_toiletting;
        $rencana_pemulangan_pasien->alat_medis_yang_digunakan_saat_keluar_rs = $req->alat_medis_yang_digunakan_saat_keluar_rs;
        $rencana_pemulangan_pasien->keterangan_alat_medis_yang_digunakan = $req->keterangan_alat_medis_yang_digunakan;
        $rencana_pemulangan_pasien->alat_bantu_yang_digunakan_saat_keluar_rs = $req->alat_bantu_yang_digunakan_saat_keluar_rs;
        $rencana_pemulangan_pasien->keterangan_alat_bantu_yang_digunakan = $req->keterangan_alat_bantu_yang_digunakan;
        $rencana_pemulangan_pasien->skor_resiko_jatuh__saat_krs = $req->skor_resiko_jatuh__saat_krs;
        $rencana_pemulangan_pasien->skor_resiko_nyeri_saat_krs = $req->skor_resiko_nyeri_saat_krs;
        $rencana_pemulangan_pasien->diet_khusus = $req->diet_khusus;
        $rencana_pemulangan_pasien->keterangan_diet_khusus = $req->keterangan_diet_khusus;
        $rencana_pemulangan_pasien->nasehat = $req->nasehat;
        $rencana_pemulangan_pasien->updated_by = Auth::user()->id;
    	$rencana_pemulangan_pasien->save();
    }
}