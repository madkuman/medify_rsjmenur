<?php

namespace App\Http\Controllers\Pasien\AlamatKecamatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\AlamatKecamatan;

class ReadController extends Controller
{
    	public function get($id)
    	{
    		$kecamatan = AlamatKecamatan::where('kota_id',$id)->orderBy('nama','asc')->get();
    		return json_encode($kecamatan);
    	}

		public function getKecamatanByNama($nama)
		{
			$kecamatan = AlamatKecamatan::where('nama', 'like',  '%'.$nama.'%')
						->first();

			return $kecamatan;
		}
}
