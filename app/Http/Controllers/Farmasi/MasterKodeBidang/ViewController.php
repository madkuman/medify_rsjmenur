<?php

namespace App\Http\Controllers\Farmasi\MasterKodeBidang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\MasterKodeBidang;

class ViewController extends Controller
{
    public function index($farmasi_slug)
    {
        $master_kode_bidang = MasterKodeBidang::with('parent')->get();
        $data['sidebar_active'] = "master_kode_bidang";
        $data['master_kode_bidang'] = $master_kode_bidang;
        return view('farmasi.master-kode-bidang.index',$data);
    }
}
