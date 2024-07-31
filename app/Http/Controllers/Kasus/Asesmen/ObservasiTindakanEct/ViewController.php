<?php

namespace App\Http\Controllers\Kasus\Asesmen\ObservasiTindakanEct;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Profesi;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;
use App\User;
use DOMPDF;

define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation', 'pasien']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $data['sidebar_active'] = 'alat';

        $observasi_tindakan_ect = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)->where('type', 'Observasi Tindakan ECT')->orderBy('id', 'desc')->get();
        $data['observasi_tindakan_ect'] = $observasi_tindakan_ect;

        $data['user'] = User::all();
        $dokter = Profesi::where('slug', 'dokter')->first();
        $data['dokter'] = User::where('profesi', $dokter->id)->get();
        $perawat = Profesi::where('slug', 'perawat')->first();
        $data['perawat'] = User::where('profesi', $perawat->id)->get();

        return view("kasus.asesmen.observasi-tindakan-ect.index", $data);
    }

    public function print($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;

        $ect = AlatBantu::with(['creator'])->where('kasus_id', $kasus->id)->where('type', 'Observasi Tindakan ECT')->get();
        $data['ect'] = $ect;

        $pdf = DOMPDF::loadView("kasus.asesmen.observasi-tindakan-ect.print", $data)->setPaper('a4', 'landscape');
        return $pdf->stream("print.pdf");
    }
}
