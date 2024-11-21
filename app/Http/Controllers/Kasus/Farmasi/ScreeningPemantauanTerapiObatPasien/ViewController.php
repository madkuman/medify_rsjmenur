<?php

namespace App\Http\Controllers\Kasus\Farmasi\ScreeningPemantauanTerapiObatPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;
use DOMPDF;

class ViewController extends Controller
{
    public function index(Request $request, $nomor_kasus)
    {
        $kasus = Kasus::with('pasien')->where('nomor_kasus', $nomor_kasus)->first();

        $pemantauan_terapi = AlatBantu::with(['creator'])->where('kasus_id', $kasus->id)->where('type', 'Screening Pemantauan Terapi Obat Pasien')->get();
        $data['pemantauan_terapi'] = $pemantauan_terapi;

        $data['kasus'] = $kasus;
        $data['sidebar_active'] = 'farmasi';
        $data['active_nav'] = 'screening-pemantauan-terapi-obat-pasien';

        return view('kasus.farmasi.screening-pemantauan-terapi-obat-pasien', $data);
    }

    public function print($nomor_kasus)
    {
        $kasus = Kasus::with('pasien')->where('nomor_kasus', $nomor_kasus)->first();
        $data['kasus'] = $kasus;

        $pemantauan_terapi = AlatBantu::with(['creator'])->where('kasus_id', $kasus->id)->where('type', 'Screening Pemantauan Terapi Obat Pasien')->get();
        $data['pemantauan_terapi'] = $pemantauan_terapi;

        $pdf = DOMPDF::loadView("kasus.farmasi.printout.printout-screening-pemantauan-terapi-obat-pasien", $data)->setPaper('a4', 'portrait');
        return $pdf->stream("pemantauan-terapi-obat-pasien.pdf");
    }
}
