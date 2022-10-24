<?php

namespace App\Http\Controllers\Kepegawaian\MasterTimPembagiJasa;

use App\Models\Kepegawaian\MasterMasaKerja;
use App\Models\Kepegawaian\MasterTimPembagiJasa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function edit($request,$id)
    {
        $tim_pembagi_jasa = MasterTimPembagiJasa::find($id);
        $tim_pembagi_jasa->nama = $request->nama;
        $tim_pembagi_jasa->indek = $request->indek;
        $tim_pembagi_jasa->save();
        return $tim_pembagi_jasa;
    }
}
