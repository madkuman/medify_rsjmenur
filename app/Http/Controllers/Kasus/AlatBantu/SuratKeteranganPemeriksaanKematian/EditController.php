<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratKeteranganPemeriksaanKematian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratKeteranganPemeriksaanKematian;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$surat_keterangan_pemeriksaan_kematian = SuratKeteranganPemeriksaanKematian::find($req->id);
    	
        $surat_keterangan_pemeriksaan_kematian->hari = $req->hari;
        if(!empty($req->tanggal)){        
            $surat_keterangan_pemeriksaan_kematian->tanggal = Carbon::createFromFormat("d/m/Y", $req->tanggal);
        } else {
            $surat_keterangan_pemeriksaan_kematian->tanggal = null;
        }
        $surat_keterangan_pemeriksaan_kematian->pukul = $req->pukul;
        $surat_keterangan_pemeriksaan_kematian->dokter_yang_memeriksa = $req->dokter_yang_memeriksa;
        $surat_keterangan_pemeriksaan_kematian->persangkaan_kematian = $req->persangkaan_kematian;
        $surat_keterangan_pemeriksaan_kematian->updated_by = Auth::user()->id;
    	$surat_keterangan_pemeriksaan_kematian->save();
    }
}