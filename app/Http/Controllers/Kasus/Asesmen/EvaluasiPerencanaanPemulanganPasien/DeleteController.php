<?php

namespace App\Http\Controllers\Kasus\Asesmen\EvaluasiPerencanaanPemulanganPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\EvaluasiPerencanaanPemulanganPasien;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $evaluasi_perencanaan_pemulangan_pasien = EvaluasiPerencanaanPemulanganPasien::find($id);
        if($evaluasi_perencanaan_pemulangan_pasien)
        {
            $evaluasi_perencanaan_pemulangan_pasien->deleted_by = Auth::user()->id;
            $evaluasi_perencanaan_pemulangan_pasien->save();
            $evaluasi_perencanaan_pemulangan_pasien->delete();
        }
    }
}