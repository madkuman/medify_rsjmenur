<?php

namespace App\Http\Controllers\Kasus\Asesmen\FormTransferInternalRumahSakit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\FormTransferInternalRumahSakit;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$form_transfer_internal_rumah_sakit = new FormTransferInternalRumahSakit;
    	
        if(!empty($req->tanggal_transfer)){        
            $form_transfer_internal_rumah_sakit->tanggal_transfer = Carbon::createFromFormat("d/m/Y", $req->tanggal_transfer);
        } else {
            $form_transfer_internal_rumah_sakit->tanggal_transfer = null;
        }
        $form_transfer_internal_rumah_sakit->alergi_obat = $req->alergi_obat;
        $form_transfer_internal_rumah_sakit->ruangan_asal = $req->ruangan_asal;
        $form_transfer_internal_rumah_sakit->nama_perawat_pengirim = $req->nama_perawat_pengirim;
        $form_transfer_internal_rumah_sakit->jam_berangkat_dari_ruangan = $req->jam_berangkat_dari_ruangan;
        $form_transfer_internal_rumah_sakit->tekanan_darah_1 = $req->tekanan_darah_1;
        $form_transfer_internal_rumah_sakit->nadi_1 = $req->nadi_1;
        $form_transfer_internal_rumah_sakit->suhu_1 = $req->suhu_1;
        $form_transfer_internal_rumah_sakit->respirasi_1 = $req->respirasi_1;
        $form_transfer_internal_rumah_sakit->gcs_e_1 = $req->gcs_e_1;
        $form_transfer_internal_rumah_sakit->gcs_v_1 = $req->gcs_v_1;
        $form_transfer_internal_rumah_sakit->gcs_m_1 = $req->gcs_m_1;
        $form_transfer_internal_rumah_sakit->gelisah_1 = $req->gelisah_1;
        $form_transfer_internal_rumah_sakit->agresif_1 = $req->agresif_1;
        $form_transfer_internal_rumah_sakit->fiksasi_1 = $req->fiksasi_1;
        $form_transfer_internal_rumah_sakit->korban_pasung_1 = $req->korban_pasung_1;
        $form_transfer_internal_rumah_sakit->indikasi_bunuh_diri_1 = $req->indikasi_bunuh_diri_1;
        $form_transfer_internal_rumah_sakit->indikasi_jatuh_1 = $req->indikasi_jatuh_1;
        $form_transfer_internal_rumah_sakit->skala_nyeri_1 = $req->skala_nyeri_1;
        $form_transfer_internal_rumah_sakit->ruangan_tujuan = $req->ruangan_tujuan;
        $form_transfer_internal_rumah_sakit->nama_perawat_penerima = $req->nama_perawat_penerima;
        $form_transfer_internal_rumah_sakit->jam_tiba_di_ruangan = $req->jam_tiba_di_ruangan;
        $form_transfer_internal_rumah_sakit->tekanan_darah_2 = $req->tekanan_darah_2;
        $form_transfer_internal_rumah_sakit->nadi_2 = $req->nadi_2;
        $form_transfer_internal_rumah_sakit->suhu_2 = $req->suhu_2;
        $form_transfer_internal_rumah_sakit->respirasi_2 = $req->respirasi_2;
        $form_transfer_internal_rumah_sakit->gcs_e_2 = $req->gcs_e_2;
        $form_transfer_internal_rumah_sakit->gcs_v_2 = $req->gcs_v_2;
        $form_transfer_internal_rumah_sakit->gcs_m_2 = $req->gcs_m_2;
        $form_transfer_internal_rumah_sakit->keterangan_radiologi = $req->keterangan_radiologi;
        $form_transfer_internal_rumah_sakit->keterangan_laborat = $req->keterangan_laborat;
        $form_transfer_internal_rumah_sakit->keterangan_ekg = $req->keterangan_ekg;
        $form_transfer_internal_rumah_sakit->keterangan_eeg = $req->keterangan_eeg;
        $form_transfer_internal_rumah_sakit->gelisah_2 = $req->gelisah_2;
        $form_transfer_internal_rumah_sakit->agresif_2 = $req->agresif_2;
        $form_transfer_internal_rumah_sakit->fiksasi_2 = $req->fiksasi_2;
        $form_transfer_internal_rumah_sakit->korban_pasung_2 = $req->korban_pasung_2;
        $form_transfer_internal_rumah_sakit->indikasi_bunuh_diri_2 = $req->indikasi_bunuh_diri_2;
        $form_transfer_internal_rumah_sakit->indikasi_jatuh_2 = $req->indikasi_jatuh_2;
        $form_transfer_internal_rumah_sakit->skala_nyeri_2 = $req->skala_nyeri_2;
        $form_transfer_internal_rumah_sakit->keterangan_khusus = $req->keterangan_khusus;
        $form_transfer_internal_rumah_sakit->pemeriksaan_radiologi = $req->pemeriksaan_radiologi;
        $form_transfer_internal_rumah_sakit->pemeriksaan_laborat = $req->pemeriksaan_laborat;
        $form_transfer_internal_rumah_sakit->pemeriksaan_ekg = $req->pemeriksaan_ekg;
        $form_transfer_internal_rumah_sakit->pemeriksaan_eeg_bm = $req->pemeriksaan_eeg_bm;
        $form_transfer_internal_rumah_sakit->pemeriksaan_eeg_bm = $req->pemeriksaan_eeg_bm;
        $form_transfer_internal_rumah_sakit->hasil_pemeriksaan_keluar_radiologi = $req->hasil_pemeriksaan_keluar_radiologi;
        $form_transfer_internal_rumah_sakit->hasil_pemeriksaan_keluar_laborat = $req->hasil_pemeriksaan_keluar_laborat;
        $form_transfer_internal_rumah_sakit->hasil_pemeriksaan_keluar_ekg = $req->hasil_pemeriksaan_keluar_ekg;
        $form_transfer_internal_rumah_sakit->hasil_pemeriksaan_keluar_eeg_bm = $req->hasil_pemeriksaan_keluar_eeg_bm;
        $form_transfer_internal_rumah_sakit->hasil_pemeriksaan_keluar_eeg_bm = $req->hasil_pemeriksaan_keluar_eeg_bm;
        $form_transfer_internal_rumah_sakit->obat_yang_dibawa = $req->obat_yang_dibawa;
    	$form_transfer_internal_rumah_sakit->created_by = Auth::user()->id;
    	$form_transfer_internal_rumah_sakit->kasus_id = $kasus_id;
    	$form_transfer_internal_rumah_sakit->save();
    }
}