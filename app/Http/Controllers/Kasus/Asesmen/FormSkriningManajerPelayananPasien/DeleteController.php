<?php

namespace App\Http\Controllers\Kasus\Asesmen\FormSkriningManajerPelayananPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        $id = $request->id;
        $asesmen = AlatBantu::find($id);
        
        if ($asesmen) {
            $asesmen->deleted_by = Auth::user()->id;
            $asesmen->save();
            $asesmen->delete();
        }
    }
}
