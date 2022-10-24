<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratPasienPulangRumahSakit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratPasienPulangRumahSakit;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $surat_pasien_pulang_rumah_sakit = SuratPasienPulangRumahSakit::find($id);
        if($surat_pasien_pulang_rumah_sakit)
        {
            $surat_pasien_pulang_rumah_sakit->deleted_by = Auth::user()->id;
            $surat_pasien_pulang_rumah_sakit->save();
            $surat_pasien_pulang_rumah_sakit->delete();
        }
    }
}