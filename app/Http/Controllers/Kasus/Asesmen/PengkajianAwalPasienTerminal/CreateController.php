<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianAwalPasienTerminal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenAwalPasienTerminal\PengkajianAwalPasienTerminal;
use DB;
use Auth;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$pengkajian_awal_pasien_terminal = new PengkajianAwalPasienTerminal;
    	
		$pengkajian_awal_pasien_terminal->ku = $req->ku;
		$pengkajian_awal_pasien_terminal->td = $req->td;
		$pengkajian_awal_pasien_terminal->sn = $req->sn;
		$pengkajian_awal_pasien_terminal->rr = $req->rr;
		$pengkajian_awal_pasien_terminal->gcs = $req->gcs;
		$pengkajian_awal_pasien_terminal->skala_nyeri = $req->skala_nyeri;
		$pengkajian_awal_pasien_terminal->karakteristik = $req->karakteristik;
		$pengkajian_awal_pasien_terminal->lokasi = $req->lokasi;
		$pengkajian_awal_pasien_terminal->durasi = $req->durasi;
		$pengkajian_awal_pasien_terminal->frekuensi = $req->frekuensi;
        $pengkajian_awal_pasien_terminal->alat_bantu_yang_dipakai_ventilator = $req->alat_bantu_yang_dipakai_ventilator;
        $pengkajian_awal_pasien_terminal->alat_bantu_yang_dipakai_oksigen = $req->alat_bantu_yang_dipakai_oksigen;
        $pengkajian_awal_pasien_terminal->alat_bantu_yang_dipakai_monitor = $req->alat_bantu_yang_dipakai_monitor;
        $pengkajian_awal_pasien_terminal->kondisi_psikologis_denial = $req->kondisi_psikologis_denial;
        $pengkajian_awal_pasien_terminal->kondisi_psikologis_sedih = $req->kondisi_psikologis_sedih;
        $pengkajian_awal_pasien_terminal->kondisi_psikologis_depresi = $req->kondisi_psikologis_depresi;
        $pengkajian_awal_pasien_terminal->kondisi_psikologis_marah = $req->kondisi_psikologis_marah;
        $pengkajian_awal_pasien_terminal->kondisi_psikologis_rasa_ketergantungan = $req->kondisi_psikologis_rasa_ketergantungan;
        $pengkajian_awal_pasien_terminal->kondisi_psikologis_kehilangan_harapan = $req->kondisi_psikologis_kehilangan_harapan;
        $pengkajian_awal_pasien_terminal->kondisi_psikologis_menerima = $req->kondisi_psikologis_menerima;
        $pengkajian_awal_pasien_terminal->dukungan_apakah_ada_teman_dekat = $req->dukungan_apakah_ada_teman_dekat;
        $pengkajian_awal_pasien_terminal->dukungan_apakah_ada_keluarga_yang_mendukung = $req->dukungan_apakah_ada_keluarga_yang_mendukung;
        $pengkajian_awal_pasien_terminal->dukungan_tidak_ada_yang_mendukung = $req->dukungan_tidak_ada_yang_mendukung;
        $pengkajian_awal_pasien_terminal->kondisi_spiritual_taat_beribadah = $req->kondisi_spiritual_taat_beribadah;
        $pengkajian_awal_pasien_terminal->kondisi_spiritual_kurang_taat_beribadah = $req->kondisi_spiritual_kurang_taat_beribadah;
        $pengkajian_awal_pasien_terminal->kondisi_spiritual_membutuhkan_pelayanan__rohaniawan = $req->kondisi_spiritual_membutuhkan_pelayanan__rohaniawan;
        $pengkajian_awal_pasien_terminal->kondisi_spiritual_menolak_pelayanan_rohaniawan = $req->kondisi_spiritual_menolak_pelayanan_rohaniawan;
		$pengkajian_awal_pasien_terminal->informasi_dan_edukasi = $req->informasi_dan_edukasi;
		$pengkajian_awal_pasien_terminal->alat_bantu_lainnya = $req->alat_bantu_lainnya;
		$pengkajian_awal_pasien_terminal->kondisi_psikologis_lainnya = $req->kondisi_psikologis_lainnya;
		$pengkajian_awal_pasien_terminal->dukungan_lainnya = $req->dukungan_lainnya;
		$pengkajian_awal_pasien_terminal->kondisi_spiritual_lainnya = $req->kondisi_spiritual_lainnya;
    	$pengkajian_awal_pasien_terminal->created_by = Auth::user()->id;
    	$pengkajian_awal_pasien_terminal->kasus_id = $kasus_id;
    	$pengkajian_awal_pasien_terminal->save();
    }
}