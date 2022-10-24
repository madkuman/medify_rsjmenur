<?php

namespace App\Http\Controllers\Kasus\AlatBantu\GeriatricDepressionScale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\GeriatricDepressionScale;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return GeriatricDepressionScale::all();
    }
}