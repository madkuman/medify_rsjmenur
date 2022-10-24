<?php

namespace App\Http\Controllers\Admin\PendaftaranOnline\TarifKembali;

use App\Models\Hospital\MasterTarifKembali;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReadController extends Controller
{

	public function get()
	{
		$master_tarif_kembali = MasterTarifKembali::all();
		return $master_tarif_kembali;
	}
    
}
