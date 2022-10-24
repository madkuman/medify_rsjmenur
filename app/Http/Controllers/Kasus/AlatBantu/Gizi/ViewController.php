<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Gizi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatGizi;


class ViewController extends Controller
{
    public function index($nomor_kasus)
    {   
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        

        $data['gizi'] = $this->getData($kasus->id);


        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.gizi.index',$data);
    }

    public function getData($kasus_id)
    {
        $gizi = AlatGizi::with(['creator'])->where('kasus_id',$kasus_id)->orderBy('id','desc')->get();
        
        foreach($gizi as $item)
        {
            $item = $this->getText($item);
        }

        return $gizi;
    }

    private function getText($data)
    {   
        if($data->kurus == 0) $data->kurus_text = 'Tidak';
        else if($data->kurus == 1) $data->kurus_text = 'Ya';

        if($data->kondisi_lain == 0) $data->kondisi_lain_text = 'Tidak';
        else if($data->kondisi_lain == 1) $data->kondisi_lain_text = 'Ya';

        if($data->malnutrisi == 0) $data->malnutrisi_text = 'Tidak';
        else if($data->malnutrisi == 1) $data->malnutrisi_text = 'Ya';

        if($data->asupan_turun == 0) $data->asupan_turun_text = 'Tidak';
        else if($data->asupan_turun == 1) $data->asupan_turun_text = 'Ya';

        if($data->turun_bb_anak == 0) $data->turun_bb_anak_text = 'Tidak';
        else if($data->turun_bb_anak == 1) $data->turun_bb_anak_text = 'Ya';
   
        if($data->turun_bb == '0') $data->turun_bb_text = 'Tidak';
        else if($data->turun_bb == '1') $data->turun_bb_text = 'Penurunan 1 - 5 kg';
        else if($data->turun_bb == '3') $data->turun_bb_text = 'Penurunan 11 - 15 kg';
        else if($data->turun_bb == '4') $data->turun_bb_text = 'Penurunan > 15 kg';
        else if($data->turun_bb == '2') $data->turun_bb_text = 'Penuruan 6 - 10 kg';

        if($data->asupan_kebidanan == 0) $data->asupan_kebidanan_text = 'Tidak';
        else if($data->asupan_kebidanan == 1) $data->asupan_kebidanan_text = 'Ya';

        if($data->gangguan_metabolisme == 0) $data->gangguan_metabolisme_text = 'Tidak';
        else if($data->gangguan_metabolisme == 1) $data->gangguan_metabolisme_text = 'Ya';

        if($data->bb_kebidanan == 0) $data->bb_kebidanan_text = 'Tidak';
        else if($data->bb_kebidanan == 1) $data->bb_kebidanan_text = 'Ya';

        if($data->hb_hct == 0) $data->hb_hct_text = 'Tidak';
        else if($data->hb_hct == 1) $data->hb_hct_text = 'Ya';
    }

}
