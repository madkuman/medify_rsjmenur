<?php

namespace App\Http\Controllers\Kasus\Asesmen\PenandaanAreaOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PenandaanAreaOperasi;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $penandaan_area_operasi = PenandaanAreaOperasi::find($id);
        if($penandaan_area_operasi)
            $penandaan_area_operasi->delete();
    }
}