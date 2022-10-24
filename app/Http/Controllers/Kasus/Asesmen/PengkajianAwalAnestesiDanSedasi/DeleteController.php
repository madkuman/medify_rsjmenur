<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianAwalAnestesiDanSedasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengkajianAwalAnestesiDanSedasi;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $pengkajian_awal_anestesi_dan_sedasi = PengkajianAwalAnestesiDanSedasi::find($id);
        if($pengkajian_awal_anestesi_dan_sedasi)
            $pengkajian_awal_anestesi_dan_sedasi->delete();
    }
}