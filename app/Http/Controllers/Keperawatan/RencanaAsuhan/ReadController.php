<?php

namespace App\Http\Controllers\Keperawatan\RencanaAsuhan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keperawatan\RencanaAsuhan;

class ReadController extends Controller
{
	public function getListRencanaAsuhan($id)
	{
		$rencana = RencanaAsuhan::where('jenis_id',$id)->get();
		return json_encode($rencana);
	}
}
