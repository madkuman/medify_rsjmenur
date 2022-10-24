<?php

namespace App\Http\Controllers\Kasus\Asesmen\LaporanPsikogramPemeriksaanPsikologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LaporanPsikogramPemeriksaanPsikologi;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$laporan_psikogram_pemeriksaan_psikologi = LaporanPsikogramPemeriksaanPsikologi::find($req->id);
    	
        $laporan_psikogram_pemeriksaan_psikologi->tujuan_pemeriksaan = $req->tujuan_pemeriksaan;
        if(!empty($req->tanggal_pemeriksaan)){        
            $laporan_psikogram_pemeriksaan_psikologi->tanggal_pemeriksaan = Carbon::createFromFormat("d/m/Y", $req->tanggal_pemeriksaan);
        } else {
            $laporan_psikogram_pemeriksaan_psikologi->tanggal_pemeriksaan = null;
        }
        
        $laporan_psikogram_pemeriksaan_psikologi->kecerdasan_umum = $req->kecerdasan_umum;
        $laporan_psikogram_pemeriksaan_psikologi->stabilitas_emosi = $req->stabilitas_emosi;
        $laporan_psikogram_pemeriksaan_psikologi->kemampuan_adaptasi = $req->kemampuan_adaptasi;
        $laporan_psikogram_pemeriksaan_psikologi->kepekaan_sosial = $req->kepekaan_sosial;
        $laporan_psikogram_pemeriksaan_psikologi->motivasi = $req->motivasi;
        $laporan_psikogram_pemeriksaan_psikologi->daya_tahan_terhadap_stres = $req->daya_tahan_terhadap_stres;
        $laporan_psikogram_pemeriksaan_psikologi->rujukan_dari = $req->rujukan_dari;
        $laporan_psikogram_pemeriksaan_psikologi->kemampuan_intelektual_berfungsi_pada_taraf = $req->kemampuan_intelektual_berfungsi_pada_taraf;
        $laporan_psikogram_pemeriksaan_psikologi->kesimpulan = $req->kesimpulan;
        $laporan_psikogram_pemeriksaan_psikologi->updated_by = Auth::user()->id;
        $laporan_psikogram_pemeriksaan_psikologi->save();
        return $laporan_psikogram_pemeriksaan_psikologi;
    }
}