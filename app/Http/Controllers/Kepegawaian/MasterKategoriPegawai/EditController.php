<?php

namespace App\Http\Controllers\Kepegawaian\MasterKategoriPegawai;

use App\Models\Kepegawaian\MasterKategoriPegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function edit($request,$id)
    {
        $kategori_pegawai = MasterKategoriPegawai::find($id);
        $kategori_pegawai->nama = $request->nama;
        $kategori_pegawai->pembagian_jaspel = $request->pembagian_jaspel;
        $kategori_pegawai->save();
        return $kategori_pegawai;
    }
}
