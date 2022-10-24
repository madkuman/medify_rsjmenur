<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SKTerbang;

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
    
    public function print($nomor_kasus, Request $request)
    {   
		$data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getSingle($request->ttd2);
        $data['kasus'] = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $pdf = DOMPDF::loadView('kasus.alatbantu.sk-terbang.print', $data);
        return $pdf->stream('print.pdf');
    }
}
