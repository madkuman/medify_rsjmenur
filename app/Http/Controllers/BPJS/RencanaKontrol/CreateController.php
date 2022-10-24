<?php

namespace App\Http\Controllers\BPJS\RencanaKontrol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\RencanaKontrol;

class CreateController extends Controller
{
    public function create($dataArr, $response)
    {
        $data = (object) $dataArr;
        if($data->kasus_id == 0) $data->kasus_id = null;
        if($data->pasien_id == 0) $data->pasien_id = null;
        
        $rk = new RencanaKontrol();
        $rk->no_sk = $response->noSuratKontrol ?? $response->noSPRI;
        $rk->no_sep = $data->jenis_kontrol == 2 ? $data->no_sep : null;
        $rk->no_kartu = $response->noKartu;
        $rk->pasien_id = $data->pasien_id ?? NULL;
        $rk->nama_pasien = $response->nama;
        $rk->kasus_id = $data->kasus_id ?? NULL;
        $rk->jenis_kontrol = $data->jenis_kontrol ?? 2;
        $rk->kode_poli = $data->kode_poli;
        $rk->nama_poli = $data->nama_poli;
        $rk->kode_dokter = $data->kode_dokter;
        $rk->nama_dokter = $response->namaDokter ?? NULL;
        $rk->tgl_rk = $response->tglRencanaKontrol ?? $data->tgl_rk;
        $rk->created_by = $data->user_id;

        $rk->save();
    }
}
