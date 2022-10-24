<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Whodas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Whodas;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return Whodas::all();
    }
}