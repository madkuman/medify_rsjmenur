<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianUlangPasienTerminal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengkajianUlangPasienTerminal\PengkajianUlangPasienTerminal;
use DB;
use Auth;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$pengkajian_ulang_pasien_terminal = new PengkajianUlangPasienTerminal;
    	
		$pengkajian_ulang_pasien_terminal->ku = $req->ku;
		$pengkajian_ulang_pasien_terminal->td = $req->td;
		$pengkajian_ulang_pasien_terminal->sn = $req->sn;
		$pengkajian_ulang_pasien_terminal->rr = $req->rr;
		$pengkajian_ulang_pasien_terminal->gcs = $req->gcs;
		$pengkajian_ulang_pasien_terminal->skala_nyeri = $req->skala_nyeri;
		$pengkajian_ulang_pasien_terminal->karakteristik = $req->karakteristik;
		$pengkajian_ulang_pasien_terminal->lokasi = $req->lokasi;
		$pengkajian_ulang_pasien_terminal->durasi = $req->durasi;
		$pengkajian_ulang_pasien_terminal->frekuensi = $req->frekuensi;
        $pengkajian_ulang_pasien_terminal->alat_bantu_yang_dipakai_ventilator = $req->alat_bantu_yang_dipakai_ventilator;
        $pengkajian_ulang_pasien_terminal->alat_bantu_yang_dipakai_oksigen = $req->alat_bantu_yang_dipakai_oksigen;
        $pengkajian_ulang_pasien_terminal->alat_bantu_yang_dipakai_monitor = $req->alat_bantu_yang_dipakai_monitor;
        $pengkajian_ulang_pasien_terminal->alat_bantu_yang_dipakai_tanpa_alat_bantu = $req->alat_bantu_yang_dipakai_tanpa_alat_bantu;
		$pengkajian_ulang_pasien_terminal->alat_bantu_lainnya = $req->alat_bantu_lainnya;
        $pengkajian_ulang_pasien_terminal->tonus_otot_relaksasi_otot_muka = $req->tonus_otot_relaksasi_otot_muka;
        $pengkajian_ulang_pasien_terminal->tonus_otot_kesulitan_dalam_berbicara = $req->tonus_otot_kesulitan_dalam_berbicara;
        $pengkajian_ulang_pasien_terminal->tonus_otot_penurunan_kegiatan_traktus = $req->tonus_otot_penurunan_kegiatan_traktus;
        $pengkajian_ulang_pasien_terminal->tonus_otot_penurunan_control = $req->tonus_otot_penurunan_control;
        $pengkajian_ulang_pasien_terminal->tonus_otot_gerakan_tubuh_terbatas = $req->tonus_otot_gerakan_tubuh_terbatas;
		$pengkajian_ulang_pasien_terminal->tanda_kehilangan_tonus_otot_lainnya = $req->tanda_kehilangan_tonus_otot_lainnya;
        $pengkajian_ulang_pasien_terminal->kelambatan_dalam_sirkulasi_kemunduran_dalam_sensasi = $req->kelambatan_dalam_sirkulasi_kemunduran_dalam_sensasi;
        $pengkajian_ulang_pasien_terminal->kelambatan_dalam_sirkulasi_cyanosis = $req->kelambatan_dalam_sirkulasi_cyanosis;
        $pengkajian_ulang_pasien_terminal->kelambatan_dalam_sirkulasi_kulit_dingin = $req->kelambatan_dalam_sirkulasi_kulit_dingin;
		$pengkajian_ulang_pasien_terminal->tanda_kelambatan_dalam_sirkulasi_lainnya = $req->tanda_kelambatan_dalam_sirkulasi_lainnya;
        $pengkajian_ulang_pasien_terminal->perubahan_ttv_nadi_lambat_dan_lemah = $req->perubahan_ttv_nadi_lambat_dan_lemah;
        $pengkajian_ulang_pasien_terminal->perubahan_ttv_tekanan_darah_turun = $req->perubahan_ttv_tekanan_darah_turun;
        $pengkajian_ulang_pasien_terminal->perubahan_ttv_pernafasan_cepat = $req->perubahan_ttv_pernafasan_cepat;
		$pengkajian_ulang_pasien_terminal->perubahan_perubahan_dalam_tanda_tanda_vital_lainnya = $req->perubahan_perubahan_dalam_tanda_tanda_vital_lainnya;
        $pengkajian_ulang_pasien_terminal->gangguan_sensoria_penglihatan_kabur = $req->gangguan_sensoria_penglihatan_kabur;
        $pengkajian_ulang_pasien_terminal->gangguan_sensoria_gangguan_penciuman_dan_perabaan = $req->gangguan_sensoria_gangguan_penciuman_dan_perabaan;
		$pengkajian_ulang_pasien_terminal->gangguan_sensoria_lainnya = $req->gangguan_sensoria_lainnya;
        $pengkajian_ulang_pasien_terminal->perubahan_fisik_saat_menjelang_kematian_sirkulasi_melambat = $req->perubahan_fisik_saat_menjelang_kematian_sirkulasi_melambat;
        $pengkajian_ulang_pasien_terminal->perubahan_fisik_saat_menjelang_kematian_tonus_otot_menurun = $req->perubahan_fisik_saat_menjelang_kematian_tonus_otot_menurun;
        $pengkajian_ulang_pasien_terminal->perubahan_fisik_saat_menjelang_kematian_perubahan_ttv = $req->perubahan_fisik_saat_menjelang_kematian_perubahan_ttv;
        $pengkajian_ulang_pasien_terminal->perubahan_fisik_saat_menjelang_kematian_berkemih_dan_defekasi = $req->perubahan_fisik_saat_menjelang_kematian_berkemih_dan_defekasi;
        $pengkajian_ulang_pasien_terminal->perubahan_fisik_saat_menjelang_kematian_pasien_kurang_responsive = $req->perubahan_fisik_saat_menjelang_kematian_pasien_kurang_responsive;
        $pengkajian_ulang_pasien_terminal->perubahan_fisik_saat_menjelang_kematian_kulit_memucat = $req->perubahan_fisik_saat_menjelang_kematian_kulit_memucat;
        $pengkajian_ulang_pasien_terminal->perubahan_fisik_saat_menjelang_kematian_pendengaran_terakhir = $req->perubahan_fisik_saat_menjelang_kematian_pendengaran_terakhir;
		$pengkajian_ulang_pasien_terminal->perubahan_fisik_saat_menjelang_kematian_lainnya = $req->perubahan_fisik_saat_menjelang_kematian_lainnya;
        $pengkajian_ulang_pasien_terminal->petunjuk_indikasi_kematian_tidak_ada_respon_terhadap_rangsangan = $req->petunjuk_indikasi_kematian_tidak_ada_respon_terhadap_rangsangan;
        $pengkajian_ulang_pasien_terminal->petunjuk_indikasi_kematian_tidak_adanya_gerak_dari_otot = $req->petunjuk_indikasi_kematian_tidak_adanya_gerak_dari_otot;
        $pengkajian_ulang_pasien_terminal->petunjuk_indikasi_kematian_tidak_ada_reflek = $req->petunjuk_indikasi_kematian_tidak_ada_reflek;
        $pengkajian_ulang_pasien_terminal->petunjuk_indikasi_kematian_gambaran_mendatar_pada_ekg = $req->petunjuk_indikasi_kematian_gambaran_mendatar_pada_ekg;
		$pengkajian_ulang_pasien_terminal->petunjuk_tentang_indikasi_kematian_lainnya = $req->petunjuk_tentang_indikasi_kematian_lainnya;
		$pengkajian_ulang_pasien_terminal->kesukaan_pasien = $req->kesukaan_pasien;
		$pengkajian_ulang_pasien_terminal->rencana_tempat_pemakaman = $req->rencana_tempat_pemakaman;
		$pengkajian_ulang_pasien_terminal->transportasi_jenazah = $req->transportasi_jenazah;
		$pengkajian_ulang_pasien_terminal->kebiasaan_pasien = $req->kebiasaan_pasien;
		$pengkajian_ulang_pasien_terminal->perawatan_jenazah = $req->perawatan_jenazah;
		$pengkajian_ulang_pasien_terminal->informasi_dan_edukasi = $req->informasi_dan_edukasi;
        $pengkajian_ulang_pasien_terminal->pendampingan_rohaniawan = $req->pendampingan_rohaniawan;
    	$pengkajian_ulang_pasien_terminal->created_by = Auth::user()->id;
    	$pengkajian_ulang_pasien_terminal->kasus_id = $kasus_id;
    	$pengkajian_ulang_pasien_terminal->save();
    }
}