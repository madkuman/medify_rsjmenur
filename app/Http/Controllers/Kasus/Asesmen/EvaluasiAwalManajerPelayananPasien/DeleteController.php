<?php

namespace App\Http\Controllers\Kasus\Asesmen\EvaluasiAwalManajerPelayananPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        if ($asesmen = AlatBantu::find($request->id)) {
            $asesmen->deleted_by = Auth::user()->id;
            $asesmen->save();
            $asesmen->delete();
        }
    }
}
