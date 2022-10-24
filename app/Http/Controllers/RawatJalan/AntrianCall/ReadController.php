<?php

namespace App\Http\Controllers\RawatJalan\AntrianCall;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\RawatJalan\AntrianCall;

class ReadController extends Controller
{
	public function get($last_id = 0)
	{	
		$now = Carbon::now()->subMinute();
		if($last_id != 0)
		{
			$antrian_call = AntrianCall::where('id','>',$last_id)->orderBy('id','asc')->first();
		}
		else
		{
			$antrian_call = AntrianCall::where('created_at','>',$now)->orderBy('id','desc')->first();
		}
		
		if(empty($antrian_call))
		{
			$antrian_call = AntrianCall::find($last_id);
		}
		return json_encode($antrian_call);
	}
}
