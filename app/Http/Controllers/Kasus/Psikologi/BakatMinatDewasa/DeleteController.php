<?php

namespace App\Http\Controllers\Kasus\Psikologi\BakatMinatDewasa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BakatMinatDewasa;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $bakat_minat_dewasa = BakatMinatDewasa::find($id);
        if($bakat_minat_dewasa)
        {
            $bakat_minat_dewasa->deleted_by = Auth::user()->id;
            $bakat_minat_dewasa->save();
            if(!is_null($bakat_minat_dewasa->penunjang_id))
                app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($bakat_minat_dewasa->penunjang_id);
            $bakat_minat_dewasa->delete();
        }
    }
}