<?php

namespace App\Http\Controllers\Kasus\Asesmen\Abcabc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Abcabc;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $abcabc = Abcabc::find($id);
        if($abcabc)
        {
            $abcabc->deleted_by = Auth::user()->id;
            $abcabc->save();
            $abcabc->delete();
        }
    }
}