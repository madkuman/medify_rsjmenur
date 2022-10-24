<?php

namespace App\Http\Controllers\Kasus\AlatBantu\MEWS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatMews;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $mews = AlatMews::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        foreach($mews as $item)
        {
            $item = $this->getText($item);
        }

        $data['mews'] = $mews;


        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.mews.index',$data);
    }

    private function getText($data)
    {
        if($data->resp == -3) $data->resp_text = '<= 8';
        else if($data->resp == -2) $data->resp_text = '-';
        else if($data->resp == -1) $data->resp_text = '9 - 11';
        else if($data->resp == 0) $data->resp_text = '12 - 20';
        else if($data->resp == 1) $data->resp_text = '-';
        else if($data->resp == 2) $data->resp_text = '21-24';
        else if($data->resp == 3) $data->resp_text = '>=25';

        if($data->o2 == -3) $data->o2_text = '<91';
        else if($data->o2 == -2) $data->o2_text = '92 - 93';
        else if($data->o2 == -1) $data->o2_text = '94 - 95';
        else if($data->o2 == 0) $data->o2_text = '> 96';
        else if($data->o2 == 1) $data->o2_text = '-';
        else if($data->o2 == 2) $data->o2_text = '-';
        else if($data->o2 == 3) $data->o2_text = '-';

        if($data->suplo2 == -3) $data->suplo2_text = '-';
        else if($data->suplo2 == -2) $data->suplo2_text = 'Yes';
        else if($data->suplo2 == -1) $data->suplo2_text = '-';
        else if($data->suplo2 == 0) $data->suplo2_text = 'No';
        else if($data->suplo2 == 1) $data->suplo2_text = '-';
        else if($data->suplo2 == 2) $data->suplo2_text = '-';
        else if($data->suplo2 == 3) $data->suplo2_text = '-';    

        if($data->sys == -3) $data->sys_text = '<90';
        else if($data->sys == -2) $data->sys_text = '91 - 100';
        else if($data->sys == -1) $data->sys_text = '101 - 110';
        else if($data->sys == 0) $data->sys_text = '111 - 219';
        else if($data->sys == 1) $data->sys_text = '-';
        else if($data->sys == 2) $data->sys_text = '-';
        else if($data->sys == 3) $data->sys_text = '>= 220';

        if($data->pulse == -3) $data->pulse_text = '<= 40';
        else if($data->pulse == -2) $data->pulse_text = '-';
        else if($data->pulse == -1) $data->pulse_text = '41 - 50';
        else if($data->pulse == 0) $data->pulse_text = '51 - 90';
        else if($data->pulse == 1) $data->pulse_text = '91 - 110';
        else if($data->pulse == 2) $data->pulse_text = '111 - 130';
        else if($data->pulse == 3) $data->pulse_text = '>= 131';

        if($data->avpu == -3) $data->avpu_text = '-';
        else if($data->avpu == -2) $data->avpu_text = '-';
        else if($data->avpu == -1) $data->avpu_text = '-';
        else if($data->avpu == 0) $data->avpu_text = 'Alert';
        else if($data->avpu == 1) $data->avpu_text = '-';
        else if($data->avpu == 2) $data->avpu_text = '-';
        else if($data->avpu == 3) $data->avpu_text = 'VPU';

        if($data->temp == -3) $data->temp_text = '<=35';
        else if($data->temp == -2) $data->temp_text = '-';
        else if($data->temp == -1) $data->temp_text = '35.1 - 36';
        else if($data->temp == 0) $data->temp_text = '36.1 - 38';
        else if($data->temp == 1) $data->temp_text = '38.1 - 39';
        else if($data->temp == 2) $data->temp_text = '>= 39.1';
        else if($data->temp == 3) $data->temp_text = '-';


        $data->resp = abs($data->resp);
        $data->o2 = abs($data->o2);
        $data->suplo2 = abs($data->suplo2);
        $data->sys = abs($data->sys);
        $data->pulse = abs($data->pulse);
        $data->avpu = abs($data->avpu);
        $data->temp = abs($data->temp);
    }

}
