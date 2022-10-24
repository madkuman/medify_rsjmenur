<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratPersetujuanDirawat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratPersetujuanDirawat;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$surat_persetujuan_dirawat = SuratPersetujuanDirawat::find($req->id);
    	
        $surat_persetujuan_dirawat->hubungan_dengan_pasien = $req->hubungan_dengan_pasien;
        $surat_persetujuan_dirawat->nama = $req->nama;
        $surat_persetujuan_dirawat->alamat = $req->alamat;
        $surat_persetujuan_dirawat->no_telepon = $req->no_telepon;
        $surat_persetujuan_dirawat->ruang = $req->ruang;
        $surat_persetujuan_dirawat->kelas = $req->kelas;
        $surat_persetujuan_dirawat->updated_by = Auth::user()->id;
    	$surat_persetujuan_dirawat->save();
    }
}