<?php

namespace App\Http\Controllers\BPJS\Rujukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RujukLuar;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create(Request $request, $no_rujukan)
    {
    	$rujuk_luar = new RujukLuar;

    	$rujuk_luar->no_rujukan = $no_rujukan;
    	$rujuk_luar->tanggal_rujuk = Carbon::createFromFormat('d-m-Y', $request->tanggal_rujuk, 'Asia/Jakarta');
    	$rujuk_luar->rencana_kunjungan = Carbon::createFromFormat('d-m-Y', $request->rencana_kunjungan, 'Asia/Jakarta');
    	$rujuk_luar->catatan = $request->catatan;
    	$rujuk_luar->jenis_rujuk = $request->jenis_rujuk;
    	$rujuk_luar->tipe_rujuk = $request->tipe_rujuk;
    	$rujuk_luar->diagnosa = $request->diagnosis;
    	$rujuk_luar->ppk_faskes = json_decode($request->faskes)->kode;
    	$rujuk_luar->faskes = json_decode($request->faskes)->nama;
    	$rujuk_luar->poli_rujuk = json_decode($request->poli)->kode;
    	$rujuk_luar->nama_poli_rujukan = json_decode($request->poli)->nama;
    	$rujuk_luar->status = json_decode($request->kasus)->krs_status;
    	$rujuk_luar->alasan = json_decode($request->kasus)->krs_alasan;
    	$rujuk_luar->nomor_kasus = json_decode($request->kasus)->nomor_kasus;
    	$rujuk_luar->no_sep = $request->sep;
    	$rujuk_luar->save();

    	return $rujuk_luar;
    }
}
