<?php

namespace App\Http\Controllers\Kasus\BPJS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BPJSSEP;
use App\Models\Kasus\Kasus;

class ReadController extends Controller
{
	public function get($nomor_kasus, $id)
	{
		$bpjs = BPJSSEP::find($id);
		return json_encode($bpjs);
	}

	public function getAllFrom($kasus_id)
	{
		$bpjs = Kasus::find($kasus_id)->orderBy('id', 'desc')->first()->bpjs;
		return $bpjs;
	}
}
