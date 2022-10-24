<?php

namespace App\Http\Controllers\Kasus\TransferPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\TransferPasien;
use DB;
use Auth;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$transfer_pasien = new TransferPasien;
    	
		$transfer_pasien->dari_ruangan = $req->dari_ruangan;
		$transfer_pasien->ke_ruangan = $req->ke_ruangan;
		$transfer_pasien->tingkat_kesadaran = $req->tingkat_kesadaran;
		$transfer_pasien->gcs = $req->gcs;
		$transfer_pasien->keadaan_umum = $req->keadaan_umum;
		$transfer_pasien->tensi = $req->tensi;
		$transfer_pasien->suhu = $req->suhu;
		$transfer_pasien->ews = $req->ews;
		$transfer_pasien->rr = $req->rr;
		$transfer_pasien->djj = $req->djj;
		$transfer_pasien->cvp = $req->cvp;
		$transfer_pasien->n = $req->n;
		$transfer_pasien->spo2 = $req->spo2;
		$transfer_pasien->ttv_lain_lain = $req->ttv_lain_lain;
		$transfer_pasien->gelang_identifikasi_pasien = $req->gelang_identifikasi_pasien;
		$transfer_pasien->persetujuan_mrs_operasi = $req->persetujuan_mrs_operasi;
		$transfer_pasien->lembar_observasi = $req->lembar_observasi;
		$transfer_pasien->konsul_dr_spesialis = $req->konsul_dr_spesialis;
		$transfer_pasien->pasang_infus = $req->pasang_infus;
        $transfer_pasien->laboratorium_dl = $req->laboratorium_dl;
        $transfer_pasien->laboratorium_gda = $req->laboratorium_gda;
        $transfer_pasien->laboratorium_bjp = $req->laboratorium_bjp;
        $transfer_pasien->laboratorium_elektrolit = $req->laboratorium_elektrolit;
        $transfer_pasien->laboratorium_kk = $req->laboratorium_kk;
        $transfer_pasien->laboratorium_bga = $req->laboratorium_bga;
		$transfer_pasien->lab_lainnya = $req->lab_lainnya;
		$transfer_pasien->ecg_posisi = $req->ecg_posisi;
		$transfer_pasien->ecg_jenis = $req->ecg_jenis;
        $transfer_pasien->radiologi_throax = $req->radiologi_throax;
        $transfer_pasien->radiologi_ct_scan = $req->radiologi_ct_scan;
        $transfer_pasien->radiologi_mri = $req->radiologi_mri;
        $transfer_pasien->radiologi_usg = $req->radiologi_usg;
		$transfer_pasien->radiologi_lainnya = $req->radiologi_lainnya;
		$transfer_pasien->kateter_ukuran = $req->kateter_ukuran;
		$transfer_pasien->kateter_fiksasi = $req->kateter_fiksasi;
		$transfer_pasien->kateter_up = $req->kateter_up;
		$transfer_pasien->diet_oral = $req->diet_oral;
		$transfer_pasien->diet_enteral = $req->diet_enteral;
		$transfer_pasien->diet_ngt_residu = $req->diet_ngt_residu;
		$transfer_pasien->diet_ngt_residu_volume = $req->diet_ngt_residu_volume;
		$transfer_pasien->diet_ngt_residu_warna = $req->diet_ngt_residu_warna;
		$transfer_pasien->diet_parenteral = $req->diet_parenteral;
		$transfer_pasien->rawat_luka_luas_luka = $req->rawat_luka_luas_luka;
		$transfer_pasien->rawat_luka_jumlah_luka = $req->rawat_luka_jumlah_luka;
		$transfer_pasien->drainage = $req->drainage;
		$transfer_pasien->jahit_luka_jenis_benang = $req->jahit_luka_jenis_benang;
		$transfer_pasien->jahit_luka_jumlah = $req->jahit_luka_jumlah;
		if(!empty($req->obat_obatan_oral)) $transfer_pasien->obat_obatan_oral = implode(",", $req->obat_obatan_oral);
		if(!empty($req->obat_obatan_parenteral)) $transfer_pasien->obat_obatan_parenteral = implode(",", $req->obat_obatan_parenteral);
        $transfer_pasien->oksigen_jenis_nasale = $req->oksigen_jenis_nasale;
        $transfer_pasien->oksigen_jenis_masker = $req->oksigen_jenis_masker;
        $transfer_pasien->oksigen_jenis_jacson_race = $req->oksigen_jenis_jacson_race;
		$transfer_pasien->oksigen_ukuran = $req->oksigen_ukuran;
		$transfer_pasien->derajat_transfer = $req->derajat_transfer;
        $transfer_pasien->pendamping_transfer_pemandu = $req->pendamping_transfer_pemandu;
        $transfer_pasien->pendamping_transfer_perawat = $req->pendamping_transfer_perawat;
        $transfer_pasien->pendamping_transfer_dokter = $req->pendamping_transfer_dokter;
        $transfer_pasien->pendamping_transfer_dokter_spesialis = $req->pendamping_transfer_dokter_spesialis;
		$transfer_pasien->metode_transfer = $req->metode_transfer;
		$transfer_pasien->perawat_pasien_lanjutan_yang_masih_dilanjutkan = $req->perawat_pasien_lanjutan_yang_masih_dilanjutkan;
		$transfer_pasien->tingkat_kesadaran_selama_transfer = $req->tingkat_kesadaran_selama_transfer;
		$transfer_pasien->gcs_selama_transfer = $req->gcs_selama_transfer;
		$transfer_pasien->kejadian_klinis_selama_transfer = $req->kejadian_klinis_selama_transfer;
		$transfer_pasien->barang_pasien = $req->barang_pasien;
		$transfer_pasien->keluarga_nama = $req->keluarga_nama;
		$transfer_pasien->keluarga_no_hp = $req->keluarga_no_hp;
    	$transfer_pasien->created_by = Auth::user()->id;
    	$transfer_pasien->kasus_id = $kasus_id;
    	$transfer_pasien->save();
    }
}