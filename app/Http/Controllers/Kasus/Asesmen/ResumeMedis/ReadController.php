<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResumeMedis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\ResumeMedis;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return ResumeMedis::all();
    }
}