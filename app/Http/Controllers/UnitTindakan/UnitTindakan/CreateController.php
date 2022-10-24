<?php

namespace App\Http\Controllers\UnitTindakan\UnitTindakan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UnitTindakan\UnitTindakan;

class CreateController extends Controller
{
	public function new($nama,$lokasi_id,$poli_id)
	{	
		$tindakan = new UnitTindakan;
		$tindakan->nama = $nama;
		$tindakan->lokasi_id = $lokasi_id;
		$tindakan->slug = $this->createSlug($nama);
		$tindakan->poli_id = $poli_id;
		$tindakan->save();
		return $tindakan;
	}

	private function createSlug($nama)
	{
		$slug = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $nama));
		$slug = str_replace(' ', '-', $slug);

		if(is_null(UnitTindakan::where('slug', $slug)->first()))
			return $slug;
		$num = 1;
		while(1) {
			$new_slug = $slug.'-'.$num;
			if(is_null(UnitTindakan::where('slug', $new_slug)->first()))
				return $new_slug;
			$num++;
		}
	}
}