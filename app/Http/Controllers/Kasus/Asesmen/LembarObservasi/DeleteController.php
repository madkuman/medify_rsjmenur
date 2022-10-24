<?php

namespace App\Http\Controllers\Kasus\Asesmen\LembarObservasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LembarObservasi;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $lembar_observasi = LembarObservasi::find($id);
        if($lembar_observasi)
        {
            $lembar_observasi->deleted_by = Auth::user()->id;
            $lembar_observasi->save();
            $lembar_observasi->delete();
        }
    }
}