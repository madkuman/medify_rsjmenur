<?php

namespace App\Http\Controllers\Farmasi\Katalog;

use App\Models\Farmasi\Katalog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReadController extends Controller
{
    public function getAll()
    {
	    $katalog = Katalog::all();
    	return $katalog;
    }

    public function getSingle($id)
    {
        $katalog = Katalog::find($id);
        return $katalog;
    }

}
