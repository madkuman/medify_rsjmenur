<?php

namespace App\Http\Controllers\Keperawatan\RencanaAsuhanDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keperawatan\RencanaAsuhanDetail;
class ReadController extends Controller
{
	public function getSingle($rencana_asuhan_id,$jenis_id,$id)
	{	
		$data = RencanaAsuhanDetail::where('rencana_asuhan_id', $rencana_asuhan_id)->where('jenis_id', $jenis_id)->where('id',$id)->first();
		return $data;
	}
}
