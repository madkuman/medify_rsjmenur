<?php

namespace App\Http\Controllers\Kasus\Asesmen\SkoringDerajatGejalaPsikotik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SkoringDerajatGejalaPsikotik;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $skoring_derajat_gejala_psikotik = SkoringDerajatGejalaPsikotik::find($id);
        if($skoring_derajat_gejala_psikotik)
        {
            $skoring_derajat_gejala_psikotik->deleted_by = Auth::user()->id;
            $skoring_derajat_gejala_psikotik->save();
            $skoring_derajat_gejala_psikotik->delete();
        }
    }
}