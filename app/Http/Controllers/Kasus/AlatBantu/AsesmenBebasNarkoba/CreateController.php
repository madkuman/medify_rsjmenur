<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenBebasNarkoba;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenBebasNarkoba;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
        $content = [];
    	$asesmen_bebas_narkoba = new AsesmenBebasNarkoba;
    	
        $asesmen_bebas_narkoba->riwayat_pemakaian_zat = $req->riwayat_pemakaian_zat;
        
        foreach ($req->jenis_zat_yang_dipakai as $key => $value) {
            $content[] = [
                'jenis_zat_yang_dipakai' => $req->jenis_zat_yang_dipakai[$key],
                'tanggal_sejak' => !is_null($req->tanggal_sejak[$key]) ? Carbon::createFromFormat("d/m/Y", $req->tanggal_sejak[$key]) : null,
                'tanggal_sampai_dengan' => !is_null($req->tanggal_sampai_dengan[$key]) ? Carbon::createFromFormat("d/m/Y", $req->tanggal_sampai_dengan[$key]) : null,
            ];
        }
        $asesmen_bebas_narkoba->jenis_zat_yang_dipakai = json_encode($content);
        
        $asesmen_bebas_narkoba->etiologi_penggunaan_zat_diajak_teman = $req->etiologi_penggunaan_zat_diajak_teman;
        $asesmen_bebas_narkoba->etiologi_penggunaan_zat_dipaksa_teman = $req->etiologi_penggunaan_zat_dipaksa_teman;
        $asesmen_bebas_narkoba->etiologi_penggunaan_zat_coba_coba_keinginan_sendiri = $req->etiologi_penggunaan_zat_coba_coba_keinginan_sendiri;
        $asesmen_bebas_narkoba->etiologi_penggunaan_zat_pelarian_dari_masalah = $req->etiologi_penggunaan_zat_pelarian_dari_masalah;
        $asesmen_bebas_narkoba->etiologi_penggunaan_zat_pelarian_dari_masalah = $req->etiologi_penggunaan_zat_pelarian_dari_masalah;
        $asesmen_bebas_narkoba->komplikasi_medik_jiwa = $req->komplikasi_medik_jiwa;
        $asesmen_bebas_narkoba->perilaku_kriminal_didalam_rumah = $req->perilaku_kriminal_didalam_rumah;
        $asesmen_bebas_narkoba->perilaku_kriminal_diluar_rumah = $req->perilaku_kriminal_diluar_rumah;
        $asesmen_bebas_narkoba->problem_masyarakat = $req->problem_masyarakat;
        $asesmen_bebas_narkoba->riwayat_perawatan_dirumah_sakit = $req->riwayat_perawatan_dirumah_sakit;
        $asesmen_bebas_narkoba->riwayat_rehabilitasi_napza = $req->riwayat_rehabilitasi_napza;
        if(!empty($req->tanggal_pengkajian)){        
            $asesmen_bebas_narkoba->tanggal_pengkajian = Carbon::createFromFormat("d/m/Y", $req->tanggal_pengkajian);
        } else {
            $asesmen_bebas_narkoba->tanggal_pengkajian = null;
        }
        $asesmen_bebas_narkoba->jam_pengkajian = $req->jam_pengkajian;
        if(!empty($req->tanggal_selesai_pengkajian)){        
            $asesmen_bebas_narkoba->tanggal_selesai_pengkajian = Carbon::createFromFormat("d/m/Y", $req->tanggal_selesai_pengkajian);
        } else {
            $asesmen_bebas_narkoba->tanggal_selesai_pengkajian = null;
        }
        $asesmen_bebas_narkoba->jam_selesai_pengkajian = $req->jam_selesai_pengkajian;
    	$asesmen_bebas_narkoba->created_by = Auth::user()->id;
    	$asesmen_bebas_narkoba->kasus_id = $kasus_id;
    	$asesmen_bebas_narkoba->save();
    }
}