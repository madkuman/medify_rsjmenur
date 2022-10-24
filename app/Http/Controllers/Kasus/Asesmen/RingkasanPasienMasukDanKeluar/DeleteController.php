<?php

namespace App\Http\Controllers\Kasus\Asesmen\RingkasanPasienMasukDanKeluar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RingkasanPasienMasukDanKeluar;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $ringkasan_pasien_masuk_dan_keluar = RingkasanPasienMasukDanKeluar::find($id);
        if($ringkasan_pasien_masuk_dan_keluar)
        {
            $ringkasan_pasien_masuk_dan_keluar->deleted_by = Auth::user()->id;
            $ringkasan_pasien_masuk_dan_keluar->save();
            $ringkasan_pasien_masuk_dan_keluar->delete();
        }
    }
}