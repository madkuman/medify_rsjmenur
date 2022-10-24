<?php

namespace App\Http\Controllers\Pasien\Keanggotaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIPangkat;
use App\Models\Pasien\TNISatker;

class ReadController extends Controller
{
	public function getPangkat($id)
	{
		$query = TNIPangkat::where('keanggotaan',$id)->orderBy('nama','asc')->get();
		return json_encode($query);
	}

	public function getSatker($id)
	{
		$query = TNISatker::where('kotama_id',$id)->orderBy('nama','asc')->get();
		return json_encode($query);
	}
}
