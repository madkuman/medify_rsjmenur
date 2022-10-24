<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TestingFormAsesmen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\TestingFormAsesmen;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $testing_form_asesmen = TestingFormAsesmen::find($id);
        if($testing_form_asesmen)
        {
            $testing_form_asesmen->deleted_by = Auth::user()->id;
            $testing_form_asesmen->save();
            $testing_form_asesmen->delete();
        }
    }
}