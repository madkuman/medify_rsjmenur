<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratKeteranganDalamPerawatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratKeteranganDalamPerawatan;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $surat_keterangan_dalam_perawatan = SuratKeteranganDalamPerawatan::find($id);
        if($surat_keterangan_dalam_perawatan)
        {
            $surat_keterangan_dalam_perawatan->deleted_by = Auth::user()->id;
            $surat_keterangan_dalam_perawatan->save();
            $surat_keterangan_dalam_perawatan->delete();
        }
    }
}