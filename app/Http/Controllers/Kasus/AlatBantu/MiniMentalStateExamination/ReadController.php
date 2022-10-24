<?php

namespace App\Http\Controllers\Kasus\AlatBantu\MiniMentalStateExamination;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\MiniMentalStateExamination;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return MiniMentalStateExamination::all();
    }
}