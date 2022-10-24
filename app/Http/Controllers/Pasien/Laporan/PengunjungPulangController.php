<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Kasus\Kasus;

class PengunjungPulangController extends Controller
{
    public function get($start,$end,$lokasi,$status){
        if($status == 1) $kelas = 'tipe_ri = 0';
        else $kelas = 'tipe_ri = 1';

        $sql_kasus_ids = "
            SELECT * FROM kasus WHERE id 
            IN (
                SELECT kasus.id FROM lokasi, kasus 
                WHERE kasus.id = lokasi.`kasus_id` 
                AND lokasi.lokasi_id IN (".implode(',',$lokasi).") 
            )
            AND ".$kelas."
            AND created_at >= '".$start->toDateTimeString()."'
            AND created_at <= '".$end->toDateTimeString()."'
            ;
        ";
                
        $data = DB::connection('kasus')->select($sql_kasus_ids);
        
        $kasus_ids = [];
        foreach($data as $item)
        {
            $kasus_ids[] = $item->id;
        }
        $kasus = Kasus::whereIn('id',$kasus_ids)->with('pasien','lokasi.lokasi','diagnosis.icd10')->get();
        
        return $kasus;

    }
}
