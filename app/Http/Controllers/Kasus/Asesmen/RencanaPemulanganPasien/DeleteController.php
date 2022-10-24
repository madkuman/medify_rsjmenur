<?php

namespace App\Http\Controllers\Kasus\Asesmen\RencanaPemulanganPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RencanaPemulanganPasien;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $rencana_pemulangan_pasien = RencanaPemulanganPasien::find($id);
        if($rencana_pemulangan_pasien)
        {
            $rencana_pemulangan_pasien->deleted_by = Auth::user()->id;
            $rencana_pemulangan_pasien->save();
            $rencana_pemulangan_pasien->delete();
        }
    }
}