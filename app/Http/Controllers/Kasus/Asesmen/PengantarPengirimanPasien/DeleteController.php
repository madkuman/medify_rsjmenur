<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengantarPengirimanPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengantarPengirimanPasien;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $pengantar_pengiriman_pasien = PengantarPengirimanPasien::find($id);
        if($pengantar_pengiriman_pasien)
        {
            $pengantar_pengiriman_pasien->deleted_by = Auth::user()->id;
            $pengantar_pengiriman_pasien->save();
            $pengantar_pengiriman_pasien->delete();
        }
    }
}