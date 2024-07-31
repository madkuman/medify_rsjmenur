<?php

namespace App\Http\Controllers\Kasus\Asesmen\EvaluasiAwalManajerPelayananPasien;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Kasus\Asesmen\EvaluasiAwalManajerPelayananPasien\CreateController as Create;
use Illuminate\Http\Request;
use App\Models\Kasus\AlatBantu;
use Auth;

class EditController extends Controller
{
    public function edit(Request $request){
    	if ($asesmen = AlatBantu::find($request->id)) {
            $asesmen->val = (new Create)->createJson($request);
            $asesmen->updated_by = Auth::user()->id;
            $asesmen->save();
        }
    }
}