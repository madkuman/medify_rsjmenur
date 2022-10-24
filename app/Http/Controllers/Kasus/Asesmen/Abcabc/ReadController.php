<?php

namespace App\Http\Controllers\Kasus\Asesmen\Abcabc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Abcabc;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return Abcabc::all();
    }
}