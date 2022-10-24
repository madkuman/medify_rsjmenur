<?php

namespace App\Http\Controllers\Hospital\Lokasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;

class DeleteController extends Controller
{
    public function delete($lokasi_id)
    {
    	
		$loc = Lokasi::find($lokasi_id);

		if(!empty($loc->kategori_keuangan_id))
			$kategori_keuangan_parent = app('App\Http\Controllers\Keuangan\Kategori\DeleteController')->delete($loc->kategori_keuangan_id);

		$loc->delete();

    	return 1;
    }

    public function deleteWithoutKeuangan($lokasi_id)
    {
    	
		$loc = Lokasi::find($lokasi_id);
		$loc->delete();

    	return 1;
    }
}
