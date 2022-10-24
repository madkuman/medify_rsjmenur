<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TesIQKeswara;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\TesIqKeswara;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $tes_iq_keswara = TesIqKeswara::find($id);
        if($tes_iq_keswara)
        {
            $tes_iq_keswara->deleted_by = Auth::user()->id;
            $tes_iq_keswara->save();
            if(!is_null($tes_iq_keswara->penunjang_id))
                app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($tes_iq_keswara->penunjang_id);
            $tes_iq_keswara->delete();
        }
    }
}