<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenNapzaRawatJalanNonIPWL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenNapzaRawatJalanNonIPWL;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$asesmen_napza_rawat_jalan_non_ipwl = AsesmenNapzaRawatJalanNonIPWL::find($req->id);
    	
        $asesmen_napza_rawat_jalan_non_ipwl->alergi = $req->alergi;
        $asesmen_napza_rawat_jalan_non_ipwl->risiko = $req->risiko;
        
        if(!empty($req->tanggal_pengkajian)){        
            $asesmen_napza_rawat_jalan_non_ipwl->tanggal_pengkajian = Carbon::createFromFormat("d/m/Y", $req->tanggal_pengkajian);
        } else {
            $asesmen_napza_rawat_jalan_non_ipwl->tanggal_pengkajian = null;
        }

        $asesmen_napza_rawat_jalan_non_ipwl->jam_pengkajian = $req->jam_pengkajian;
        $asesmen_napza_rawat_jalan_non_ipwl->riwayat_pemakaian_napza = $req->riwayat_pemakaian_napza;

        foreach ($req->jenis_napza_yang_dipakai as $key => $value) {
            $content[] = [
                'jenis_napza_yang_dipakai' => $req->jenis_napza_yang_dipakai[$key],
                'tanggal_sejak' => !is_null($req->tanggal_sejak[$key]) ? Carbon::createFromFormat("d/m/Y", $req->tanggal_sejak[$key]) : null,
                'tanggal_sampai_dengan' => !is_null($req->tanggal_sampai_dengan[$key]) ? Carbon::createFromFormat("d/m/Y", $req->tanggal_sampai_dengan[$key]) : null,
                'cara_pakai' => $req->cara_pakai[$key],
            ];
        }
        $asesmen_napza_rawat_jalan_non_ipwl->jenis_napza_yang_dipakai = json_encode($content);
        
        $asesmen_napza_rawat_jalan_non_ipwl->etiologi_penggunaan_zat_diajak_teman = $req->etiologi_penggunaan_zat_diajak_teman;
        $asesmen_napza_rawat_jalan_non_ipwl->etiologi_penggunaan_zat_dipaksa_teman = $req->etiologi_penggunaan_zat_dipaksa_teman;
        $asesmen_napza_rawat_jalan_non_ipwl->etiologi_penggunaan_zat_coba_coba_keinginan_sendiri = $req->etiologi_penggunaan_zat_coba_coba_keinginan_sendiri;
        $asesmen_napza_rawat_jalan_non_ipwl->etiologi_penggunaan_zat_pelarian_dari_masalah = $req->etiologi_penggunaan_zat_pelarian_dari_masalah;
        $asesmen_napza_rawat_jalan_non_ipwl->etiologi_penggunaan_zat_pelarian_dari_masalah = $req->etiologi_penggunaan_zat_pelarian_dari_masalah;
        $asesmen_napza_rawat_jalan_non_ipwl->komplikasi_medik_jiwa = $req->komplikasi_medik_jiwa;
        $asesmen_napza_rawat_jalan_non_ipwl->perilaku_kriminal_di_dalam_rumah_sendiri = $req->perilaku_kriminal_di_dalam_rumah_sendiri;
        $asesmen_napza_rawat_jalan_non_ipwl->perilaku_kriminal_di_luar_rumah = $req->perilaku_kriminal_di_luar_rumah;
        $asesmen_napza_rawat_jalan_non_ipwl->problem_masyarakat = $req->problem_masyarakat;
        
        if(!empty($req->riwayat_perawatan_di_rumah_sakit_terkait_napza)){        
            $asesmen_napza_rawat_jalan_non_ipwl->riwayat_perawatan_di_rumah_sakit_terkait_napza = Carbon::createFromFormat("d/m/Y", $req->riwayat_perawatan_di_rumah_sakit_terkait_napza);
        } else {
            $asesmen_napza_rawat_jalan_non_ipwl->riwayat_perawatan_di_rumah_sakit_terkait_napza = null;
        }
        
        if(!empty($req->riwayat_rehabilitasi_napza_sebelumnya)){        
            $asesmen_napza_rawat_jalan_non_ipwl->riwayat_rehabilitasi_napza_sebelumnya = Carbon::createFromFormat("d/m/Y", $req->riwayat_rehabilitasi_napza_sebelumnya);
        } else {
            $asesmen_napza_rawat_jalan_non_ipwl->riwayat_rehabilitasi_napza_sebelumnya = null;
        }
        $asesmen_napza_rawat_jalan_non_ipwl->tempat_rehabilitasi = $req->tempat_rehabilitasi;
        if(!empty($req->riwayat_relaps_dengan_tanpa_rehabilitasi_napza)){        
            $asesmen_napza_rawat_jalan_non_ipwl->riwayat_relaps_dengan_tanpa_rehabilitasi_napza = Carbon::createFromFormat("d/m/Y", $req->riwayat_relaps_dengan_tanpa_rehabilitasi_napza);
        } else {
            $asesmen_napza_rawat_jalan_non_ipwl->riwayat_relaps_dengan_tanpa_rehabilitasi_napza = null;
        }
        $asesmen_napza_rawat_jalan_non_ipwl->faktor_penyebab_relaps_diajak_teman = $req->faktor_penyebab_relaps_diajak_teman;
        $asesmen_napza_rawat_jalan_non_ipwl->faktor_penyebab_relaps_dipaksa_teman = $req->faktor_penyebab_relaps_dipaksa_teman;
        $asesmen_napza_rawat_jalan_non_ipwl->faktor_penyebab_relaps_tidak_memiliki_aktivitas_berarti = $req->faktor_penyebab_relaps_tidak_memiliki_aktivitas_berarti;
        $asesmen_napza_rawat_jalan_non_ipwl->faktor_penyebab_relaps_dendam_setelah_masa_pemulihan = $req->faktor_penyebab_relaps_dendam_setelah_masa_pemulihan;
        $asesmen_napza_rawat_jalan_non_ipwl->faktor_penyebab_relaps_konflik_dengan_orang_tua = $req->faktor_penyebab_relaps_konflik_dengan_orang_tua;
        $asesmen_napza_rawat_jalan_non_ipwl->faktor_penyebab_relaps_bergabung_dengan_pengguna_zat = $req->faktor_penyebab_relaps_bergabung_dengan_pengguna_zat;
        $asesmen_napza_rawat_jalan_non_ipwl->faktor_penyebab_relaps_tidak_mampu_menahan_suggest = $req->faktor_penyebab_relaps_tidak_mampu_menahan_suggest;
        $asesmen_napza_rawat_jalan_non_ipwl->faktor_penyebab_relaps_keinginan_untuk_menggunakan = $req->faktor_penyebab_relaps_keinginan_untuk_menggunakan;
        $asesmen_napza_rawat_jalan_non_ipwl->faktor_penyebab_relaps_keinginan_untuk_menggunakan = $req->faktor_penyebab_relaps_keinginan_untuk_menggunakan;
        if(!empty($req->riwayat_seks_bebas)){        
            $asesmen_napza_rawat_jalan_non_ipwl->riwayat_seks_bebas = Carbon::createFromFormat("d/m/Y", $req->riwayat_seks_bebas);
        } else {
            $asesmen_napza_rawat_jalan_non_ipwl->riwayat_seks_bebas = null;
        }
        $asesmen_napza_rawat_jalan_non_ipwl->anggota_keluarga_yang_menggunakan_napza = $req->anggota_keluarga_yang_menggunakan_napza;
        if(!empty($req->tanggal_selesai_pengkajian)){        
            $asesmen_napza_rawat_jalan_non_ipwl->tanggal_selesai_pengkajian = Carbon::createFromFormat("d/m/Y", $req->tanggal_selesai_pengkajian);
        } else {
            $asesmen_napza_rawat_jalan_non_ipwl->tanggal_selesai_pengkajian = null;
        }
        $asesmen_napza_rawat_jalan_non_ipwl->jam_selesai_pengkajian = $req->jam_selesai_pengkajian;
        $asesmen_napza_rawat_jalan_non_ipwl->updated_by = Auth::user()->id;
    	$asesmen_napza_rawat_jalan_non_ipwl->save();
    }
}