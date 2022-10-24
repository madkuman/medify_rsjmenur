<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResumeNonJiwa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RencanaPemulanganPasien;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return RencanaPemulanganPasien::all();
    }
}