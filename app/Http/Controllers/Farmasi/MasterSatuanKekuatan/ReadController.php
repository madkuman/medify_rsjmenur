<?php

namespace App\Http\Controllers\Farmasi\MasterSatuanKekuatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\MasterSatuanKekuatan;

class ReadController extends Controller
{
    public function getAll()
    {
	    $satuan_kekuatan = MasterSatuanKekuatan::all();
    	return $satuan_kekuatan;
    }

    public function getSingle($id)
    {
        $satuan_kekuatan = MasterSatuanKekuatan::find($id);
        return $satuan_kekuatan;
    }

}
