<?php

namespace App\Http\Controllers\Kepegawaian\MasterGolongan;

use App\Models\Kepegawaian\MasterGolongan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function edit($request,$id)
    {
        $golongan = MasterGolongan::find($id);
        $golongan->indek = $request->indek;
        $golongan->jp_dasar = $request->jp_dasar;
        $golongan->pajak = $request->pajak;
        $golongan->save();
        return $golongan;
    }
}
