<?php

namespace App\Http\Controllers\Users\JasaMedis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ViewController extends Controller
{
    	public function index()
    	{
    		$user_id = Auth::user()->id;
          $data['jasamedis'] = app('App\Http\Controllers\Keuangan\JasaMedis\ReadController')->getUnpaidJasaMedis($user_id);

    		return view('users.jasamedis.index',$data);
    	}

    	public function paid()
    	{
    		$user_id = Auth::user()->id;
          $data['jasamedis'] = app('App\Http\Controllers\Keuangan\JasaMedis\ReadController')->getPaidJasaMedis($user_id);

    		return view('users.jasamedis.index-paid',$data);
    	}
}
