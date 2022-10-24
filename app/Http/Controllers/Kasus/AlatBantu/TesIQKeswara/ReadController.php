<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TesIQKeswara;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\TesIqKeswara;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return TesIqKeswara::all();
    }
}