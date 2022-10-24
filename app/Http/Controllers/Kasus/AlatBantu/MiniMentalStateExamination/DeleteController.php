<?php

namespace App\Http\Controllers\Kasus\AlatBantu\MiniMentalStateExamination;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\MiniMentalStateExamination;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $mini_mental_state_examination = MiniMentalStateExamination::find($id);
        if($mini_mental_state_examination)
        {
            $mini_mental_state_examination->deleted_by = Auth::user()->id;
            $mini_mental_state_examination->save();
            $mini_mental_state_examination->delete();
        }
    }
}