<?php

namespace App\Http\Controllers\RawatJalan\PoliklinikBpjs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\PoliklinikBpjs;

class ReadController extends Controller
{
	public function all()
	{
		$poliklinik = PoliklinikBpjs::all();
		return $poliklinik;
	}
}
?>