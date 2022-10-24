<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratPermintaanMasukRumahSakit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratPermintaanMasukRumahSakit;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $surat_permintaan_masuk_rumah_sakit = SuratPermintaanMasukRumahSakit::find($id);
        if($surat_permintaan_masuk_rumah_sakit)
        {
            $surat_permintaan_masuk_rumah_sakit->deleted_by = Auth::user()->id;
            $surat_permintaan_masuk_rumah_sakit->save();
            $surat_permintaan_masuk_rumah_sakit->delete();
        }
    }
}