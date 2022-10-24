<?php

namespace App\Http\Controllers\Kasus\Asesmen\SuratNasehatPulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratNasehatPulang;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $surat_nasehat_pulang = SuratNasehatPulang::find($id);
        if($surat_nasehat_pulang)
        {
            $surat_nasehat_pulang->deleted_by = Auth::user()->id;
            $surat_nasehat_pulang->save();
            $surat_nasehat_pulang->delete();
        }
    }
}