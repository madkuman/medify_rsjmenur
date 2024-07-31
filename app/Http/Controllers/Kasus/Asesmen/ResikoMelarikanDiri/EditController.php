<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResikoMelarikanDiri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use Auth;

class EditController extends Controller
{
    public function edit(Request $req){
    	$alatbantu = AlatBantu::find($req->id);
        $alatbantu->val = app(\App\Http\Controllers\Kasus\Asesmen\ResikoMelarikanDiri\CreateController::class)
            ->requestToJson($req);
        $alatbantu->updated_by = Auth::user()->id;
    	$alatbantu->save();
    }
}