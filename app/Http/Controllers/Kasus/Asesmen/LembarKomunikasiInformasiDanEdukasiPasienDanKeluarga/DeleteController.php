<?php

namespace App\Http\Controllers\Kasus\Asesmen\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga = LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga::find($id);
        if($lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga)
        {
            $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->deleted_by = Auth::user()->id;
            $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->save();
            $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->delete();
        }
    }
}