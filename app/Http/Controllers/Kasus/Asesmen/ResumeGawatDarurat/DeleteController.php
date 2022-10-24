<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResumeGawatDarurat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\ResumeGawatDarurat;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $resume_gawat_darurat = ResumeGawatDarurat::find($id);
        if($resume_gawat_darurat)
        {
            $resume_gawat_darurat->deleted_by = Auth::user()->id;
            $resume_gawat_darurat->save();
            $resume_gawat_darurat->delete();
        }
    }
}