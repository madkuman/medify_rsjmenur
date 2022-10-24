<?php

namespace App\Http\Controllers\Farmasi\Resep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Resep;

class DeleteController extends Controller{

	public function deleteResep($id)
	{
		$resep = Resep::with('resep_detail')->find($id);
		if($resep){
			foreach ($resep->resep_detail as  $resep_detail) {
				app('App\Http\Controllers\Farmasi\ResepDetail\DeleteController')->deleteDetail($resep_detail->id);
			}
		}
	}
}