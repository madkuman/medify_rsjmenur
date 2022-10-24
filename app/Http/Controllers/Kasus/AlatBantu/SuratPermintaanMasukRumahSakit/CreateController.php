<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratPermintaanMasukRumahSakit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratPermintaanMasukRumahSakit;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$surat_permintaan_masuk_rumah_sakit = new SuratPermintaanMasukRumahSakit;
    	
        $surat_permintaan_masuk_rumah_sakit->ruang = $req->ruang;
        $surat_permintaan_masuk_rumah_sakit->kelas = $req->kelas;
        $surat_permintaan_masuk_rumah_sakit->terapi_yang_diberikan = $req->terapi_yang_diberikan;
    	$surat_permintaan_masuk_rumah_sakit->created_by = Auth::user()->id;
    	$surat_permintaan_masuk_rumah_sakit->kasus_id = $kasus_id;
    	$surat_permintaan_masuk_rumah_sakit->save();
    }
}