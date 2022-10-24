<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TimiStemi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatTimiStemi;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $stemi = AlatTimiStemi::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        foreach($stemi as $item)
        {
            $item = $this->getText($item);
        }
        $data['stemi'] = $stemi;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.timi-stemi.index',$data);
    }

    private function getText($data)
    {
        if($data->year_prob == 3) $data->year_prob_text = '>= 75 tahun';
        else if($data->year_prob == 2) $data->year_prob_text = '65-74 tahun';
        else $data->year_prob_text = '<65 tahun';

        if($data->dha_prob != 0) $data->dha_prob_text = 'Yes';
        else $data->dha_prob_text = 'No';

        if($data->systol_bp_prob != 0) $data->systol_bp_prob_text = 'Yes';
        else $data->systol_bp_prob_text = 'No';

        if($data->heartrate_prob != 0) $data->heartrate_prob_text = 'Yes';
        else $data->heartrate_prob_text = 'No';

        if($data->killip_prob != 0) $data->killip_prob_text = 'Yes';
        else $data->killip_prob_text = 'No';

        if($data->weight_prob != 0) $data->weight_prob_text = 'Yes';
        else $data->weight_prob_text = 'No';

        if($data->aste_prob != 0) $data->aste_prob_text = 'Yes';
        else $data->aste_prob_text = 'No';

        if($data->treat_time_prob != 0) $data->treat_time_prob_text = 'Yes';
        else $data->treat_time_prob_text = 'No';

        if($data->year_prob == 3) $data->year_prob_text = '>= 75 tahun';
        else if($data->year_prob == 2) $data->year_prob_text = '65-74 tahun';
        else $data->year_prob_text = '<65 tahun';

        if($data->score > 8) $data->mortality = '35.9%';
        else if($data->score > 7) $data->mortality = '26.8%';
        else if($data->score > 6) $data->mortality = '23.4%';
        else if($data->score > 5) $data->mortality = '16.1%';
        else if($data->score > 4) $data->mortality = '12.4%';
        else if($data->score > 3) $data->mortality = '7.3%';
        else if($data->score > 2) $data->mortality = '4.4%';
        else if($data->score > 1) $data->mortality = '2.2%';
        else if($data->score > 0) $data->mortality = '1.6%';
        else $data->mortality = '0.6%';
    }
}
