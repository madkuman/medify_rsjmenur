<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai\SuratPeringatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kepegawaian\SuratPeringatan;

class DeleteController extends Controller
{
    function delete($id)
    {
        $hapus = SuratPeringatan::find($id);

        $hapus->delete();
        return $hapus;
    }
}
