<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenPerencanaanPemulanganPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenPerencanaanPemulanganPasien;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $asesmen_perencanaan_pemulangan_pasien = AsesmenPerencanaanPemulanganPasien::find($id);
        if($asesmen_perencanaan_pemulangan_pasien)
        {
            $asesmen_perencanaan_pemulangan_pasien->deleted_by = Auth::user()->id;
            $asesmen_perencanaan_pemulangan_pasien->save();
            $asesmen_perencanaan_pemulangan_pasien->delete();
        }
    }
}