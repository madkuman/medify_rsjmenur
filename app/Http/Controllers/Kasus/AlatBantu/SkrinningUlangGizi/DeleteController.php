<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SkrinningUlangGizi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SkrinningUlangGizi;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $skrinning_ulang_gizi = SkrinningUlangGizi::find($id);
        if($skrinning_ulang_gizi)
        {
            $skrinning_ulang_gizi->deleted_by = Auth::user()->id;
            $skrinning_ulang_gizi->save();
            $skrinning_ulang_gizi->delete();
        }
    }
}