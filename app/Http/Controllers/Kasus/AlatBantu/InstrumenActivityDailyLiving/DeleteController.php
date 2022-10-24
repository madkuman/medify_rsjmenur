<?php

namespace App\Http\Controllers\Kasus\AlatBantu\InstrumenActivityDailyLiving;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\InstrumenActivityDailyLiving;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $instrumen_activity_daily_living = InstrumenActivityDailyLiving::find($id);
        if($instrumen_activity_daily_living)
        {
            $instrumen_activity_daily_living->deleted_by = Auth::user()->id;
            $instrumen_activity_daily_living->save();
            $instrumen_activity_daily_living->delete();
        }
    }
}