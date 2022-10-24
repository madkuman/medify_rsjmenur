<?php

namespace App\Http\Controllers\Gizi\Pengaturan\KodeDiet;

use App\Models\Gizi\DietKode;
use App\Models\Gizi\PivotDiet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        $status = 'pengaturan';
        return view('gizi.pengaturan.content.kodediet.index',['status'=>$status]);
    }

    public function single($kode_diet_id)
    {
        $status = 'pengaturan';
        $data['kode_diet']=DietKode::where('id',$kode_diet_id)->with(['bentuk_makanan','kategori_makanan','jenis_makanan','diet'])->first();
        return view('gizi.pengaturan.content.kodediet.single',['data'=>$data,'status'=>$status]);
    }
}
