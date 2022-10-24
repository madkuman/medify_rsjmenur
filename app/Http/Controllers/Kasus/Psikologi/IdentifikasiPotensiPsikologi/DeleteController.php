<?php

namespace App\Http\Controllers\Kasus\Psikologi\IdentifikasiPotensiPsikologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\IdentifikasiPotensiPsikologi;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $identifikasi_potensi_psikologi = IdentifikasiPotensiPsikologi::find($id);
        if($identifikasi_potensi_psikologi)
        {
            $identifikasi_potensi_psikologi->deleted_by = Auth::user()->id;
            $identifikasi_potensi_psikologi->save();
            if(!is_null($identifikasi_potensi_psikologi->penunjang_id))
                app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($identifikasi_potensi_psikologi->penunjang_id);
            $identifikasi_potensi_psikologi->delete();
        }
    }
}