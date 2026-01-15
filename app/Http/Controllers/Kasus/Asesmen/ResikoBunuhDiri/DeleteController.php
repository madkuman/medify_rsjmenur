<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResikoBunuhDiri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        if ($alatbantu = AlatBantu::find($request->id)) {
            $alatbantu->deleted_by = Auth::user()->id;
            $alatbantu->save();
            $alatbantu->delete();
        }
    }
}
