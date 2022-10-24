<?php

namespace App\Http\Controllers\Kasus\Psikologi\BakatMinatAnak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BakatMinatAnak;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $bakat_minat_anak = BakatMinatAnak::find($id);
        if($bakat_minat_anak)
        {
            $bakat_minat_anak->deleted_by = Auth::user()->id;
            $bakat_minat_anak->save();
            if(!is_null($bakat_minat_anak->penunjang_id))
                app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($bakat_minat_anak->penunjang_id);
            $bakat_minat_anak->delete();
        }
    }
}