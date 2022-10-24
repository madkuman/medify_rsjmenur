<?php

namespace App\Http\Controllers\UnitTindakan\UnitTindakan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UnitTindakan\UnitTindakan;

class ReadController extends Controller
{
	public function get()
	{		
		return UnitTindakan::get();
	}

	// public function getBySlug($slug,$flag) //flag 0 = untuk dashboard ,1 = histori
	// {
	// 	return UnitTindakan::where('slug', $slug)->with([
	// 		'transaksi' => function($q) use ($flag){
	// 			$q->where('flag',$flag);
	// 		}])->first();
	// }

	public function getBySlug($slug)
	{
		return UnitTindakan::where('slug',$slug)->first();
	}

	public function getAll(){
		return UnitTindakan::all();
	}
}