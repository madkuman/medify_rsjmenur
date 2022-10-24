<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratPersetujuanDirawat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratPersetujuanDirawat;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $surat_persetujuan_dirawat = SuratPersetujuanDirawat::find($id);
        if($surat_persetujuan_dirawat)
        {
            $surat_persetujuan_dirawat->deleted_by = Auth::user()->id;
            $surat_persetujuan_dirawat->save();
            $surat_persetujuan_dirawat->delete();
        }
    }
}