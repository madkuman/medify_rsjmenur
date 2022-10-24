<?php

namespace App\Http\Controllers\UnitTindakan\UnitTindakan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UnitTindakan\UnitTindakan;
use stdClass;

class EditController extends Controller
{
    public function edit($data)
	{	
		// dd($data->poli_id);
		$tindakan = UnitTindakan::find($data->id);
		$obj = new stdClass();
		$obj->old_url = "unit-tindakan/".$tindakan->slug;

		$tindakan->slug = ($tindakan->nama != $data->nama) ? $this->createSlug($data->nama) : $tindakan->slug ;
		$tindakan->nama = $data->nama;
		$tindakan->poli_id = $data->poli_id;
		$tindakan->save();

		$obj->id = $tindakan->id;
		$obj->nama = $tindakan->nama;
		$obj->new_url = "unit-tindakan/".$tindakan->slug;
		$obj->slug = $tindakan->slug;
		$obj->poli_id = $tindakan->poli_id;
		$obj->lokasi_id = $tindakan->lokasi_id;
		return $obj;
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

	public function editGroupID($id,$group_id)
	{
		$tindakan = UnitTindakan::find($id);
		$tindakan->group_id = $group_id;
		$tindakan->save();
		return $tindakan;
	}
}
