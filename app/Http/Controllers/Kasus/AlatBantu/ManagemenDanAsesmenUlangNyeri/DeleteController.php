<?php

namespace App\Http\Controllers\Kasus\AlatBantu\ManagemenDanAsesmenUlangNyeri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\ManagemenDanAsesmenUlangNyeri;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $managemen_dan_asesmen_ulang_nyeri = ManagemenDanAsesmenUlangNyeri::find($id);
        if($managemen_dan_asesmen_ulang_nyeri)
        {
            $managemen_dan_asesmen_ulang_nyeri->deleted_by = Auth::user()->id;
            $managemen_dan_asesmen_ulang_nyeri->save();
            $managemen_dan_asesmen_ulang_nyeri->delete();
        }
    }
}