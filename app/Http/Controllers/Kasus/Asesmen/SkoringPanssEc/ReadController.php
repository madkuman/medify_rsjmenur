<?php

namespace App\Http\Controllers\Kasus\Asesmen\SkoringPanssEc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SkoringPanssEc;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return SkoringPanssEc::all();
    }
}