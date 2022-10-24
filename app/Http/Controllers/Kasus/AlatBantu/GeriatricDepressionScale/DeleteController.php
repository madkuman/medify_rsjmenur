<?php

namespace App\Http\Controllers\Kasus\AlatBantu\GeriatricDepressionScale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\GeriatricDepressionScale;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $geriatric_depression_scale = GeriatricDepressionScale::find($id);
        if($geriatric_depression_scale)
        {
            $geriatric_depression_scale->deleted_by = Auth::user()->id;
            $geriatric_depression_scale->save();
            $geriatric_depression_scale->delete();
        }
    }
}