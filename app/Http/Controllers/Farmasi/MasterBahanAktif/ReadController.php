<?php

namespace App\Http\Controllers\Farmasi\MasterBahanAktif;

use App\Models\Farmasi\MasterBahanAktif;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReadController extends Controller
{
    public function getAll()
    {
	    $master_bahan_aktif = MasterBahanAktif::all();
    	return $master_bahan_aktif;
    }

    public function getSingle($id)
    {
        $master_bahan_aktif = MasterBahanAktif::find($id);
        return $master_bahan_aktif;
    }

}
