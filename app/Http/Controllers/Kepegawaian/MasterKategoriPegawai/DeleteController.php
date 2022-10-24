<?php

namespace App\Http\Controllers\Kepegawaian\MasterKategoriPegawai;

use App\Models\Kepegawaian\MasterKategoriPegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $kategori_pegawai = MasterKategoriPegawai::find($id);
        $kategori_pegawai->delete();
    }
}
