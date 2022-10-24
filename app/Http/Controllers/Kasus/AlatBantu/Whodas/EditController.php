<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Whodas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Whodas;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$whodas = Whodas::find($req->id);
    	
        $whodas->berapa_tahun_menempuh_pendidikan = $req->berapa_tahun_menempuh_pendidikan;
        $whodas->nomor_identitas_responden = $req->nomor_identitas_responden;
        $whodas->nomor_identitas_pewawancara = $req->nomor_identitas_pewawancara;
        $whodas->titik_waktu_penilaian = $req->titik_waktu_penilaian;
        if(!empty($req->waktu_wawancara)){        
            $whodas->waktu_wawancara = Carbon::createFromFormat("d/m/Y", $req->waktu_wawancara);
        } else {
            $whodas->waktu_wawancara = null;
        }
        $whodas->situasi_hidup_saat_wawancara = $req->situasi_hidup_saat_wawancara;
        $whodas->berdiri_untuk_jangka_waktu_yang_lama = $req->berdiri_untuk_jangka_waktu_yang_lama;
        $whodas->melakukan_pekerjaan_rumah = $req->melakukan_pekerjaan_rumah;
        $whodas->mempelajari_hal_baru = $req->mempelajari_hal_baru;
        $whodas->mengalami_kesulitan_bergabung = $req->mengalami_kesulitan_bergabung;
        $whodas->kondisi_kesehatan_mempengaruhi_emosional = $req->kondisi_kesehatan_mempengaruhi_emosional;
        $whodas->berkonsentrasi_dalam_melakukan_sesuatu = $req->berkonsentrasi_dalam_melakukan_sesuatu;
        $whodas->berjalan_dalam_jarak_yang_jauh = $req->berjalan_dalam_jarak_yang_jauh;
        $whodas->mandi = $req->mandi;
        $whodas->berpakaian = $req->berpakaian;
        $whodas->berhubungan_dengan_orang_baru = $req->berhubungan_dengan_orang_baru;
        $whodas->mempertahankan_pertemanan = $req->mempertahankan_pertemanan;
        $whodas->kembali_bekerja_atau_bersekolah = $req->kembali_bekerja_atau_bersekolah;
        $whodas->berapa_hari_anda_mengalami_kesulitan = $req->berapa_hari_anda_mengalami_kesulitan;
        $whodas->berapa_hari_sama_sekali_tidak_mampu_melakukan_aktifitas = $req->berapa_hari_sama_sekali_tidak_mampu_melakukan_aktifitas;
        $whodas->berapa_hari_anda_harus_mengurangi_aktifitas = $req->berapa_hari_anda_harus_mengurangi_aktifitas;
        $whodas->updated_by = Auth::user()->id;
    	$whodas->save();
    }
}