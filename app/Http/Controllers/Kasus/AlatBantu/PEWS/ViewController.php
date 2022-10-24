<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PEWS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatPews;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $pews = AlatPews::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        foreach($pews as $item)
        {
            $item = $this->getText($item);
        }

        $data['pews'] = $pews;


        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.pews.index',$data);
    }

    private function getText($data)
    {
        if($data->respirasi == 0) $data->respirasi_text = 'Normal, tidak ada retraksi';
        else if($data->respirasi == 1) $data->respirasi_text = '>10 di atas normal, penggunaan otot bantu napas atau O2 30% atau 3 L/menit';
        else if($data->respirasi == 2) $data->respirasi_text = '>20 di atas normal, retraksi atau O2 30% atau 6 L/men';
        else if($data->respirasi == 3) $data->respirasi_text = '≥5 di bawah normal dengan retraksi, merintih atau O2 50% atau 8 L/menit';

        if($data->perilaku == 0) $data->perilaku_text = 'Bermain/sesuai';
        else if($data->perilaku == 1) $data->perilaku_text = 'Tidur';
        else if($data->perilaku == 2) $data->perilaku_text = 'Iritabel';
        else if($data->perilaku == 3) $data->perilaku_text = 'Letargi/bingung atau berkurangnya respons terhadap nyeri';

        if($data->vaskular == 0) $data->vaskular_text = 'Merah jambu atau waktu pengisian kapiler 1-2 detik';
        else if($data->vaskular == 1) $data->vaskular_text = 'Pucat atau waktu pengisian kapiler 3 detik';
        else if($data->vaskular == 2) $data->vaskular_text = 'Abu-abu atau waktu pengisian kapiler 4 detik atau takikardia >20 laju normal';
        else if($data->vaskular == 3) $data->vaskular_text = 'Abu-abu atau mottled atau waktu pengisian kapiler ≥5 detik atau takikardia >30 laju normal atau bradikardi';   
    }

}
