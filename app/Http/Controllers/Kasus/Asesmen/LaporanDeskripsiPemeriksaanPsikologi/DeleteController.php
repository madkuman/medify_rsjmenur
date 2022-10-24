<?php

namespace App\Http\Controllers\Kasus\Asesmen\LaporanDeskripsiPemeriksaanPsikologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LaporanDeskripsiPemeriksaanPsikologi;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $laporan_deskripsi_pemeriksaan_psikologi = LaporanDeskripsiPemeriksaanPsikologi::find($id);
        if($laporan_deskripsi_pemeriksaan_psikologi)
        {
            $laporan_deskripsi_pemeriksaan_psikologi->deleted_by = Auth::user()->id;
            $laporan_deskripsi_pemeriksaan_psikologi->save();
            if(!is_null($laporan_deskripsi_pemeriksaan_psikologi->penunjang_id))
                app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($laporan_deskripsi_pemeriksaan_psikologi->penunjang_id);
            $laporan_deskripsi_pemeriksaan_psikologi->delete();
        }
    }
}