<?php

namespace App\Http\Controllers\RawatInap\TempatTidur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\TempatTidur;

class EditController extends Controller
{
    public function setHitungStatistikByBangsal($bangsal_id, $is_hitung_statistik)
    {
        $ruangan = Ruangan::where('bangsal_id',$bangsal_id)->get();
        foreach ($ruangan as $item) {
            $this->setHitungStatistikByRuangan($item->id, $is_hitung_statistik);
        }
    }

    public function setHitungStatistikByRuangan($ruangan_id, $is_hitung_statistik)
    {
        $tempat_tidur = TempatTidur::where('ruangan_id', $ruangan_id)->get();
        foreach ($tempat_tidur as $item) {
            $this->setHitungStatistik($item->id, $is_hitung_statistik);
        }
    }

    public function setHitungStatistik($tempat_tidur_id, $is_hitung_statistik)
    {
        $tempat_tidur = TempatTidur::find($tempat_tidur_id);
        if ($tempat_tidur == null) {
            return false;   
        }
        $tempat_tidur->is_hitung_statistik = $is_hitung_statistik;
        $tempat_tidur->save();
    }
}
