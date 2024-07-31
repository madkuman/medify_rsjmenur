<?php

namespace App\Http\Controllers\Kasus\Asesmen\FormTriage;

use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use MPDF;
use DOMPDF;

define('relasi', ["lokasi.lokasi.departemen", "identitas", "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
  public function print($nomor_kasus, $id)
  {
    $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
    $data['asesmen'] = AlatBantu::where('type', 'rsj-menur-rm-04-1-form-triage')->where('id', $id)->first();
    $data['kasus'] = $kasus;
    $data['slug'] = 'rsj-menur-rm-04-1-form-triage';
    $data['action'] = 'print';
    $data['id'] = $id;
    $data['hasil_data'] = json_decode($data['asesmen']->val);
    $pdf = DOMPDF::loadView('kasus.datamedis.content.asesmenawal.print.print-form-triage',$data);
    return $pdf->stream('print', $data);
  }
}