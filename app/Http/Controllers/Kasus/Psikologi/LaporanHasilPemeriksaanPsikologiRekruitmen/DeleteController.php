<?php

namespace App\Http\Controllers\Kasus\Psikologi\LaporanHasilPemeriksaanPsikologiRekruitmen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LaporanHasilPemeriksaanPsikologiRekruitmen;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $laporan_psikologi_rekruitmen = LaporanHasilPemeriksaanPsikologiRekruitmen::find($id);
        if($laporan_psikologi_rekruitmen)
        {
            $laporan_psikologi_rekruitmen->deleted_by = Auth::user()->id;
            $laporan_psikologi_rekruitmen->save();
            if(!is_null($laporan_psikologi_rekruitmen->penunjang_id))
                app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($laporan_psikologi_rekruitmen->penunjang_id);
            $laporan_psikologi_rekruitmen->delete();
        }
    }
}