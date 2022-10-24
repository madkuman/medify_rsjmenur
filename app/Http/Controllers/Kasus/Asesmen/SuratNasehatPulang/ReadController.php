<?php

namespace App\Http\Controllers\Kasus\Asesmen\SuratNasehatPulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratNasehatPulang;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return SuratNasehatPulang::all();
    }
}