<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResumeNonJiwa;

use App\Models\Kasus\ResumeNonJiwa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $resume_non_jiwa = ResumeNonJiwa::find($id);
        if($resume_non_jiwa)
        {
            $resume_non_jiwa->deleted_by = Auth::user()->id;
            $resume_non_jiwa->save();
            $resume_non_jiwa->delete();
        }
    }
}