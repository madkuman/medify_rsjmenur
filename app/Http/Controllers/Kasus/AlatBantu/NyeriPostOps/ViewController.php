<?php

namespace App\Http\Controllers\Kasus\AlatBantu\NyeriPostOps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatNyeriPostOps;

define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $nyeri = AlatNyeriPostOps::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        foreach($nyeri as $item)
        {
            $item = $this->getText($item);
        }

        $data['nyeri'] = $nyeri;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.nyeri-post-ops.index',$data);
    }

    private function getText($data)
    {
        if($data->ekspresi == 1) $data->ekspresi_text = 'Relaks/santai';
        else if($data->ekspresi == 2) $data->ekspresi_text = 'Sedikit mengerut, misal mengerutkan dahi';
        else if($data->ekspresi == 3) $data->ekspresi_text = 'Mengerut secara penuh, misal hingga menutup kelopak mata';
        else $data->ekspresi_text = 'Meringis';

        if($data->movement == 1) $data->movement_text = 'Tidak ada pergerakan';
        else if($data->movement == 2) $data->movement_text = 'Sedikit membungkuk';
        else if($data->movement == 3) $data->movement_text = 'Membungkuk penuh dengan fleksi pada jari';
        else $data->movement_text = 'Retraksi permanen';

        if($data->ventilator == 1) $data->ventilator_text = 'Pergerakan yang menoleransi';
        else if($data->ventilator == 2) $data->ventilator_text = 'Batuk dengan pergerakan';
        else if($data->ventilator == 3) $data->ventilator_text = 'Melawan ventilator';
        else $data->ventilator_text = 'Tidak mampu mengontrol ventilator';
    }
}
