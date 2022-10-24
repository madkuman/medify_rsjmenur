<?php

namespace App\Http\Controllers\Farmasi\TipeObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\TipeObat;
use DB;
use Response;

class ReadController extends Controller
{
    public function getAll()
    {
    	$tipe = TipeObat::get();

        return $tipe;
    }
}
