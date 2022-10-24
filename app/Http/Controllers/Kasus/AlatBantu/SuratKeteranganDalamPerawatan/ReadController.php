<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratKeteranganDalamPerawatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratKeteranganDalamPerawatan;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return SuratKeteranganDalamPerawatan::all();
    }
}