<?php

namespace App\Http\Controllers\RawatJalan\Dokter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Dokter;

class ReadController extends Controller
{
    public function getAll()
    {
    	return Dokter::get();
    }
    public function getId($id)
    {
    	return Dokter::find($id);
    }

    public function getByPoli($id)
    {
    	$dokter = Dokter::with('jadwal')->whereHas('jadwal', function($q) use ($id){
            $q->where('poliklinik_id', $id);
        })->get();

        $data = [];
        foreach($dokter as $row){
         
            $data[] = [
                "id" => $row->id,
                "text" => $row->name,
            ];
        }

        return json_encode($data);
    }

    public function getDokterByKodeDokter($kode, $kode_poli_bpjs = null)
    {
        $dokter = Dokter::where('bpjs_kode_dpjp', $kode);
        if(!empty($kode_poli_bpjs)){
            $dokter = $dokter->where('bpjs_poli', $kode_poli_bpjs);
        }
        return $dokter->first();
    }
}