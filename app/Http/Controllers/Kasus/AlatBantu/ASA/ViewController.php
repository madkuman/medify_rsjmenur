<?php

namespace App\Http\Controllers\Kasus\AlatBantu\ASA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatAsa;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $asa = AlatAsa::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        foreach($asa as $item)
        {
            $item = $this->getText($item);
        }
        $data['asa'] = $asa;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.asa.index',$data);
    }

    private function getText($data)
    {
        if($data->class == 'P1') $data->class_text = 'Pasien sehat';
        else if($data->class == 'P2') $data->class_text = 'Pasien dengan penyakit sistemik ringan';
        else if($data->class == 'P3') $data->class_text = 'Pasien dengan penyakit sistemik akut';
        else if($data->class == 'P4') $data->class_text = 'Pasien dengan penyakit sistemik akut yang mengancam kelangsungan hidup';
        else if($data->class == 'P5') $data->class_text = 'Pasien hampir mati, tidak akan bertahan tanpa operasi';
        else if($data->class == 'P6') $data->class_text = 'Pasien mati otak';
    }
}
