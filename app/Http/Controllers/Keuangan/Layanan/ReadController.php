<?php

namespace App\Http\Controllers\Keuangan\Layanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Tarif;

class ReadController extends Controller
{
	public function get(Request $request){

            $search = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword);
    		if(!empty($search))
    			$layanan = Tarif::search($search)->paginate(7)->pluck('id');
    		else
    			$layanan = Tarif::orderBy('id', 'desc')->paginate(7)->pluck('id');


    		$tarif = Tarif::whereIn('id',$layanan)->with('tarif_kategori')->get();

    		return json_encode($tarif);
    	}
    
}
