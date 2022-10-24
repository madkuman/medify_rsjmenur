<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenNapza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenNapza;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $asesmen_napza = AsesmenNapza::find($id);
        if($asesmen_napza)
        {
            $asesmen_napza->deleted_by = Auth::user()->id;
            $asesmen_napza->save();
            $asesmen_napza->delete();
        }
    }
}