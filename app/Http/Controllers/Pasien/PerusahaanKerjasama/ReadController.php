<?php

namespace App\Http\Controllers\Pasien\PerusahaanKerjasama;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PerusahaanKerjasama;

class ReadController extends Controller
{
    	public function getAll(){
    		$company = PerusahaanKerjasama::all();
    		return $company;
    	}
}
