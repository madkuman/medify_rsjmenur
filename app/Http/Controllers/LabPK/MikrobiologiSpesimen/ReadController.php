<?php

namespace App\Http\Controllers\LabPK\MikrobiologiSpesimen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\MikrobiologiSpesimen;
use App\Models\LabPK\MikrobiologiSpesimenKategori;

class ReadController extends Controller
{
    public function APIgetAll()
    {
    	$item = MikrobiologiSpesimenKategori::with('spesimen')->get();

    	return json_encode($item);
    }
}
