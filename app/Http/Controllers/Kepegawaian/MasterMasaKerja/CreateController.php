<?php

namespace App\Http\Controllers\Kepegawaian\MasterMasaKerja;

use App\Models\Kepegawaian\MasterMasaKerja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CreateController extends Controller
{
    public function create($request)
    {
        $masa_kerja = new MasterMasaKerja;
        $masa_kerja->nama = $request->nama;
        $masa_kerja->awal = $request->awal;
        $masa_kerja->akhir = $request->akhir;
        $masa_kerja->indek = $request->indek;
        $masa_kerja->created_by = Auth::user()->id;
        $masa_kerja->save();
        return $masa_kerja;
    }
}
