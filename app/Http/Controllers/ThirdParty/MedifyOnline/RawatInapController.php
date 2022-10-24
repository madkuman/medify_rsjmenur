<?php

namespace App\Http\Controllers\ThirdParty\MedifyOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\TempatTidur;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\Bangsal;
use App\Models\Hospital\Kelas;
use stdClass;

class RawatInapController extends Controller
{
    public function getKetersediaanBed()
    {
		app('debugbar')->disable();
        $bangsal = Bangsal::get();
        $kelas = Kelas::get();

        $data_return = [];
        foreach($bangsal as $bangsal_item)
        {
            $data_single_new = [];
            $data_single_new['nama'] = $bangsal_item->nama;
            foreach($kelas as $kelas_item)
            {
                $ruangan = Ruangan::where('bangsal_id',$bangsal_item->id)->where('kelas',$kelas_item->id)->pluck('id')->toArray();
                if(count($ruangan) > 0)
                {
                    $new_item_kelas = [];
                    $bed_kosong = TempatTidur::whereNull('transaksi_id')->whereIn('ruangan_id',$ruangan)->pluck('id')->toArray();
                    $bed_terisi = TempatTidur::whereNotNull('transaksi_id')->whereIn('ruangan_id',$ruangan)->pluck('id')->toArray();

                    $new_item_kelas['kelas'] = $kelas_item->nama;
                    $new_item_kelas['bed_kosong'] = count($bed_kosong);
                    $new_item_kelas['bed_terisi'] = count($bed_terisi);   
                    $new_item_kelas['bed_kapasitas'] = count($bed_terisi) + count($bed_kosong);

                    if($new_item_kelas['bed_kapasitas'] > 0)
                    {
                        $data_single_new['data'][] = $new_item_kelas;      
                    }   
                }
            }
            $data_return[] = $data_single_new;
        }

        return json_encode($data_return);
    }
}
