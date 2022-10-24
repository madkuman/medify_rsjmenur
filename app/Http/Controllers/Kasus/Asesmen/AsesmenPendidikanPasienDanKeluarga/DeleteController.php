<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenPendidikanPasienDanKeluarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenPendidikanPasienDanKeluarga;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $asesmen_pendidikan_pasien_dan_keluarga = AsesmenPendidikanPasienDanKeluarga::find($id);
        if($asesmen_pendidikan_pasien_dan_keluarga)
        {
            $asesmen_pendidikan_pasien_dan_keluarga->deleted_by = Auth::user()->id;
            $asesmen_pendidikan_pasien_dan_keluarga->save();
            $asesmen_pendidikan_pasien_dan_keluarga->delete();
        }
    }
}