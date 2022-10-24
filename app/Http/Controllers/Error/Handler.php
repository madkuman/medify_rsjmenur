<?php

namespace App\Http\Controllers\Error;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Bugsnag;
use Auth;

class Handler extends Controller
{
	public function bugsnag($e, $custom = FALSE, $message = NULL)
	{
		//jika env debug false maka akan di report via bugsnag
		if(config('app.debug') != 1)
		{
			if($custom)
				dd($message);
			else
				Bugsnag::notifyException($e);

		}
		else{
			dd($e);
		}


	}
}
