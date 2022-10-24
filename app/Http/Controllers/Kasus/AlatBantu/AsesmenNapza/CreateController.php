<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenNapza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenNapza;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$asesmen_napza = new AsesmenNapza;
    	
        $asesmen_napza->alergi = $req->alergi;
        $asesmen_napza->risiko = $req->risiko;
        if(!empty($req->tanggal_pengkajian)){        
            $asesmen_napza->tanggal_pengkajian = Carbon::createFromFormat("d/m/Y", $req->tanggal_pengkajian);
        } else {
            $asesmen_napza->tanggal_pengkajian = null;
        }
        $asesmen_napza->jam_pengkajian = $req->jam_pengkajian;
        
        foreach ($req->jenis_zat_yang_dipakai as $key => $value) {
            $content[] = [
                'jenis_zat_yang_dipakai' => $req->jenis_zat_yang_dipakai[$key],
                'tanggal_sejak' => !is_null($req->tanggal_sejak[$key]) ? Carbon::createFromFormat("d/m/Y", $req->tanggal_sejak[$key]) : null,
                'tanggal_sampai_dengan' => !is_null($req->tanggal_sampai_dengan[$key]) ? Carbon::createFromFormat("d/m/Y", $req->tanggal_sampai_dengan[$key]) : null,
            ];
        }
        $asesmen_napza->jenis_zat_yang_dipakai = json_encode($content);
        
        $asesmen_napza->alasan_penggunaan_zat_diajak_teman = $req->alasan_penggunaan_zat_diajak_teman;
        $asesmen_napza->alasan_penggunaan_zat_dipaksa_teman = $req->alasan_penggunaan_zat_dipaksa_teman;
        $asesmen_napza->alasan_penggunaan_zat_coba_coba_keinginan_sendiri = $req->alasan_penggunaan_zat_coba_coba_keinginan_sendiri;
        $asesmen_napza->alasan_penggunaan_zat_pelarian_dari_masalah = $req->alasan_penggunaan_zat_pelarian_dari_masalah;
        $asesmen_napza->alasan_penggunaan_zat_pelarian_dari_masalah = $req->alasan_penggunaan_zat_pelarian_dari_masalah;
        $asesmen_napza->komplikasi_medik_jiwa = $req->komplikasi_medik_jiwa;
        $asesmen_napza->kriminal_dirumah_tidak_ada_masalah = $req->kriminal_dirumah_tidak_ada_masalah;
        $asesmen_napza->kriminal_dirumah_mencuri = $req->kriminal_dirumah_mencuri;
        $asesmen_napza->kriminal_dirumah_mengancam = $req->kriminal_dirumah_mengancam;
        $asesmen_napza->kriminal_dirumah_menggadai = $req->kriminal_dirumah_menggadai;
        $asesmen_napza->kriminal_dirumah_mengambil_barang_dengan_paksaan = $req->kriminal_dirumah_mengambil_barang_dengan_paksaan;
        $asesmen_napza->kriminal_dirumah_menjual_barang_sendiri = $req->kriminal_dirumah_menjual_barang_sendiri;
        $asesmen_napza->kriminal_dirumah_mengambil_barang = $req->kriminal_dirumah_mengambil_barang;
        $asesmen_napza->kriminal_dirumah_merusak = $req->kriminal_dirumah_merusak;
        $asesmen_napza->kriminal_dirumah_merusak = $req->kriminal_dirumah_merusak;
        $asesmen_napza->kriminal_diluar_rumah_tidak_ada_masalah = $req->kriminal_diluar_rumah_tidak_ada_masalah;
        $asesmen_napza->kriminal_diluar_rumah_mencuri = $req->kriminal_diluar_rumah_mencuri;
        $asesmen_napza->kriminal_diluar_rumah_merampas_barang = $req->kriminal_diluar_rumah_merampas_barang;
        $asesmen_napza->kriminal_diluar_rumah_membunuh = $req->kriminal_diluar_rumah_membunuh;
        $asesmen_napza->kriminal_diluar_rumah_merampok = $req->kriminal_diluar_rumah_merampok;
        $asesmen_napza->kriminal_diluar_rumah_mengancam = $req->kriminal_diluar_rumah_mengancam;
        $asesmen_napza->kriminal_diluar_rumah_merusak = $req->kriminal_diluar_rumah_merusak;
        $asesmen_napza->kriminal_diluar_rumah_merusak = $req->kriminal_diluar_rumah_merusak;
        $asesmen_napza->catatan_polisi_tidak_ada = $req->catatan_polisi_tidak_ada;
        $asesmen_napza->catatan_polisi_ditahan_diproses_pengadilan = $req->catatan_polisi_ditahan_diproses_pengadilan;
        $asesmen_napza->catatan_polisi_ditahan_kemudian_langsung_dipulangkan = $req->catatan_polisi_ditahan_kemudian_langsung_dipulangkan;
        $asesmen_napza->catatan_polisi_ditahan_kemudian_langsung_dipulangkan = $req->catatan_polisi_ditahan_kemudian_langsung_dipulangkan;
        $asesmen_napza->lain_lain_catatan_polisi = $req->lain_lain_catatan_polisi;
        $asesmen_napza->problem_sekolah_tidak_ada_masalah = $req->problem_sekolah_tidak_ada_masalah;
        $asesmen_napza->problem_sekolah_tidak_naik_kelas = $req->problem_sekolah_tidak_naik_kelas;
        $asesmen_napza->problem_sekolah_berhenti_sekolah = $req->problem_sekolah_berhenti_sekolah;
        $asesmen_napza->problem_sekolah_susah_konsentrasi_belajar = $req->problem_sekolah_susah_konsentrasi_belajar;
        $asesmen_napza->problem_sekolah_dikeluarkan_dari_sekolah = $req->problem_sekolah_dikeluarkan_dari_sekolah;
        $asesmen_napza->problem_sekolah_tidak_disiplin = $req->problem_sekolah_tidak_disiplin;
        $asesmen_napza->problem_sekolah_tidak_disiplin = $req->problem_sekolah_tidak_disiplin;
    	$asesmen_napza->created_by = Auth::user()->id;
    	$asesmen_napza->kasus_id = $kasus_id;
    	$asesmen_napza->save();
    }
}