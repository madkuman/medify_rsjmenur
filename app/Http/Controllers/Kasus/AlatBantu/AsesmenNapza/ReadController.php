<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenNapza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenNapza;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return AsesmenNapza::all();
    }
}