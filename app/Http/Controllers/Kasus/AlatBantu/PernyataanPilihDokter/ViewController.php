<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PernyataanPilihDokter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use App\User;
use DOMPDF;

define('relasi', ['identitas', 'pasien']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $surat = AlatBantu::with(['creator'])->where('kasus_id', $kasus->id)
        		->where('type', 'surat_pernyataan_memilih_dokter')->orderBy('id', 'desc')->get();

        $data['dokter'] = User::where('profesi',1)->get();
        $data['surat'] = $surat;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.pernyataan-pilih-dokter.index', $data);
    }

    public function print($nomor_kasus, $id)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $surat = AlatBantu::with(['creator', 'kasus'])->find($id);

        $data['surat'] = $surat;
        $data['val'] = json_decode($surat->val);

        $pdf = DOMPDF::loadView('kasus.alatbantu.pernyataan-pilih-dokter.print', $data);
        return $pdf->stream('surat_pernyataan_memilih_dokter.pdf');
    }
}
