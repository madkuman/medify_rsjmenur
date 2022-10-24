<?php

namespace App\Http\Controllers\Kepegawaian\MasterKategoriPegawai;

use App\Models\Kepegawaian\MasterKategoriPegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CreateController extends Controller
{
    public function create($request)
    {
        $kategori_pegawai = new MasterKategoriPegawai;
        $kategori_pegawai->nama = $request->nama;
        $kategori_pegawai->pembagian_jaspel = $request->pembagian_jaspel;
        $kategori_pegawai->created_by = Auth::user()->id;
        $kategori_pegawai->save();
        return $kategori_pegawai;
    }
}
