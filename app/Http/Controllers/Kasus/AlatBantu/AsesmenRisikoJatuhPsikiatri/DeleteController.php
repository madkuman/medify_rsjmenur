<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsesmenRisikoJatuhPsikiatri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenRisikoJatuhPsikiatri;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $asesmen_risiko_jatuh_psikiatri = AsesmenRisikoJatuhPsikiatri::find($id);
        if($asesmen_risiko_jatuh_psikiatri)
        {
            $asesmen_risiko_jatuh_psikiatri->deleted_by = Auth::user()->id;
            $asesmen_risiko_jatuh_psikiatri->save();
            $asesmen_risiko_jatuh_psikiatri->delete();
        }
    }
}