<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TesIQ;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\TesIq;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $tes_iq = TesIq::find($id);
        if($tes_iq)
        {
            $tes_iq->deleted_by = Auth::user()->id;
            $tes_iq->save();
            if(!is_null($tes_iq->penunjang_id))
                app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($tes_iq->penunjang_id);
            $tes_iq->delete();
        }
    }
}