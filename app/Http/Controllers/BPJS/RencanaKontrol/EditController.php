<?php

namespace App\Http\Controllers\BPJS\RencanaKontrol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\RencanaKontrol;

class EditController extends Controller
{
    public function edit($dataArr, $res)
    {
        $data = (object) $dataArr;

        $rk = RencanaKontrol::where('no_sk', ($res->noSuratKontrol ?? $res->noSPRI))->first();
        $rk->no_sk = ($res->noSuratKontrol ?? $res->noSPRI);
        $rk->kode_dokter = $data->kode_dokter;
        $rk->nama_dokter = $res->namaDokter;
        $rk->kode_poli = $data->kode_poli;
        $rk->nama_poli = $data->nama_poli;
        $rk->tgl_rk = $res->tglRencanaKontrol;
        $rk->updated_by = auth()->user()->id;

        $rk->save();
    }

    public function saveFromApi($data)
    {
        $data = (object) $data;

        $rk = RencanaKontrol::where('no_sk', ($data->noSuratKontrol ?? $data->noSPRI))->first();
        if($rk == null) $rk = new RencanaKontrol;

        $rk->no_sk = ($data->noSuratKontrol ?? $data->noSPRI);
        $rk->no_sep = $data->sep->noSep;
        $rk->no_kartu = $data->sep->peserta->noKartu;
        $rk->pasien_id = $data->pasien_id ?? NULL;
        $rk->kasus_id = $data->kasus_id ?? NULL;
        $rk->jenis_kontrol = $data->jnsKontrol ?? 2;
        $rk->kode_poli = $data->poliTujuan;
        $rk->kode_dokter = $data->kodeDokter;
        $rk->nama_dokter = $data->namaDokter;
        $rk->tgl_rk = $data->tglRencanaKontrol;
        $rk->created_at = $data->tglTerbit;
        $rk->created_by = auth()->user()->id;

        $rk->save();

        return $rk;
    }
}
