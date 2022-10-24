<?php

namespace App\Http\Controllers\Kepegawaian\MasterMasaKerja;

use App\Models\Kepegawaian\MasterMasaKerja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function edit($request,$id)
    {
        $masa_kerja = MasterMasaKerja::find($id);
        $masa_kerja->nama = $request->nama;
        $masa_kerja->awal = $request->awal;
        $masa_kerja->akhir = $request->akhir;
        $masa_kerja->indek = $request->indek;
        $masa_kerja->save();
        return $masa_kerja;
    }
}
