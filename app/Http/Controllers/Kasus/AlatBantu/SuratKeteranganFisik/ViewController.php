<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratKeteranganFisik;

use DOMPDF;
use App\User;
use Carbon\Carbon;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $eagers = [
            "lokasi.lokasi.departemen",
            "identitas",
            "pembayaran.perusahaan.tipe",
            "pasien",
            "kelas",
            "end_by_creator"
        ];
        $kasus = Kasus::with($eagers)->where("nomor_kasus", $nomor_kasus)->first();
        $data['alat_bantu'] = AlatBantu::query()
            ->where('kasus_id', $kasus->id)
            ->where('type', 'surat-keterangan-fisik')
            ->get();

        $data['kasus'] = $kasus;
        $user = User::select('id', 'name', 'profesi')->get();
        $data['petugas'] = $user;
        $data['dokter'] = $user->where('profesi', 1);
        $data['sidebar_active'] = 'alat';
        return view('kasus.alatbantu.surat-keterangan-fisik.index', $data);
    }

    public function print($nomor_kasus, $alatbantu_id)
    {
        $alat_bantu = AlatBantu::findOrFail($alatbantu_id);

        $data['kasus'] = $alat_bantu->kasus;
        $data['alat_bantu'] = $alat_bantu;
        $data['form_data'] = json_decode($alat_bantu->val);

        $pdf = DOMPDF::loadView("kasus.alatbantu.surat-keterangan-fisik.print", $data);
        $pdf->setPaper('a4');
        return $pdf->stream("print.pdf");
    }
}
