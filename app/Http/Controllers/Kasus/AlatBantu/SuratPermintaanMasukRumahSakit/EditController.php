<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratPermintaanMasukRumahSakit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratPermintaanMasukRumahSakit;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$surat_permintaan_masuk_rumah_sakit = SuratPermintaanMasukRumahSakit::find($req->id);
    	
        $surat_permintaan_masuk_rumah_sakit->ruang = $req->ruang;
        $surat_permintaan_masuk_rumah_sakit->kelas = $req->kelas;
        $surat_permintaan_masuk_rumah_sakit->terapi_yang_diberikan = $req->terapi_yang_diberikan;
        $surat_permintaan_masuk_rumah_sakit->updated_by = Auth::user()->id;
    	$surat_permintaan_masuk_rumah_sakit->save();
    }
}