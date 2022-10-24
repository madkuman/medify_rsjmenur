<?php

namespace App\Http\Controllers\Kasus\AlatBantu\GeriatricDepressionScale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\GeriatricDepressionScale;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$geriatric_depression_scale = new GeriatricDepressionScale;
    	
        $geriatric_depression_scale->apakah_anda_telah_puas_dengan_kehidupan = $req->apakah_anda_telah_puas_dengan_kehidupan;
        $geriatric_depression_scale->apakah_anda_telah_meninggalkan_banyak_kegiatan = $req->apakah_anda_telah_meninggalkan_banyak_kegiatan;
        $geriatric_depression_scale->apakah_anda_merasa_kehidupan_kosong = $req->apakah_anda_merasa_kehidupan_kosong;
        $geriatric_depression_scale->apakah_anda_sering_bosan = $req->apakah_anda_sering_bosan;
        $geriatric_depression_scale->apakah_anda_punya_semangan_baik = $req->apakah_anda_punya_semangan_baik;
        $geriatric_depression_scale->apakah_anda_takut_akan_sesuatu_buruk = $req->apakah_anda_takut_akan_sesuatu_buruk;
        $geriatric_depression_scale->apakah_anda_merasa_bahagia = $req->apakah_anda_merasa_bahagia;
        $geriatric_depression_scale->apakah_anda_merasa_tidak_berdaya = $req->apakah_anda_merasa_tidak_berdaya;
        $geriatric_depression_scale->apakah_anda_senang_tinggal_dirumah = $req->apakah_anda_senang_tinggal_dirumah;
        $geriatric_depression_scale->apakah_anda_merasa_punya_banyak_masalah = $req->apakah_anda_merasa_punya_banyak_masalah;
        $geriatric_depression_scale->apakah_anda_berpikir_hidup_menyenangkan = $req->apakah_anda_berpikir_hidup_menyenangkan;
        $geriatric_depression_scale->apakah_anda_merasa_tidak_berharga = $req->apakah_anda_merasa_tidak_berharga;
        $geriatric_depression_scale->apakah_anda_merasa_penuh_semangat = $req->apakah_anda_merasa_penuh_semangat;
        $geriatric_depression_scale->apakah_anda_merasa_tidak_ada_harapan = $req->apakah_anda_merasa_tidak_ada_harapan;
        $geriatric_depression_scale->apakah_anda_pikir_orang_lain_lebih_baik = $req->apakah_anda_pikir_orang_lain_lebih_baik;
    	$geriatric_depression_scale->created_by = Auth::user()->id;
    	$geriatric_depression_scale->kasus_id = $kasus_id;
    	$geriatric_depression_scale->save();
    }
}