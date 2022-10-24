<?php

namespace App\Http\Controllers\Admin\PendaftaranOnline\TarifKembali;

use App\Models\Hospital\MasterTarifKembali;
use App\Models\Keuangan\TarifMaster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        $data['master_tarif_kembali'] = app('App\Http\Controllers\Admin\PendaftaranOnline\TarifKembali\ReadController')->get();
        $data['tarif_master'] = TarifMaster::all();
        return view('admin.pendaftaran-online.tarif-kembali.index', $data);
    }

}
