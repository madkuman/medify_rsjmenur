<?php

namespace App\Http\Controllers\Pasien\AlamatKota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\AlamatKota;

class ReadController extends Controller
{
    	public function get()
    	{
    		$kota = AlamatKota::all();
    		return json_encode($kota);
    	}
    	public function search($id)
    	{
    		$kota = AlamatKota::where('provinsi_id',$id)->get();
    		return json_encode($kota);
    	}

		public function getKotaByNama($nama)
		{
			$kota = AlamatKota::where('nama', 'like', '%'.$nama.'%')
					->first();

			return $kota;
		}
}
