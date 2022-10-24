<?php

namespace App\Http\Controllers\RawatJalan\Poliklinik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\Ruangan;
use App\Models\RawatJalan\Dokter;
use Carbon\Carbon;

class ViewController extends Controller
{
    public function index(Request $request)
    {
    
        $poli_id = $request->poli_id;
        if(empty($poli_id)){
            $poliklinik = Poliklinik::first();
            $poli_id = $poliklinik->id;
        }
        $data['dokter'] = Dokter::with('jadwal')->whereHas('jadwal', function($q) use ($poli_id){
            $q->where('poliklinik_id', $poli_id);
        })->get();
      
        $data['dokter_id'] = 0;
        if (isset($request->dokter_id)) {
            $data['dokter_id'] = $request->dokter_id;
        }

    	$poli = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getPoli();
    	$poli =  json_decode($poli);
        $data['all_poli'] = $poli->data;
    	$data['routeFlag'] = 1;
        $antrians = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getAntrian($poli_id);
        $antrians_dokter = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getAntrianByDokter($poli_id, $data['dokter_id']);
        $data['poli_id'] = $poli_id;
        $poli = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getSinglePoli($poli_id);
        $poli =  json_decode($poli);
        if(empty($poli->data->id)) abort(404);
        $data['poli'] = $poli->data;

        $ruangan    = app('App\Http\Controllers\RawatJalan\DokterJadwal\ReadController')->getDokterRuangan($poli_id, $data['dokter_id']);
        $data['ruangan_id'] = $ruangan->id ?? -1;
        if($data['dokter_id'] == 0){
            $data['antrians'] = $antrians;
        } else {
            $data['antrians'] = $antrians_dokter;
        }

        foreach ($data['antrians'] as $antrian) {
            $data['master_tv'] = app('App\Http\Controllers\RawatJalan\MasterTv\ReadController')->getMasterTvByRuangan(($antrian->ruangan_poli->id ?? '-1'));
        }
    	return view('rawatjalan.poliklinik.index',$data);
    }

    public function create()
    {
    	$data['routeFlag'] = 1;
        return view('rawatjalan.poliklinik.create',$data);
    }
}
