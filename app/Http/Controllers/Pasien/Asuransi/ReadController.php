<?php

namespace App\Http\Controllers\Pasien\Asuransi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Asuransi;

class ReadController extends Controller
{
    	public function getAll(){
    		$asuransi = Asuransi::all();
    		return $asuransi;
    	}

    	public function searchAsuransiByKeyword(Request $request, $keyword) {

            $asuransi = Asuransi::where('name', 'like', '%'.$keyword.'%')->limit(10)->get();
            return $asuransi;

        }
}
