<?php

namespace App\Http\Controllers\Pasien\PermohonanPindahKelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Pasien\PermohonanPindahKelas;
use App\Models\Hospital\Kelas;
use DOMPDF;

class ViewController extends Controller
{
    public function index($pasien_id)
    {
        $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($pasien_id);
        $data['identitas'] = $pasien['identitas'];

        $surat = PermohonanPindahKelas::with(['creator', 'awalKelas', 'tujuanKelas'])->where('pasien_id', $data['identitas']->id)
                ->orderBy('id', 'desc')->get();

        $data['kelas'] = Kelas::where('rawat_inap',1)->get();
        $data['surat'] = $surat;

        return view('pasien.permohonan-pindah-kelas.index', $data);
    }

    public function print($pasien_id, $id_surat)
    {
        $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($pasien_id);
        $data['identitas'] = $pasien['identitas'];
        $surat = PermohonanPindahKelas::with(['creator', 'awalKelas', 'tujuanKelas'])->find($id_surat);

        $data['surat'] = $surat;
        
        $pdf = DOMPDF::loadView('pasien.permohonan-pindah-kelas.print', $data, [])->setPaper('a4', 'portrait');
        return $pdf->stream('surat_permohonan_pindah_kelas.pdf');
    }
}
