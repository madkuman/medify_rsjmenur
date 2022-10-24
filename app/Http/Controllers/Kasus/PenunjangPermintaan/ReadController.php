<?php

namespace App\Http\Controllers\Kasus\PenunjangPermintaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PenunjangPermintaan;

class ReadController extends Controller
{
	public function get($id)
	{
		$permintaan = PenunjangPermintaan::where('kasus_id',$id)->with('creator')->orderBy('id','desc')->get();
		return $permintaan;
	}
	public function getHistori($kasus_id)
	{
		$permintaan = PenunjangPermintaan::whereIn('kasus_id',$kasus_id)->orderBy('kasus_id','desc')->get();
		return $permintaan;
	}
}
