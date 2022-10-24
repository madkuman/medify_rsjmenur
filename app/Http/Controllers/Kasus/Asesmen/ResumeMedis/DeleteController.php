<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResumeMedis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\ResumeMedis;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $resume_medis = ResumeMedis::find($id);
        if($resume_medis)
        {
            $resume_medis->deleted_by = Auth::user()->id;
            $resume_medis->save();
            $resume_medis->delete();
        }
    }
}