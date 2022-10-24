<?php

namespace App\Http\Controllers\Kepegawaian\MasterHariKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterHariKerja;

class ReadController extends Controller
{
    public function getHariKerjaArray()
    {  
        $hari_kerja = MasterHariKerja::get();
        $hari_array = [];
        foreach($hari_kerja as $hari){
            if($hari->nama == 'Senin') $number = 1;
            else if($hari->nama == 'Selasa') $number = 2;
            else if($hari->nama == 'Rabu') $number = 3;
            else if($hari->nama == 'Kamis') $number = 4;
            else if($hari->nama == 'Jumat') $number = 5;
            else if($hari->nama == 'Sabtu') $number = 6;
            else if($hari->nama == 'Minggu') $number = 7;


            $hari_array[$number] = $hari->status;
        }

        return $hari_array;

    }
}
