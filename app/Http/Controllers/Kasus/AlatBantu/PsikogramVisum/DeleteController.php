<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PsikogramVisum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PsikogramVisum;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $psikogram_visum = PsikogramVisum::find($id);
        if($psikogram_visum)
        {
            $psikogram_visum->deleted_by = Auth::user()->id;
            $psikogram_visum->save();
            if(!is_null($psikogram_visum->penunjang_id))
                app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($psikogram_visum->penunjang_id);
            $psikogram_visum->delete();
        }
    }
}