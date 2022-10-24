<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenPerencanaanPemulanganPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenPerencanaanPemulanganPasien;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$asesmen_perencanaan_pemulangan_pasien = AsesmenPerencanaanPemulanganPasien::find($req->id);
    	
		$asesmen_perencanaan_pemulangan_pasien->usia = $req->usia;
		$asesmen_perencanaan_pemulangan_pasien->dukungan_sosial = $req->dukungan_sosial;
		$asesmen_perencanaan_pemulangan_pasien->riwayat_perawatan = $req->riwayat_perawatan;
		$asesmen_perencanaan_pemulangan_pasien->masalah_medis_saat_ini = $req->masalah_medis_saat_ini;
		$asesmen_perencanaan_pemulangan_pasien->jumlah_obat_yang_dikonsumsi = $req->jumlah_obat_yang_dikonsumsi;
		$asesmen_perencanaan_pemulangan_pasien->status_kognitif = $req->status_kognitif;
		$asesmen_perencanaan_pemulangan_pasien->status_fungsional = $req->status_fungsional;
		$asesmen_perencanaan_pemulangan_pasien->masalah_perilaku = $req->masalah_perilaku;
		$asesmen_perencanaan_pemulangan_pasien->masalah_mobilitas = $req->masalah_mobilitas;
		$asesmen_perencanaan_pemulangan_pasien->masalah_sensori = $req->masalah_sensori;
		$asesmen_perencanaan_pemulangan_pasien->total_a = $req->total_a;
		$asesmen_perencanaan_pemulangan_pasien->total_b = $req->total_b;
		$asesmen_perencanaan_pemulangan_pasien->total_a_dan_total_b = $req->total_a_dan_total_b;
        $asesmen_perencanaan_pemulangan_pasien->updated_by = Auth::user()->id;
    	$asesmen_perencanaan_pemulangan_pasien->save();
    }
}