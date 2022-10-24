<?php

namespace App\Http\Controllers\Pasien\PasienWali;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PasienWali;

class ReadController extends Controller
{
    	public function get($id)
    	{
    		$wali = PasienWali::find($id);
    		return $wali;
    	}
}
