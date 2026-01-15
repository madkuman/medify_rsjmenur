<?php

namespace App\Http\Controllers\Kasus\Asesmen\SuratPernyataanKesanggupanPembiayaan;

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

        $surat = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)->where('type', 'surat-pernyataan-kesanggupan-pembiayaan')->orderBy('id', 'desc')->get();
        $data['surat'] = $surat;

        $data['user'] = User::all();
        $dokter = Profesi::where('slug', 'dokter')->first();
        $data['dokter'] = User::where('profesi', $dokter->id)->get();
        $perawat = Profesi::where('slug', 'perawat')->first();
        $data['perawat'] = User::where('profesi', $perawat->id)->get();

        return view("kasus.asesmen.surat-pernyataan-kesanggupan-pembiayaan.index", $data);
    }

    public function print($nomor_kasus)
    {
        // set_time_limit(300);
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;

        $ect = AlatBantu::with(['creator'])->where('kasus_id', $kasus->id)->where('type', 'surat-pernyataan-kesanggupan-pembiayaan')->latest()->first();
        $data['ect'] = $ect;

        $pdf = DOMPDF::loadView("kasus.asesmen.surat-pernyataan-kesanggupan-pembiayaan.print", $data)->setPaper('a4', 'potrait');
        return $pdf->stream("print.pdf");
    }
}
