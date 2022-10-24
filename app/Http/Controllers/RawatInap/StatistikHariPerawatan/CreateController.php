<?php

namespace App\Http\Controllers\RawatInap\StatistikHariPerawatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\StatistikHariPerawatan;
use Carbon\Carbon;

class CreateController extends Controller
{
	public function create($tanggal,$bed_id,$transaksi_id = null)
	{
		
		$item = new StatistikHariPerawatan;
		$item->tanggal=$tanggal;	
		$item->bed_id=$bed_id;	
		$item->transaksi_id=$transaksi_id;	
		$item->deleted_at = $this->check($bed_id,$tanggal);
		$item->save();
		
	}

	private function check($bed_id,$tanggal)
	{
		$item = StatistikHariPerawatan::where('bed_id',$bed_id)->where('tanggal',$tanggal)->get();
		if(count($item)>0) return Carbon::now();
		else return null;
	}
}
