<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianAwalAnestesiDanSedasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengkajianAwalAnestesiDanSedasi;
use DB;
use Auth;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$pengkajian_awal_anestesi_dan_sedasi = new PengkajianAwalAnestesiDanSedasi;
    	
		$pengkajian_awal_anestesi_dan_sedasi->bb = $req->bb;
		$pengkajian_awal_anestesi_dan_sedasi->tb = $req->tb;
		$pengkajian_awal_anestesi_dan_sedasi->imt = $req->imt;
		$pengkajian_awal_anestesi_dan_sedasi->diagnosis = $req->diagnosis;
		$pengkajian_awal_anestesi_dan_sedasi->tindakan_bedah = $req->tindakan_bedah;
		$pengkajian_awal_anestesi_dan_sedasi->riwayat_asma = $req->riwayat_asma;
		$pengkajian_awal_anestesi_dan_sedasi->alergi = $req->alergi;
		$pengkajian_awal_anestesi_dan_sedasi->dm = $req->dm;
		$pengkajian_awal_anestesi_dan_sedasi->hipertensi = $req->hipertensi;
		$pengkajian_awal_anestesi_dan_sedasi->riwayat_operasi = $req->riwayat_operasi;
		$pengkajian_awal_anestesi_dan_sedasi->jenis_anestesi = $req->jenis_anestesi;
		$pengkajian_awal_anestesi_dan_sedasi->komplikasi = $req->komplikasi;
		$pengkajian_awal_anestesi_dan_sedasi->pemeriksaan_fisik = $req->pemeriksaan_fisik;
		$pengkajian_awal_anestesi_dan_sedasi->keadaan_umum = $req->keadaan_umum;
		$pengkajian_awal_anestesi_dan_sedasi->ttv_tensi = $req->ttv_tensi;
		$pengkajian_awal_anestesi_dan_sedasi->ttv_n = $req->ttv_n;
		$pengkajian_awal_anestesi_dan_sedasi->ttv_rr = $req->ttv_rr;
		$pengkajian_awal_anestesi_dan_sedasi->ttv_t = $req->ttv_t;
		$pengkajian_awal_anestesi_dan_sedasi->ttv_vas = $req->ttv_vas;
		$pengkajian_awal_anestesi_dan_sedasi->kepala_leher = $req->kepala_leher;
		$pengkajian_awal_anestesi_dan_sedasi->conjungtiva = $req->conjungtiva;
		$pengkajian_awal_anestesi_dan_sedasi->gcs = $req->gcs;
		$pengkajian_awal_anestesi_dan_sedasi->malampati = $req->malampati;
		$pengkajian_awal_anestesi_dan_sedasi->thorax = $req->thorax;
		$pengkajian_awal_anestesi_dan_sedasi->abdomen = $req->abdomen;
		$pengkajian_awal_anestesi_dan_sedasi->ekstermitas = $req->ekstermitas;
		$pengkajian_awal_anestesi_dan_sedasi->laboratorium = $req->laboratorium;
		$pengkajian_awal_anestesi_dan_sedasi->ekg = $req->ekg;
		$pengkajian_awal_anestesi_dan_sedasi->ro_thorax = $req->ro_thorax;
		$pengkajian_awal_anestesi_dan_sedasi->pemeriksaan_penunjang_lain = $req->pemeriksaan_penunjang_lain;
		$pengkajian_awal_anestesi_dan_sedasi->setuju_anestesi = $req->setuju_anestesi;
		$pengkajian_awal_anestesi_dan_sedasi->premedikasi = $req->premedikasi;
		$pengkajian_awal_anestesi_dan_sedasi->tidak_setuju_anestesi = $req->tidak_setuju_anestesi;
		$pengkajian_awal_anestesi_dan_sedasi->asa_ps = $req->asa_ps;
		$pengkajian_awal_anestesi_dan_sedasi->puasa = $req->puasa;
		$pengkajian_awal_anestesi_dan_sedasi->rencana_tindakan = $req->rencana_tindakan;
		$pengkajian_awal_anestesi_dan_sedasi->sedasi = $req->sedasi;
		$pengkajian_awal_anestesi_dan_sedasi->ga = $req->ga;
        $pengkajian_awal_anestesi_dan_sedasi->regional_spinal = $req->regional_spinal;
        $pengkajian_awal_anestesi_dan_sedasi->regional_epidural = $req->regional_epidural;
        $pengkajian_awal_anestesi_dan_sedasi->regional_kaudal = $req->regional_kaudal;
        $pengkajian_awal_anestesi_dan_sedasi->regional_block_periver = $req->regional_block_periver;
		$pengkajian_awal_anestesi_dan_sedasi->persediaan_darah = $req->persediaan_darah;
        $pengkajian_awal_anestesi_dan_sedasi->teknik_khusus_hipotensi = $req->teknik_khusus_hipotensi;
        $pengkajian_awal_anestesi_dan_sedasi->teknik_khusus_ventilasi_satu_paru = $req->teknik_khusus_ventilasi_satu_paru;
        $pengkajian_awal_anestesi_dan_sedasi->teknik_khusus_tci = $req->teknik_khusus_tci;
		$pengkajian_awal_anestesi_dan_sedasi->teknik_khusus_lainnya = $req->teknik_khusus_lainnya;
        $pengkajian_awal_anestesi_dan_sedasi->monitoring_ekg_leed = $req->monitoring_ekg_leed;
        $pengkajian_awal_anestesi_dan_sedasi->monitoring_spo2 = $req->monitoring_spo2;
        $pengkajian_awal_anestesi_dan_sedasi->monitoring_nibp = $req->monitoring_nibp;
        $pengkajian_awal_anestesi_dan_sedasi->monitoring_temp = $req->monitoring_temp;
        $pengkajian_awal_anestesi_dan_sedasi->monitoring_cvp = $req->monitoring_cvp;
        $pengkajian_awal_anestesi_dan_sedasi->monitoring_arteleri_line = $req->monitoring_arteleri_line;
        $pengkajian_awal_anestesi_dan_sedasi->monitoring_etco2 = $req->monitoring_etco2;
        $pengkajian_awal_anestesi_dan_sedasi->monitoring_bis = $req->monitoring_bis;
		$pengkajian_awal_anestesi_dan_sedasi->monitoring_lain_lain = $req->monitoring_lain_lain;
        $pengkajian_awal_anestesi_dan_sedasi->perawatan_pasca_anestesi_rawat_jalan = $req->perawatan_pasca_anestesi_rawat_jalan;
        $pengkajian_awal_anestesi_dan_sedasi->perawatan_pasca_anestesi_rawat_inap = $req->perawatan_pasca_anestesi_rawat_inap;
        $pengkajian_awal_anestesi_dan_sedasi->perawatan_pasca_anestesi_icu = $req->perawatan_pasca_anestesi_icu;
        $pengkajian_awal_anestesi_dan_sedasi->perawatan_pasca_anestesi_imcu = $req->perawatan_pasca_anestesi_imcu;
        $pengkajian_awal_anestesi_dan_sedasi->perawatan_pasca_anestesi_nicu = $req->perawatan_pasca_anestesi_nicu;
    	$pengkajian_awal_anestesi_dan_sedasi->created_by = Auth::user()->id;
    	$pengkajian_awal_anestesi_dan_sedasi->kasus_id = $kasus_id;
    	$pengkajian_awal_anestesi_dan_sedasi->save();
    }
}