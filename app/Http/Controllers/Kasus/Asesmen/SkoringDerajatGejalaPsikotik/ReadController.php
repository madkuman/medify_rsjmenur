<?php

namespace App\Http\Controllers\Kasus\Asesmen\SkoringDerajatGejalaPsikotik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SkoringDerajatGejalaPsikotik;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return SkoringDerajatGejalaPsikotik::all();
    }
}