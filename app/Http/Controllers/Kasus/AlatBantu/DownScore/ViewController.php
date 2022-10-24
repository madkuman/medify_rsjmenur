<?php

namespace App\Http\Controllers\Kasus\AlatBantu\DownScore;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatDownScore;

define('relasi', ['lokasi', 'admin', 'identitas', 'pembayaran', 'pasien', 'kelas', 'myRole', 'myRoleWithoutEnd']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {   
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $down_score = AlatDownScore::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        foreach($down_score as $item)
        {
            $item = $this->getText($item);
        }
        $data['down_score'] = $down_score;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.down-score.index',$data);
    }

    private function getText($data)
    {
        if($data->frekuensi_nafas == 0) $data->frekuensi_nafas_text = '<60x/mnt';
        else if($data->frekuensi_nafas == 1) $data->frekuensi_nafas_text = '60 - 80x/mnt';
        else if($data->frekuensi_nafas == 2) $data->frekuensi_nafas_text = '>80x/mnt';

        if($data->retraksi == 0) $data->retraksi_text = 'Tidak ada retraksi';
        else if($data->retraksi == 1) $data->retraksi_text = 'Retraksi ringan';
        else if($data->retraksi == 2) $data->retraksi_text = 'Retraksi berat';
       
        if($data->sianosis == 0) $data->sianosis_text = 'Tidak sianosis';
        else if($data->sianosis == 1) $data->sianosis_text = 'Sianosis hilang dengan O2';
        else if($data->sianosis == 2) $data->sianosis_text = 'Sianosis menetap walaupun dengan O2';

        if($data->air_entry == 0) $data->air_entry_text = 'Udara masuk bilateral baik';
        else if($data->air_entry == 1) $data->air_entry_text = 'Penurunan ringan udara masuk';
        else if($data->air_entry == 2) $data->air_entry_text = 'Tidak ada udara masuk';
        
        if($data->merintih == 0) $data->merintih_text = 'Tidak merintih';
        else if($data->merintih == 1) $data->merintih_text = 'Dapat di dengar dengan stetoskop';
        else if($data->merintih == 2) $data->merintih_text = 'Dapat di dengar tanpa alat bantu';

        if($data->score < 4) $data->score_text = 'Distres nafas ringan';
        else if($data->score > 4 && $data->score_text <= 7) $data->score_text = 'Distres nafas sedang';
        else if($data->score > 7) $data->score_text = 'Distres nafas berat';
    }
}
