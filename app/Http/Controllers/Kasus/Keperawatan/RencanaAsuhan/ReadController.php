<?php

namespace App\Http\Controllers\Kasus\Keperawatan\RencanaAsuhan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Keperawatan;

class ReadController extends Controller
{
    	public function getLatest($kasus_id,$limit)
    	{
    		return $kasus_asuhan = Keperawatan::where('kasus_id', $kasus_id)->orderBy('id','desc')->take($limit)->get();
    	}

}
