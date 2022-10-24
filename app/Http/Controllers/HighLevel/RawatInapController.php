<?php

namespace App\Http\Controllers\HighLevel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RawatInapController extends Controller
{
    public function index()
    {
        $max_iterasi_bulan = 6;
        $day = Carbon::today();
        $awal_bulan = $day->copy()->startOfMonth()->toDateTimeString();
        $akhir_bulan = $day->copy()->endOfMonth()->toDateTimeString();
        $awal_bulan_lalu = $day->copy()->subMonth()->startOfMonth()->toDateTimeString();
        $akhir_bulan_lalu = $day->copy()->subMonth()->endOfMonth()->toDateTimeString();
        $awal_tahun = $day->copy()->startOfYear();

        $selisih_bulan = $day->copy()->diffInMonths($awal_tahun);
        if($selisih_bulan < $max_iterasi_bulan) $iterasi_bulan = $selisih_bulan;
        else $iterasi_bulan = 6;

        $layanan = 3;
        $bor =  app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$day->copy(),$iterasi_bulan,'bor');
        $avlos =  app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$day->copy(),$iterasi_bulan,'avlos');
        $toi =  app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$day->copy(),$iterasi_bulan,'toi');
        $bto =  app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$day->copy(),$iterasi_bulan,'bto');
        $ndr =  app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$day->copy(),$iterasi_bulan,'ndr');
        $gdr =  app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$day->copy(),$iterasi_bulan,'gdr');
        $d_igd =  app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$day->copy(),1,'distribusi-igd');
        $d_rj =  app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getStatistikRange('bulan',$day->copy(),1,'distribusi-rj');

        $data['bor'] = $this->transformArray($bor);
        $data['avlos'] = $this->transformArray($avlos);
        $data['toi'] = $this->transformArray($toi);
        $data['bto'] = $this->transformArray($bto);
        $data['ndr'] = $this->transformArray($ndr);
        $data['gdr'] = $this->transformArray($gdr);
        $data['distribusi_rj'] = $d_rj[0]->value ?? 0;
        $data['distribusi_igd'] = $d_igd[0]->value ?? 0;

        $index = $iterasi_bulan - 1;
        $data['bor_bulan_lalu'] = $bor[$index]->value ?? 0;
        $data['avlos_bulan_lalu'] = $avlos[$index]->value ?? 0;
        $data['toi_bulan_lalu'] = $toi[$index]->value ?? 0;
        $data['bto_bulan_lalu'] = $bto[$index]->value ?? 0;
        $data['ndr_bulan_lalu'] = $ndr[$index]->value ?? 0;
        $data['gdr_bulan_lalu'] = $gdr[$index]->value ?? 0;

        $data['bulan']= $day->format('m');
        $data['tahun']= $day->year;
        $data['bed'] =  app('App\Http\Controllers\RawatInap\Statistik\ReadController')->getBed();

        $data['sepuluhPenyakit'] = app('App\Http\Controllers\Pasien\Laporan\SepuluhBesarPenyakitController')->getRI('ri',$awal_bulan_lalu,$akhir_bulan_lalu)['dtds'];
        
        return view('highlevel.rawatinap', $data);
    }

    public function transformArray($data)
    {
        $total = count($data);
        $i = $total;

        $data_return = [];
        $last_date = Carbon::now();

        foreach($data as $item)
        {
            $i--;
            if(!empty($item))
            {
                $last_date = $item->start_date;
                $temp = new \stdClass();
                $temp->value = $item->value;
                $temp->date = $item->start_date->format('m');
                $data_return[$i] = $temp;
            }
            else
            {
                $temp = new \stdClass();
                $temp->value = 0;
                $temp->date = $last_date->subMonth()->format('m');
                $data_return[$i] = $temp;
            }

        }

        return $data_return;
    }
}
