<?php

namespace App\Http\Controllers\Pasien\AlamatKelurahan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\AlamatKelurahan;

class ReadController extends Controller
{
    	public function get($id)
    	{
    		$query = AlamatKelurahan::where('kecamatan_id',$id)->orderBy('nama','asc')->get();
    		return json_encode($query);
    	}

		public function getKelurahanByNama($nama)
		{
			$kelurahan = AlamatKelurahan::where('nama', 'like', '%'.$nama.'%')
						->first();
			
			return $kelurahan;
		}
}
