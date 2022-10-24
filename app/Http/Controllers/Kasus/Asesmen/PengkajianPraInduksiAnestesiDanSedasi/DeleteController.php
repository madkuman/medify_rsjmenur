<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianPraInduksiAnestesiDanSedasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengkajianPraInduksiAnestesiDanSedasi;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $pengkajian_pra_induksi_anestesi_dan_sedasi = PengkajianPraInduksiAnestesiDanSedasi::find($id);
        if($pengkajian_pra_induksi_anestesi_dan_sedasi)
            $pengkajian_pra_induksi_anestesi_dan_sedasi->delete();
    }
}