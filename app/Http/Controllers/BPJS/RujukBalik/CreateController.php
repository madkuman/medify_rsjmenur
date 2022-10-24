<?php

namespace App\Http\Controllers\BPJS\RujukBalik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\RujukBalik;
use App\Models\ThirdParty\RujukBalikDetail;

class CreateController extends Controller
{
    public function create($param)
    {
        if(is_array($param)) $param = (object) $param;

        $data = new RujukBalik();
        $data->pasien_id = $param->pasien_id;
        $data->no_sep = $param->no_sep;
        $data->no_kartu = $param->no_kartu;
        $data->no_surat_rujuk_balik = $param->no_surat_rujuk_balik;
        $data->kode_program_prb = $param->kode_program_prb;
        $data->program_prb = $param->program_prb;
        $data->kode_dpjp = $param->kode_dpjp;
        $data->dpjp = $param->dpjp;
        $data->alamat_peserta = $param->alamat_peserta;
        $data->nama_peserta = $param->nama_peserta;
        $data->email_peserta = $param->email_peserta;
        $data->keterangan = $param->keterangan;
        $data->saran = $param->saran;
        $data->plain_response = $param->plain_response;

        $data->save();
        if(is_array($param->obat))
        foreach($param->obat as $item){
            $data_detail = new RujukBalikDetail();
            $data_detail->rujuk_balik_id = $data->id;
            $data_detail->kode_obat = $item['kode_obat'];
            $data_detail->nama_obat = $item['nama_obat'];
            $data_detail->jumlah = $item['jumlah'];
            $data_detail->signa1 = $item['signa1'];
            $data_detail->signa2 = $item['signa2'];
            $data_detail->save();
        }


        return $data;
    }
}
