<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SkrinningUlangGizi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SkrinningUlangGizi;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return SkrinningUlangGizi::all();
    }
}