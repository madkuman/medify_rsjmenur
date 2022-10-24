<?php

namespace App\Http\Controllers\Pasien\PernyataanPilihDokter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Pasien\PernyataanPilihDokter;
use App\User;
use DOMPDF;

define('relasi', ['identitas', 'pasien']);

class ViewController extends Controller
{
    public function index($pasien_id)
    {
        $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($pasien_id);
        $data['identitas'] = $pasien['identitas'];

        $surat = PernyataanPilihDokter::with(['creator', 'dokter'])->where('pasien_id', $data['identitas']->id)
                ->orderBy('id', 'desc')->get();

        $data['dokters'] = User::where('profesi',1)->get();
        $data['surat'] = $surat;

        return view('pasien.pernyataan-pilih-dokter.index', $data);
    }

    public function print($pasien_id, $id_surat)
    {
        $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($pasien_id);
        $data['identitas'] = $pasien['identitas'];
        $surat = PernyataanPilihDokter::with(['creator', 'dokter'])->find($id_surat);

        $data['surat'] = $surat;
        
        $pdf = DOMPDF::loadView('pasien.pernyataan-pilih-dokter.print', $data);
        return $pdf->stream('surat_pernyataan_memilih_dokter.pdf');
    }
}
