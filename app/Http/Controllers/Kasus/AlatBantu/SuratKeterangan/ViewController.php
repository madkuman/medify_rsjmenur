<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratKeterangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use App\Models\Kepegawaian\Pegawai;
use App\User;
use DOMPDF;

define('relasi', ['identitas', 'pasien']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $surat_keterangan = AlatBantu::with(['creator'])->where('kasus_id', $kasus->id)
        		->where('type', 'surat_keterangan')->orderBy('id', 'desc')->get();

        $data['dokter'] = User::where('profesi',1)->get();
        $data['surat_keterangan'] = $surat_keterangan;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.surat-keterangan.index', $data);
    }

    public function print($nomor_kasus, $id)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $surat_keterangan = AlatBantu::with(['creator', 'kasus'])->find($id);

        $data['surat_keterangan'] = $surat_keterangan;
        $data['val'] = json_decode($surat_keterangan->val);
        
        $dokter_merawat = $data['val']->dokter_merawat;
        $user_dokter = User::where('name', $dokter_merawat)->first();
        $data['nip'] = $user_dokter->employee ? $user_dokter->employee->nrp : '.......................................';

        $pdf = DOMPDF::loadView('kasus.alatbantu.surat-keterangan.print', $data, [])->setPaper('a4', 'landscape');
        return $pdf->stream('surat_keterangan.pdf');
    }
}
