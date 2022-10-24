<?php

namespace App\Http\Controllers\Kasus\Asesmen\RingkasanPasienPulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RingkasanPasienPulang;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $ringkasan_pasien_pulang = RingkasanPasienPulang::find($id);
        if($ringkasan_pasien_pulang)
        {
            $ringkasan_pasien_pulang->deleted_by = Auth::user()->id;
            $ringkasan_pasien_pulang->save();
            $ringkasan_pasien_pulang->delete();
        }
    }
}