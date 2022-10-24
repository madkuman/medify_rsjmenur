<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenNapzaRawatJalanNonIPWL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenNapzaRawatJalanNonIPWL;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return AsesmenNapzaRawatJalanNonIPWL::all();
    }
}