<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SKDirawat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\KetKelahiran;
use Carbon\Carbon;
use DOMPDF;

define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);
define('keterangan',['creator','dokter','perawat']);
class ViewController extends Controller
{
    
    public function print($nomor_kasus)
    {   
    	$data['today'] = Carbon::today()->toDateString();
        $data['kasus'] = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $pdf = DOMPDF::loadView('kasus.alatbantu.sk-dirawat.print', $data)->setPaper('a5');
        return $pdf->stream('print.pdf');
    }
}
