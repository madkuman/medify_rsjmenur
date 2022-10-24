<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Flacc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatFlacc;

define('relasi', ['lokasi', 'admin', 'identitas', 'pembayaran', 'pasien', 'kelas', 'myRole', 'myRoleWithoutEnd']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $flacc = AlatFlacc::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        foreach($flacc as $item)
        {
            $item = $this->getText($item);
        }
        $data['flacc'] = $flacc;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.flacc.index',$data);
    }

    private function getText($data)
    {
        if($data->wajah == 0) $data->wajah_text = 'Tidak ada ekspresi tertentu atau senyum';
        else if($data->wajah == 1) $data->wajah_text = 'Sesekali meringis atau mengerutkan kening, ditarik, tertarik';
        else if($data->wajah == 2) $data->wajah_text = 'Sering ke dagu bergetar konstan, rahang terkatup';

        if($data->kaki == 0) $data->kaki_text = 'Yang normal posisi atau santai';
        else if($data->kaki == 1) $data->kaki_text = 'Gelisah, gelisah, tegang';
        else if($data->kaki == 2) $data->kaki_text = 'Menendang atau kaki dibuat';

        if($data->aktivitas == 0) $data->aktivitas_text = 'Berbaring tenang, posisi normal, bergerak dengan mudah';
        else if($data->aktivitas == 1) $data->aktivitas_text = 'Menggeliat, pergeseran, bolak-balik, tegang';
        else if($data->aktivitas == 2) $data->aktivitas_text = 'Melengkung, kaku atau menyentak';

        if($data->menangis == 0) $data->menangis_text = 'Tidak ada teriakan (terjaga atau tertidur)';
        else if($data->menangis == 1) $data->menangis_text = 'Erangan atau merintih, sesekali keluhan';
        else if($data->menangis == 2) $data->menangis_text = 'Menangis terus, Jeritan atau isak tangis, keluhan asing';

        if($data->consolability == 0) $data->consolability_text = 'Konten, santai';
        else if($data->consolability == 1) $data->consolability_text = 'Diyakinkan oleh menyentuh sesekali, memeluk atau sedang berbicara dengan, distractible';
        else if($data->consolability == 2) $data->consolability_text = 'Sulit untuk konsol atau kenyamanan';

        if($data->score == 0) $data->score_text = 'Tidak ada rasa sakit';
        else if($data->score < 3) $data->score_text = 'Rasa sakit ringan';
        else if($data->score < 6) $data->score_text = 'Rasa sakit sedang';
        else if($data->score < 10) $data->score_text = 'Rasa sakit berat';

    }
}
