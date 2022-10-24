<?php

namespace App\Http\Controllers\Kasus\Asesmen\DischargePlanningLanjutan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\DischargePlanningLanjutan;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return DischargePlanningLanjutan::all();
    }
}