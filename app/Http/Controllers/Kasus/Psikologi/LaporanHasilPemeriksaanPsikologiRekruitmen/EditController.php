<?php

namespace App\Http\Controllers\Kasus\Psikologi\LaporanHasilPemeriksaanPsikologiRekruitmen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LaporanHasilPemeriksaanPsikologiRekruitmen;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$laporan_psikologi_rekruitmen = LaporanHasilPemeriksaanPsikologiRekruitmen::find($req->id);
    	
        if(!empty($req->tanggal_pemeriksaan)){        
            $laporan_psikologi_rekruitmen->tanggal_pemeriksaan = Carbon::createFromFormat("d/m/Y", $req->tanggal_pemeriksaan);
        } else {
            $laporan_psikologi_rekruitmen->tanggal_pemeriksaan = null;
        }
        
        $laporan_psikologi_rekruitmen->posisi_yang_dituju = $req->posisi_yang_dituju;
        $laporan_psikologi_rekruitmen->intelegensi = $req->intelegensi;
        $laporan_psikologi_rekruitmen->daya_tangkap = $req->daya_tangkap;
        $laporan_psikologi_rekruitmen->daya_analisa = $req->daya_analisa;
        $laporan_psikologi_rekruitmen->daya_konsentrasi = $req->daya_konsentrasi;
        $laporan_psikologi_rekruitmen->bekerja_dengan_angka = $req->bekerja_dengan_angka;
        $laporan_psikologi_rekruitmen->sistimatika_kerja = $req->sistimatika_kerja;
        $laporan_psikologi_rekruitmen->ketelitian_kerja = $req->ketelitian_kerja;
        $laporan_psikologi_rekruitmen->kecepatan_kerja = $req->kecepatan_kerja;
        $laporan_psikologi_rekruitmen->ketekunan = $req->ketekunan;
        $laporan_psikologi_rekruitmen->daya_tahan_kerja = $req->daya_tahan_kerja;
        $laporan_psikologi_rekruitmen->inisiatif = $req->inisiatif;
        $laporan_psikologi_rekruitmen->motivasi_berprestasi = $req->motivasi_berprestasi;
        $laporan_psikologi_rekruitmen->percaya_diri = $req->percaya_diri;
        $laporan_psikologi_rekruitmen->menyesuaikan_diri = $req->menyesuaikan_diri;
        $laporan_psikologi_rekruitmen->stabilitas_emosi = $req->stabilitas_emosi;
        $laporan_psikologi_rekruitmen->kerja_sama = $req->kerja_sama;
        $laporan_psikologi_rekruitmen->kesimpulan = $req->kesimpulan;
        $laporan_psikologi_rekruitmen->uraian_psikologis = $req->uraian_psikologis;
        $laporan_psikologi_rekruitmen->kelebihan = $req->kelebihan;
        $laporan_psikologi_rekruitmen->kelemahan = $req->kelemahan;
        $laporan_psikologi_rekruitmen->saran = $req->saran;

        $laporan_psikologi_rekruitmen->updated_by = Auth::user()->id;
        $laporan_psikologi_rekruitmen->updated_at = date('Y-m-d H:i:s');
    	$laporan_psikologi_rekruitmen->save();
    	return $laporan_psikologi_rekruitmen;
    }
}