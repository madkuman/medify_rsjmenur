<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;
use App\Models\Hospital\Lokasi;
use App\Models\Pasien\PembayaranPerusahaanType;

class HelperDataController extends Controller
{
    public function getAsalPelayanan()
    {
        $lokasi_beauty = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap','rawat-jalan','igd']);
        return $lokasi_beauty;
    }

    public function getJenisResep()
    {
        $data = [];
        $temp = new \stdClass();
        $temp->nama = 'Semua';
        $temp->slug = 'all';
        $data[] = $temp;

        $temp = new \stdClass();
        $temp->nama = 'Racikan';
        $temp->slug = 'racikan';
        $data[] = $temp;

        $temp = new \stdClass();
        $temp->nama = 'Non Racikan';
        $temp->slug = 'non-racikan';
        $data[] = $temp;

        return $data;
    }

    public function processLokasi($value)
    {
        if($value == 'all-igd' || $value == 'all-ri' || $value == 'all-rj'){
            if($value == 'all-igd') $value = 'igd';
            else if($value == 'all-ri') $value = 'rawat-inap';
            else if($value == 'all-rj') $value = 'rawat-jalan';
            $data = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug($value)->pluck('id')->toArray();
        }
        else if($value == 'all')
        {
            $data = Lokasi::get()->pluck('id')->toArray();
        }
		
        else $data = explode(",",$value);

        return $data;
    }

    public function lokasiDepartemen()
    {
        $data['igd'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('igd')->pluck('id')->toArray();
        $data['rawat-jalan'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-jalan')->pluck('id')->toArray();
        $data['rawat-inap'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-inap')->pluck('id')->toArray();
        $data['lainnya'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlugExcept(['igd','rawat-inap','rawat-jalan'])->pluck('id')->toArray();
        return $data;
    }

    public function processFarmasi($value)
    {
        if(empty($value)) $data = Farmasi::get()->pluck('id')->toArray();
        else $data = $value;
        return $data;
    }

    public function processResepJenis($value)
    {
        if(empty($value)) return '0,1';
        elseif($value =='racikan') return 1;
        elseif($value =='all') return '0,1';
        else return 0;
    }

    public function processAsuransi($value)
    {
        if(empty($value)) $data = PembayaranPerusahaanType::orderBy('nama')->get()->pluck('id')->toArray();
        else $data = $value;
        
        return $data;
    }
}
