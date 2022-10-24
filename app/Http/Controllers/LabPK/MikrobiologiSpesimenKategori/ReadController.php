<?php

namespace App\Http\Controllers\LabPK\MikrobiologiSpesimenKategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\MikrobiologiSpesimen;
use App\Models\LabPK\MikrobiologiSpesimenKategori;

class ReadController extends Controller
{
	public function get()
	{
		$item = MikrobiologiSpesimenKategori::with('spesimen')->get();

		return $item;
	}
}
