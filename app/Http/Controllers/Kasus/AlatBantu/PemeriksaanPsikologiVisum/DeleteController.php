<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PemeriksaanPsikologiVisum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PemeriksaanPsikologiVisum;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $pemeriksaan_psikologi_visum = PemeriksaanPsikologiVisum::find($id);
        if($pemeriksaan_psikologi_visum)
        {
            $pemeriksaan_psikologi_visum->deleted_by = Auth::user()->id;
            $pemeriksaan_psikologi_visum->save();
            if(!is_null($pemeriksaan_psikologi_visum->penunjang_id))
            app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($pemeriksaan_psikologi_visum->penunjang_id);
            $pemeriksaan_psikologi_visum->delete();
        }
    }
}