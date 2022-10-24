<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenBebasNarkoba;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenBebasNarkoba;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $asesmen_bebas_narkoba = AsesmenBebasNarkoba::find($id);
        if($asesmen_bebas_narkoba)
        {
            $asesmen_bebas_narkoba->deleted_by = Auth::user()->id;
            $asesmen_bebas_narkoba->save();
            $asesmen_bebas_narkoba->delete();
        }
    }
}