<?php

namespace App\Http\Controllers\Hospital\Lokasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use Auth;

class EditController extends Controller
{
    public function edit($lokasi_id, $name)
    {
 	
		$loc = Lokasi::find($lokasi_id);
		$loc->nama = $name;
		$loc->save();

		if(!empty($loc->kategori_keuangan))
			$kategori_keuangan_parent = app('App\Http\Controllers\Keuangan\Kategori\EditController')->editNama($loc->kategori_keuangan_id,$name);

    	return $loc;
    }


    public function editWithoutKeuangan($lokasi_id, $name)
    {
 
		$loc = Lokasi::find($lokasi_id);
		$loc->nama = $name;
		$loc->save();

    	return $loc;
    }
}
