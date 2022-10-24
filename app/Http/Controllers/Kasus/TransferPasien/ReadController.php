<?php

namespace App\Http\Controllers\Kasus\TransferPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\TransferPasien;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return TransferPasien::all();
    }
}