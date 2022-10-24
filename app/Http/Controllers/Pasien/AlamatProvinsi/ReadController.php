<?php

namespace App\Http\Controllers\Pasien\AlamatProvinsi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\AlamatProvinsi;

class ReadController extends Controller
{
	public function get()
	{
		$prov = AlamatProvinsi::all();
		return json_encode($prov);
	}

	public function getProvinsiByNama($nama)
	{
		$provinsi = AlamatProvinsi::where('nama', 'like', '%'.$nama.'%')
					->first();

		return $provinsi;
	}
}
