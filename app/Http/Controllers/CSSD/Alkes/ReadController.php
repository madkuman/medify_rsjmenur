<?php

namespace App\Http\Controllers\CSSD\Alkes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\Alkes;

class ReadController extends Controller
{
    	public function search(Request $request)
    	{
    		$keyword = $request->get("search");
    		$keyword = preg_replace("/[^[:alnum:][:space:]]/u", '', $keyword);
    		if(isset($keyword))
    			$alkes = Alkes::search($keyword)->paginate(10);
    		else
    			$alkes = Alkes::orderBy('id', 'desc')->paginate(10);
    		return json_encode($alkes);
    	}
}
