<?php

namespace App\Http\Controllers\Kepegawaian\MasterGolongan;

use App\Models\Kepegawaian\MasterGolongan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CreateController extends Controller
{
    public function create($request)
    {
        $golongan = new MasterGolongan;
        $golongan->nama = $request->nama;
        $golongan->indek = $request->indek;
        $golongan->jp_dasar = $request->jp_dasar;
        $golongan->pajak = $request->pajak;
        $golongan->created_by = Auth::user()->id;
        $golongan->save();
        return $golongan;
    }
}
