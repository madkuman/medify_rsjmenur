<?php

namespace App\Http\Controllers\Kasus\Asesmen\LaporanPsikogramPemeriksaanPsikologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LaporanPsikogramPemeriksaanPsikologi;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $laporan_psikogram_pemeriksaan_psikologi = LaporanPsikogramPemeriksaanPsikologi::find($id);
        if($laporan_psikogram_pemeriksaan_psikologi)
        {
            $laporan_psikogram_pemeriksaan_psikologi->deleted_by = Auth::user()->id;
            $laporan_psikogram_pemeriksaan_psikologi->save();
            if(!is_null($laporan_psikogram_pemeriksaan_psikologi->penunjang_id))
                app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($laporan_psikogram_pemeriksaan_psikologi->penunjang_id);
            $laporan_psikogram_pemeriksaan_psikologi->delete();
        }
    }
}