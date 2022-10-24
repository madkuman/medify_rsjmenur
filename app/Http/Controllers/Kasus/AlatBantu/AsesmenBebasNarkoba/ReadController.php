<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenBebasNarkoba;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenBebasNarkoba;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return AsesmenBebasNarkoba::all();
    }
}