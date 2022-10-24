<?php

namespace App\Http\Controllers\Kasus\AlatBantu\MonitoringVentilator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Session;


define('relasi', []);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $master_vap = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)
                ->where('type', 'master-vap')->with('children.creator')->orderBy('id','desc')->get();
        $vap_audit = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)
                ->where('type', 'vap-audit')->orderBy('id','desc')->get();
        $data['vap_audit'] = $vap_audit;
        $data['is_ipcn'] = Session('is_ipcn');
        
        $data['master_vap'] = $master_vap;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.monitoring-ventilator.index', $data);
    }
}
