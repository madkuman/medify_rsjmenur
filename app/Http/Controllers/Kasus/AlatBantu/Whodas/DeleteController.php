<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Whodas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Whodas;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $whodas = Whodas::find($id);
        if($whodas)
        {
            $whodas->deleted_by = Auth::user()->id;
            $whodas->save();
            $whodas->delete();
        }
    }
}