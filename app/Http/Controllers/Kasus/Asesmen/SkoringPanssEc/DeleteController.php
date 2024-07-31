<?php

namespace App\Http\Controllers\Kasus\Asesmen\SkoringPanssEc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SkoringPanssEc;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $skoring_panss_ec = SkoringPanssEc::find($id);
        if($skoring_panss_ec)
        {
            $skoring_panss_ec->deleted_by = Auth::user()->id;
            $skoring_panss_ec->save();
            $skoring_panss_ec->delete();
        }
    }
}