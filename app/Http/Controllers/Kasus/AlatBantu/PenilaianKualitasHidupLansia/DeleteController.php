<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PenilaianKualitasHidupLansia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PenilaianKualitasHidupLansia;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $penilaian_kualitas_hidup_lansia = PenilaianKualitasHidupLansia::find($id);
        if($penilaian_kualitas_hidup_lansia)
        {
            $penilaian_kualitas_hidup_lansia->deleted_by = Auth::user()->id;
            $penilaian_kualitas_hidup_lansia->save();
            $penilaian_kualitas_hidup_lansia->delete();
        }
    }
}