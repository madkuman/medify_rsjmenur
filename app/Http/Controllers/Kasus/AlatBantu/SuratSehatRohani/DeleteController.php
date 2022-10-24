<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratSehatRohani;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratSehatRohani;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $surat_sehat_rohani = SuratSehatRohani::find($id);
        if($surat_sehat_rohani)
        {
            $surat_sehat_rohani->deleted_by = Auth::user()->id;
            $surat_sehat_rohani->save();
            if(!is_null($surat_sehat_rohani->penunjang_id))
            app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($surat_sehat_rohani->penunjang_id);
            $surat_sehat_rohani->delete();
        }
    }
}