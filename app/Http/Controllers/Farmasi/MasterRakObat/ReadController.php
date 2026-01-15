<?php

namespace App\Http\Controllers\Farmasi\MasterRakObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\MasterRakObat;

class ReadController extends Controller
{
    public function getAll()
    {
	    $master_rak_obat = MasterRakObat::all();
        return $master_rak_obat;
    }

    public function getSingle($id)
    {
        $master_rak_obat = MasterRakObat::with(['creator', 'updater'])->find($id);
        return $master_rak_obat;
    }
}
