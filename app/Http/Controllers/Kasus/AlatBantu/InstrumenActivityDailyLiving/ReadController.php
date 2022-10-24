<?php

namespace App\Http\Controllers\Kasus\AlatBantu\InstrumenActivityDailyLiving;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\InstrumenActivityDailyLiving;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return InstrumenActivityDailyLiving::all();
    }
}