<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratKeteranganPemeriksaanKematian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratKeteranganPemeriksaanKematian;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $surat_keterangan_pemeriksaan_kematian = SuratKeteranganPemeriksaanKematian::find($id);
        if($surat_keterangan_pemeriksaan_kematian)
        {
            $surat_keterangan_pemeriksaan_kematian->deleted_by = Auth::user()->id;
            $surat_keterangan_pemeriksaan_kematian->save();
            $surat_keterangan_pemeriksaan_kematian->delete();
        }
    }
}