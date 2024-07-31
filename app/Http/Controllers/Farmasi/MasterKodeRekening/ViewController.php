<?php

namespace App\Http\Controllers\Farmasi\MasterKodeRekening;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\MasterKodeRekening;

class ViewController extends Controller
{
    public function index($farmasi_slug)
    {
        $master_kode_rekening = MasterKodeRekening::with('parent')->get();
        $data['sidebar_active'] = "master_kode_rekening";
        $data['master_kode_rekening'] = $master_kode_rekening;
        return view('farmasi.master-kode-rekening.index',$data);
    }
}
