<?php

namespace App\Http\Controllers\Admin\ThirdParty\SIRS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function pekerjaan()
    {
        if (!config('medify.third-party.sirs_v3.on')) return abort(404);
        
        $pekerjaan_sirs = app(\App\Http\Controllers\ThirdParty\SIRS\API\ReadController::class)->getAPIData('master-pekerjaan');
        $data['pekerjaan_sirs'] = $pekerjaan_sirs->pluck('nama', 'id');
        $data['pekerjaan_all'] = \App\Models\Pasien\JenisPekerjaan::get()->keyBy('id');
        return view('admin.sirs-v3.pekerjaan', $data);
    }

    public function statusKeluar()
    {
        if (!config('medify.third-party.sirs_v3.on')) return abort(404);

        $statuskeluar_sirs = app(\App\Http\Controllers\ThirdParty\SIRS\API\ReadController::class)->getAPIData('master-statuskeluar');
        $data['statuskeluar_sirs'] = $statuskeluar_sirs->pluck('nama', 'id');
        $data['statuskeluar_all'] = \App\Models\Hospital\MasterCaraPulang::get()->keyBy('id');
        return view('admin.sirs-v3.status-keluar', $data);
    }

    public function syncMasterData()
    {
        if (!config('medify.third-party.sirs_v3.on')) return abort(404);

        $data['api_list'] = app(\App\Http\Controllers\ThirdParty\SIRS\API\ReadController::class)->getAutoSyncStatus();
        return view('admin.sirs-v3.sync-master', $data);
    }
}
