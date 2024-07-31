<?php

namespace App\Http\Controllers\Farmasi\MasterRute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\MasterRute;

class ReadController extends Controller
{
    public function getAll()
    {
	    $master_rute = MasterRute::all();
    	return $master_rute;
    }

    public function getSingle($id)
    {
        $master_rute = MasterRute::find($id);
        return $master_rute;
    }

}
