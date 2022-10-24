<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenNapzaRawatJalanNonIPWL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenNapzaRawatJalanNonIPWL;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $asesmen_napza_rawat_jalan_non_ipwl = AsesmenNapzaRawatJalanNonIPWL::find($id);
        if($asesmen_napza_rawat_jalan_non_ipwl)
        {
            $asesmen_napza_rawat_jalan_non_ipwl->deleted_by = Auth::user()->id;
            $asesmen_napza_rawat_jalan_non_ipwl->save();
            $asesmen_napza_rawat_jalan_non_ipwl->delete();
        }
    }
}