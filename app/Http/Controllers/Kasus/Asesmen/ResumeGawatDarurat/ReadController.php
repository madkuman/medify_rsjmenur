<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResumeGawatDarurat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\ResumeGawatDarurat;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return ResumeGawatDarurat::all();
    }
}