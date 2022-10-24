<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenRisikoJatuhPsikiatri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenRisikoJatuhPsikiatri;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return AsesmenRisikoJatuhPsikiatri::all();
    }
}