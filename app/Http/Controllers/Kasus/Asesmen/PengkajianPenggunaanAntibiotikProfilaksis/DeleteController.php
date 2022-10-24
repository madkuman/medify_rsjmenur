<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianPenggunaanAntibiotikProfilaksis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengkajianPenggunaanAntibiotikProfilaksis;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $pengkajian_penggunaan_antibiotik_profilaksis = PengkajianPenggunaanAntibiotikProfilaksis::find($id);
        if($pengkajian_penggunaan_antibiotik_profilaksis)
        {
            $pengkajian_penggunaan_antibiotik_profilaksis->deleted_by = Auth::user()->id;
            $pengkajian_penggunaan_antibiotik_profilaksis->save();
            $pengkajian_penggunaan_antibiotik_profilaksis->delete();
        }
    }
}