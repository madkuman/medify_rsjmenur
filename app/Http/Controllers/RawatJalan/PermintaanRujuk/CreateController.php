<?php

namespace App\Http\Controllers\RawatJalan\PermintaanRujuk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\PermintaanRujuk;
use Auth;

class CreateController extends Controller
{
    public function create($data)
    {
        $poli = explode(',', $data->poli_tujuan_id);
        foreach($poli as $item){
            $rujuk = new PermintaanRujuk;
            $rujuk->kasus_id = $data->kasus_id;
            $rujuk->pasien_id = $data->pasien_id;
            $rujuk->buat_kasus_baru = $data->buat_kasus_baru;
            $rujuk->type = $data->rujuktype;
            $rujuk->poli_tujuan_id = $item;
            $rujuk->poli_asal_id = $data->poli_asal_id;
            $rujuk->keterangan = $data->keterangan;
            $rujuk->created_by = Auth::user()->id;
            $rujuk->save();
        }
        return $rujuk;
    }
}
