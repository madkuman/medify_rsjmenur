<?php

namespace App\Http\Controllers\Kasus\Asesmen\RingkasanPasienMasukDanKeluar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RingkasanPasienMasukDanKeluar;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$ringkasan_pasien_masuk_dan_keluar = new RingkasanPasienMasukDanKeluar;
    	
        $ringkasan_pasien_masuk_dan_keluar->dirawat_yang_ke = $req->dirawat_yang_ke;
        $ringkasan_pasien_masuk_dan_keluar->ruang = $req->ruang;
        $ringkasan_pasien_masuk_dan_keluar->pindah_ruang_ke = $req->pindah_ruang_ke;
        $ringkasan_pasien_masuk_dan_keluar->kelas = $req->kelas;
        $ringkasan_pasien_masuk_dan_keluar->pindah_kelas_ke = $req->pindah_kelas_ke;
        $ringkasan_pasien_masuk_dan_keluar->pengirim_rujukan = $req->pengirim_rujukan;
        $ringkasan_pasien_masuk_dan_keluar->nama_pengirim_rujukan = $req->nama_pengirim_rujukan;
        $ringkasan_pasien_masuk_dan_keluar->kasus_visum = $req->kasus_visum;
        $ringkasan_pasien_masuk_dan_keluar->dpjp = $req->dpjp;
        $ringkasan_pasien_masuk_dan_keluar->case_manager = $req->case_manager;
        $ringkasan_pasien_masuk_dan_keluar->lama_dirawat = $req->lama_dirawat;
        $ringkasan_pasien_masuk_dan_keluar->diagnosa_masuk = $req->diagnosa_masuk;
        $ringkasan_pasien_masuk_dan_keluar->diagnosa_masuk_tambahan = $req->diagnosa_masuk_tambahan;
        $ringkasan_pasien_masuk_dan_keluar->diagnosa_keluar = $req->diagnosa_keluar;
        $ringkasan_pasien_masuk_dan_keluar->diagnosa_keluar_tambahan = $req->diagnosa_keluar_tambahan;
        $ringkasan_pasien_masuk_dan_keluar->tindakan_yang_dilakukan = $req->tindakan_yang_dilakukan;
        $ringkasan_pasien_masuk_dan_keluar->keadaan_keluar = $req->keadaan_keluar;
        $ringkasan_pasien_masuk_dan_keluar->rujuk_ke = $req->rujuk_ke;
        $ringkasan_pasien_masuk_dan_keluar->cara_keluar = $req->cara_keluar;
        $ringkasan_pasien_masuk_dan_keluar->alergi_tidak_ada_alergi = $req->alergi_tidak_ada_alergi;
        $ringkasan_pasien_masuk_dan_keluar->alergi_obat_obatan = $req->alergi_obat_obatan;
        $ringkasan_pasien_masuk_dan_keluar->alergi_makanan = $req->alergi_makanan;
        $ringkasan_pasien_masuk_dan_keluar->alergi_lainnya = $req->alergi_lainnya;
        $ringkasan_pasien_masuk_dan_keluar->alergi_lainnya = $req->alergi_lainnya;
        $ringkasan_pasien_masuk_dan_keluar->keterangan_alergi = $req->keterangan_alergi;
    	$ringkasan_pasien_masuk_dan_keluar->created_by = Auth::user()->id;
    	$ringkasan_pasien_masuk_dan_keluar->kasus_id = $kasus_id;
    	$ringkasan_pasien_masuk_dan_keluar->save();
    }
}