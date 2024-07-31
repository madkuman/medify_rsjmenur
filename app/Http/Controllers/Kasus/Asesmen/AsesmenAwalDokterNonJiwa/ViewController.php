<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenAwalDokterNonJiwa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use MPDF;
use DOMPDF;

define('relasi', ["lokasi.lokasi.departemen", "identitas", "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
  public function print($nomor_kasus, $id, $type)
  {
    $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
    $data['asesmen_get'] = AlatBantu::where('type', $type)->where('id', $id)->first();
    $data['kasus'] = $kasus;
    $data['jenis'] = $type;
    $data['slug'] = $type;
    $data['action'] = 'print';
    $data['id'] = $id;
    $data['asesmen'] = json_decode($data['asesmen_get']->val);
    $pdf = DOMPDF::loadView('kasus.datamedis.content.asesmenawal.non-jiwa.print',$data);
    return $pdf->stream('print', $data);
  }
}
