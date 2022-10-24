<?php

namespace App\Http\Controllers\Remunerasi\Dana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Remunerasi\Dana;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class CreateController extends Controller
{
    public function create(Request $req){

        $tanggal =  Carbon::createFromFormat('d-m-Y', $req->bulan_tahun)->format('Y-m-d');
        $bulan = Carbon::parse($req->bulan_tahun)->format('m');
        $tahun = Carbon::parse($req->bulan_tahun)->format('Y');

        $jumlah = preg_replace("/[^0-9]/", "", $req->jumlah);

        $data = Dana::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->first();

        if (empty($data)){
            $dana = new Dana;
        } else {
            $dana = Dana::find($data->id);
        }

        $dana->nominal = $jumlah;
        $dana->tanggal = $tanggal;
        $dana->save();

        if($dana){
            return json_encode([
                'number'=>200,
                'status'=>'Berhasil',
                'ket'=>'Berhasil menyimpan data'
            ]);
        } else {
            return json_encode([
                'number'=>400,
                'status'=>'Gagal',
                'ket'=>'Gagal menyimpan data'
            ]);
        }


    }
}