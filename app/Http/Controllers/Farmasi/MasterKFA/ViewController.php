<?php

namespace App\Http\Controllers\Farmasi\MasterKFA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\MasterKFA;

class ViewController extends Controller
{
    public function index($farmasi_slug)
    {
        $master_kode_bidang = MasterKFA::with('parent')->get();
        $data['sidebar_active'] = "master_kfa";
        $data['master_kfa'] = $master_kode_bidang;
        return view('farmasi.master-kfa', $data);
    }
}
