<?php

namespace App\Http\Controllers\IGD\Ruangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\IGD\Ruangan;

class ReadController extends Controller
{
    public function getAll()
	{
		$items = Ruangan::all();
		return json_encode(['data'=>$items]);
	}	

	public function getSingleRuangan($id)
	{
		$items = Ruangan::find($id);
		return json_encode(['data'=>$items]);
	}

	public function allRuanganPrint()
	{
		$items = Ruangan::all();
		return $items;
	}
}
