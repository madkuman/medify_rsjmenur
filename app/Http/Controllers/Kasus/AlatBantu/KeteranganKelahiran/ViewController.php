<?php

namespace App\Http\Controllers\Kasus\AlatBantu\KeteranganKelahiran;

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
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
        $data['perawat'] = app('App\Http\Controllers\Users\ReadController')->getDokterDanPerawat();
        $data['sidebar_active'] = 'alat';
        $data['istri_dari'] = '-';
        if($kasus->pasien->relatives_type == 1)
        {
            $data['istri_dari'] = $kasus->pasien->wali->name ?? '-';
        }
        if(isset($kasus->pasien->wali->tni_keanggotaan) )
        {
            $data['pangkat'] = $kasus->pasien->wali->tni_pangkat->nama ?? '-';
            $data['kesatuan'] = $kasus->pasien->wali->tni_satker->nama ?? '-';
        }
        else
        {               
            $data['pangkat'] = '-';
            $data['kesatuan'] = '-';
        }
        $data['ket'] = KetKelahiran::with(keterangan)->where('kasus_id',$kasus->id)->get();
        return view('kasus.alatbantu.ket-kelahiran.index',$data);
    }

    public function print($nomor_kasus,$id)
    {   
        $ket = KetKelahiran::find($id);
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['nama'] = $ket->nama_ibu;
        $data['no_rm'] = $kasus->pasien->no_rm;
        $data['suami'] = $ket->nama_ayah;
        $data['ket'] = $ket;
        if($ket->kelamin == 1)
        {
            $data['kelamin'] = 'Laki - Laki';
        }
        else
        {
            $data['kelamin'] = 'Perempuan';
        }
        $data['usia_ibu'] = $kasus->pasien->age ?? '-';
        // return view('kasus.alatbantu.ket-kelahiran.print-out',$data);
        $pdf = DOMPDF::loadView('kasus.alatbantu.ket-kelahiran.print-out',$data)->setPaper('legal');
        return $pdf->stream('print.pdf');
    }
}
