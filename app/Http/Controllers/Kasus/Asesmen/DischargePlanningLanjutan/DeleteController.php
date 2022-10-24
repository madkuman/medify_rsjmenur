<?php

namespace App\Http\Controllers\Kasus\Asesmen\DischargePlanningLanjutan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\DischargePlanningLanjutan;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $discharge_planning_lanjutan = DischargePlanningLanjutan::find($id);
        if($discharge_planning_lanjutan)
            $discharge_planning_lanjutan->delete();
    }
}