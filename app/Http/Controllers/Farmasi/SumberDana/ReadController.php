<?php

namespace App\Http\Controllers\Farmasi\SumberDana;

use App\Models\Farmasi\SumberDana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReadController extends Controller
{
    public function getAll()
    {
	    $sumber_dana = SumberDana::all();
    	return $sumber_dana;
    }

    public function getSingle($id)
    {
        $sumber_dana = SumberDana::find($id);
        return $sumber_dana;
    }

}
