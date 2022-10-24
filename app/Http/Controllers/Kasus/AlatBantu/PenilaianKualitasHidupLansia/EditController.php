<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PenilaianKualitasHidupLansia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PenilaianKualitasHidupLansia;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$penilaian_kualitas_hidup_lansia = PenilaianKualitasHidupLansia::find($req->id);
    	
        $penilaian_kualitas_hidup_lansia->saya_tidak_bermasalah_untuk_berjalan_keliling = $req->saya_tidak_bermasalah_untuk_berjalan_keliling;
        if(!empty($req->tanggal_tidak_masalah_berjalan_keliling)){        
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_masalah_berjalan_keliling = Carbon::createFromFormat("d/m/Y", $req->tanggal_tidak_masalah_berjalan_keliling);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_masalah_berjalan_keliling = null;
        }
        if(!empty($req->tanggal_masalah_berjalan_keliling)){        
            $penilaian_kualitas_hidup_lansia->tanggal_masalah_berjalan_keliling = Carbon::createFromFormat("d/m/Y", $req->tanggal_masalah_berjalan_keliling);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_masalah_berjalan_keliling = null;
        }
        $penilaian_kualitas_hidup_lansia->saya_mengalami_masalah_untuk_berjalan_keliling = $req->saya_mengalami_masalah_untuk_berjalan_keliling;
        if(!empty($req->tanggal_terbaring_di_kasur)){        
            $penilaian_kualitas_hidup_lansia->tanggal_terbaring_di_kasur = Carbon::createFromFormat("d/m/Y", $req->tanggal_terbaring_di_kasur);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_terbaring_di_kasur = null;
        }
        $penilaian_kualitas_hidup_lansia->saya_hanya_terbaring_di_kasur = $req->saya_hanya_terbaring_di_kasur;
        if(!empty($req->tanggal_mengurus_diri_sendiri)){        
            $penilaian_kualitas_hidup_lansia->tanggal_mengurus_diri_sendiri = Carbon::createFromFormat("d/m/Y", $req->tanggal_mengurus_diri_sendiri);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_mengurus_diri_sendiri = null;
        }
        $penilaian_kualitas_hidup_lansia->saya_tidak_bermasalah_mengurus_diri_sendiri = $req->saya_tidak_bermasalah_mengurus_diri_sendiri;
        if(!empty($req->tanggal_bermasalah_membersihkan_pakaian)){        
            $penilaian_kualitas_hidup_lansia->tanggal_bermasalah_membersihkan_pakaian = Carbon::createFromFormat("d/m/Y", $req->tanggal_bermasalah_membersihkan_pakaian);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_bermasalah_membersihkan_pakaian = null;
        }
        $penilaian_kualitas_hidup_lansia->saya_bermasalah_untuk_membersihkan_dan_memakai_pakaian_sendiri = $req->saya_bermasalah_untuk_membersihkan_dan_memakai_pakaian_sendiri;
        
        if(!empty($req->tanggal_tidak_mampu_sama_sekali_memakai_pakaian)){        
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_mampu_sama_sekali_memakai_pakaian = Carbon::createFromFormat("d/m/Y", $req->tanggal_tidak_mampu_sama_sekali_memakai_pakaian);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_mampu_sama_sekali_memakai_pakaian = null;
        }        

        $penilaian_kualitas_hidup_lansia->saya_tidak_mampu_memakai_pakaian_sendiri = $req->saya_tidak_mampu_memakai_pakaian_sendiri;
        if(!empty($req->tanggal_aktivitas_harian)){        
            $penilaian_kualitas_hidup_lansia->tanggal_aktivitas_harian = Carbon::createFromFormat("d/m/Y", $req->tanggal_aktivitas_harian);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_aktivitas_harian = null;
        }
        $penilaian_kualitas_hidup_lansia->saya_tidak_bermasalah_melakukan_aktivitas_harian = $req->saya_tidak_bermasalah_melakukan_aktivitas_harian;
        if(!empty($req->tanggal_bermasalah_aktivitas_harian)){        
            $penilaian_kualitas_hidup_lansia->tanggal_bermasalah_aktivitas_harian = Carbon::createFromFormat("d/m/Y", $req->tanggal_bermasalah_aktivitas_harian);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_bermasalah_aktivitas_harian = null;
        }
        $penilaian_kualitas_hidup_lansia->saya_bermasalah_melakukan_aktivitas = $req->saya_bermasalah_melakukan_aktivitas;
        if(!empty($req->tanggal_tidak_dapat_menjalankan_aktivitas)){        
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_dapat_menjalankan_aktivitas = Carbon::createFromFormat("d/m/Y", $req->tanggal_tidak_dapat_menjalankan_aktivitas);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_dapat_menjalankan_aktivitas = null;
        }
        $penilaian_kualitas_hidup_lansia->saya_tidak_dapat_menjalankan_aktivitas = $req->saya_tidak_dapat_menjalankan_aktivitas;
        if(!empty($req->tanggal_tidak_punya_keluhan_nyeri)){        
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_punya_keluhan_nyeri = Carbon::createFromFormat("d/m/Y", $req->tanggal_tidak_punya_keluhan_nyeri);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_punya_keluhan_nyeri = null;
        }
        $penilaian_kualitas_hidup_lansia->saya_tidak_punya_keluhan_nyeri = $req->saya_tidak_punya_keluhan_nyeri;
        if(!empty($req->tanggal_tidak_punya_keluhan_nyeri_sedang)){        
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_punya_keluhan_nyeri_sedang = Carbon::createFromFormat("d/m/Y", $req->tanggal_tidak_punya_keluhan_nyeri_sedang);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_punya_keluhan_nyeri_sedang = null;
        }
        $penilaian_kualitas_hidup_lansia->saya_tidak_punya_keluhan_nyeri_sedang = $req->saya_tidak_punya_keluhan_nyeri_sedang;
        if(!empty($req->tanggal_tidak_punya_keluhan_nyeri_berat)){        
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_punya_keluhan_nyeri_berat = Carbon::createFromFormat("d/m/Y", $req->tanggal_tidak_punya_keluhan_nyeri_berat);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_punya_keluhan_nyeri_berat = null;
        }
        $penilaian_kualitas_hidup_lansia->saya_tidak_punya_keluhan_nyeri_berat = $req->saya_tidak_punya_keluhan_nyeri_berat;
        if(!empty($req->tanggal_tidak_gelisah)){        
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_gelisah = Carbon::createFromFormat("d/m/Y", $req->tanggal_tidak_gelisah);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_gelisah = null;
        }
        $penilaian_kualitas_hidup_lansia->saya_tidak_gelisah_maupun_depresi = $req->saya_tidak_gelisah_maupun_depresi;
        if(!empty($req->tanggal_tidak_gelisah_maupun_depresi_sedang)){        
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_gelisah_maupun_depresi_sedang = Carbon::createFromFormat("d/m/Y", $req->tanggal_tidak_gelisah_maupun_depresi_sedang);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_tidak_gelisah_maupun_depresi_sedang = null;
        }
        $penilaian_kualitas_hidup_lansia->saya_mengalami_gelisah_maupun_depresi_sedang = $req->saya_mengalami_gelisah_maupun_depresi_sedang;
        if(!empty($req->tanggal_gelisah_maupun_depresi_berat)){        
            $penilaian_kualitas_hidup_lansia->tanggal_gelisah_maupun_depresi_berat = Carbon::createFromFormat("d/m/Y", $req->tanggal_gelisah_maupun_depresi_berat);
        } else {
            $penilaian_kualitas_hidup_lansia->tanggal_gelisah_maupun_depresi_berat = null;
        }
        $penilaian_kualitas_hidup_lansia->saya_mengalami_tgelisah_maupun_depresi_berat = $req->saya_mengalami_tgelisah_maupun_depresi_berat;
        $penilaian_kualitas_hidup_lansia->updated_by = Auth::user()->id;
    	$penilaian_kualitas_hidup_lansia->save();
    }
}