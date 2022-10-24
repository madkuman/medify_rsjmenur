<?php

namespace App\Http\Controllers\Keperawatan\RencanaAsuhanDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keperawatan\RencanaAsuhanDetail;

class CreateController extends Controller
{
    	public function create($rencana_asuhan_id, $konten,$jenis_id)
    	{
    		$kep = new RencanaAsuhanDetail;
    		$kep->rencana_asuhan_id = $rencana_asuhan_id;
    		$kep->jenis_id = $jenis_id;
    		$kep->konten = $konten;
    		$kep->save();

    		return $kep;
    	}
}
