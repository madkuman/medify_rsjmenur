<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai\SuratPeringatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kepegawaian\SuratPeringatan;
use App\Models\Kepegawaian\MasterJenisSuratPeringatan;
use App\Models\Kepegawaian\Pegawai;

use DOMPDF;

class ReadController extends Controller
{
    public function getPegawai($id)
    {
        $pegawai = Pegawai::find($id);
        return $pegawai;
    }

    public function getAllPangkat($id)
    {
        $pegawai = Pegawai::find($id);
        $pangkat = SuratPeringatan::where('pegawai_id', $pegawai->id)->with(['masterJenisSuratPeringatan'])->paginate(5);
        return $pangkat;
    }

    public function jenisSurat()
    {
        return $jenis = new MasterJenisSuratPeringatan;
    }

    public function getEditPegawai($id)
    {
        return $jenis = SuratPeringatan::with(['masterJenisSuratPeringatan'])->find($id);
    }

    public function download($id)
    {
        return $file = SuratPeringatan::findOrFail($id);
    }

    public function print($id)
    {
        $file = SuratPeringatan::find($id);
        $pdf = DOMPDF::loadView('kepegawaian.pegawai.surat-peringatan.pdf', ['file' => $file]);
        return $pdf;
    }
}
