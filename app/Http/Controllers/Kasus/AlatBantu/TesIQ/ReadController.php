<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TesIQ;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\TesIq;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return TesIq::all();
    }
}