<?php

namespace App\Http\Controllers\Kasus\Farmasi\FormulirPasienPemantauanTerapiObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\AsesmenAwal2;
use App\Models\Kasus\CPPT;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\RekonsiliasiObat;
use App\Models\Kasus\VitalSign;
use DOMPDF;

class ViewController extends Controller
{
    public function index(Request $request, $nomor_kasus)
    {
		$kasus = Kasus::with('pasien')->where('nomor_kasus',$nomor_kasus)->first();

        $formulir_pasien = AlatBantu::with(['creator'])->where('kasus_id', $kasus->id)->where('type', 'Formulir Pasien Pemantauan Terapi Obat')->get();
        $data['formulir_pasien'] = $formulir_pasien;

        $asesmen2 = AsesmenAwal2::with('creator.specialty_detail','verifikatorDokter','verifikatorNers')->where('kasus_id', $kasus->id)->orderBy('id', 'desc')->first();
        $data['asesmen2'] = $asesmen2; 

		$rekonsiliasi_awal_data = RekonsiliasiObat::where('kasus_id', $kasus->id)->where('jenis','awal')->first();
        $data['rekonsiliasi_awal_data'] = $rekonsiliasi_awal_data;

        $vital_sign = VitalSign::where('kasus_id', $kasus->id)->take(6)->get();
        $data['vital_sign'] = $vital_sign;

        $cppt = CPPT::where('kasus_id', $kasus->id)->take(3)->get();
        $data['cppt'] = $cppt;

		$data['kasus'] = $kasus;
		$data['sidebar_active'] = 'farmasi';
		$data['active_nav'] = 'formulir-pasien-pemantauan-terapi-obat';

		return view('kasus.farmasi.formulir-pasien-pemantauan-terapi-obat',$data);
    }

    public function print($nomor_kasus, $id)
    {
        $eager = [
            'pasien',
            'identitas'
        ];

        $kasus = Kasus::with($eager)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;

        $formulir_pasien = AlatBantu::with(['creator'])->where('kasus_id', $kasus->id)->where('type', 'Formulir Pasien Pemantauan Terapi Obat')->where('id', $id)->first();
        $data['formulir_pasien'] = $formulir_pasien;

        $pdf = DOMPDF::loadView("kasus.farmasi.printout.formulir-pasien-pemantauan-terapi-obat", $data)->setPaper('a4', 'portrait');
        return $pdf->stream("formulir-pasien-pemantauan-terapi-obat.pdf");
    }
}
