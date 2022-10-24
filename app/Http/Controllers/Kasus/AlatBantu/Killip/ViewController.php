<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Killip;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatKillip;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $killip = AlatKillip::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        foreach($killip as $item)
        {
            $item = $this->getText($item);
        }
        $data['killip'] = $killip;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.killip.index',$data);
    }

    private function getText($data)
    {
        if($data->class == 'class I'){
        	$data->class_text = 'Tidak ada tanda-tanda gagal jantung';
        	$data->mortality = '<6%';
        }
        else if($data->class == 'class II'){
        	$data->class_text = 'Suara tidak normal (rales, crackles) di paru-paru, terdapat S3';
        	$data->mortality = '<17%';
        }
        else if($data->class == 'class III'){
        	$data->class_text = 'Edema paru-paru';
        	$data->mortality = '30-40%';
        }
        else if($data->class == 'class IV'){
        	$data->class_text = 'Syok kardiogenik';
        	$data->mortality = '60-80%';
        }
    }
}
