<?php

namespace App\Http\Controllers\CSSD\AlkesSatuan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\AlkesSatuan;
use Auth;

class CreateController extends Controller
{
	public function create($alkes_id,$jumlah,$jumlah_pemakaian=0)
	{
		for($i=0;$i<$jumlah;$i++)
		{
			$alkes = new AlkesSatuan;
			$alkes->item_template_id = $alkes_id;
			$alkes->slug = $this->getSlug($alkes_id);
			$alkes->jumlah_pemakaian = $jumlah_pemakaian;
			$alkes->created_by = Auth::user()->id;
			$alkes->save();
		}

		return $alkes;
	}

	private function getSlug($alkes_id)
	{
		$alkes_id_slug = str_pad($alkes_id, 4, '0', STR_PAD_LEFT);
		$total = AlkesSatuan::where('item_template_id',$alkes_id)->count();
		$total+= 1;
		$alkes_id_slug2 = str_pad($total, 4, '0', STR_PAD_LEFT);
		return $alkes_id_slug.$alkes_id_slug2;
	}
}
