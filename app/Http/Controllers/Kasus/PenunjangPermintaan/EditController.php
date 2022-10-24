<?php

namespace App\Http\Controllers\Kasus\PenunjangPermintaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;

class EditController extends Controller
{
    public function cancel(Request $request)
    {
    	dd($request);
    	//modul id 6 = radiologi 10 = pk 11 = pa;
    }
}
