<?php

namespace App\Http\Controllers\Farmasi\MasterJenisInteraksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\MasterJenisInteraksi;

class ReadController extends Controller
{
    public function getAll()
    {
	    $katalog = MasterJenisInteraksi::all();
    	return $katalog;
    }

    public function getSingle($id)
    {
        $katalog = MasterJenisInteraksi::find($id);
        return $katalog;
    }

}
