<?php

namespace App\Http\Controllers\Kasus\Asesmen\LembarObservasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LembarObservasi;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return LembarObservasi::all();
    }
}