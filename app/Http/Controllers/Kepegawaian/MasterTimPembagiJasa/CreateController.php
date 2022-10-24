<?php

namespace App\Http\Controllers\Kepegawaian\MasterTimPembagiJasa;

use App\Models\Kepegawaian\MasterMasaKerja;
use App\Models\Kepegawaian\MasterTimPembagiJasa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CreateController extends Controller
{
    public function create($request)
    {
        $tim_pembagi_jasa = new MasterTimPembagiJasa();
        $tim_pembagi_jasa->nama = $request->nama;
        $tim_pembagi_jasa->indek = $request->indek;
        $tim_pembagi_jasa->created_by = Auth::user()->id;
        $tim_pembagi_jasa->save();
        return $tim_pembagi_jasa;
    }
}
