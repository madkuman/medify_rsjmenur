<?php

namespace App\Http\Controllers\BPJS\RujukBalik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\RujukBalik;
use App\Models\ThirdParty\RujukBalikDetail;

class EditController extends Controller
{
    public function edit($id , $param)
    {
        if(is_array($param)) $param = (object) $param;

        $data = RujukBalik::find($id);
        $data->keterangan = $param->keterangan;
        $data->saran = $param->saran;

        $data->save();

        foreach($data->detail as $item){
            $item->delete();
        }

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
    public function updateFromVclaim($id, $param)
    {
        if(is_array($param)) $param = (object) $param;

        $data = RujukBalik::find($id);
        $data->kode_dpjp = $param->DPJP->kode;
        $data->dpjp = $param->DPJP->nama;
        $data->keterangan = $param->keterangan;
        $data->saran = $param->saran;
        $data->no_surat_rujuk_balik = $param->noSRB;
        $data->alamat_peserta = $param->peserta->alamat;
        $data->nama_peserta = $param->peserta->nama;
        $data->email_peserta = $param->peserta->email;
        $data->plain_response = json_encode($param);
        $data->kode_program_prb = $param->programPRB->kode;
        $data->program_prb = $param->programPRB->nama;
        $data->no_kartu = $param->peserta->noKartu;
        $data->tanggal_surat_rujuk_balik = $param->tglSRB;
        $data->save();

        // foreach($data->detail as $item){
        //     $item->delete();
        // }
        // foreach($param->obat->list as $item){
        //     $data_detail = new RujukBalikDetail;
        //     $data_detail->rujuk_balik_id = $data->id;
        //     $data_detail->nama_obat = $item->nmObat;
        //     $data_detail->kode_obat = $item['kode_obat'];
        //     $data_detail->jumlah = $item->jmlObat;
        //     $explode_signa = explode("x", $item->signa);
        //     $data_detail->signa1 = trim($explode_signa[0] ?? '');
        //     $data_detail->signa2 = trim($explode_signa[1] ?? '');
        //     $data_detail->save();
        // }

        return $data;
    }

    // API GET BY NOMOR
    public function saveFromApi($response)
    {
        $content_data = json_decode($response);
        if($content_data->metaData->code == 200){
            $srb = $content_data->response->prb;

            $detail = [];
            foreach($srb->obat->obat as $item){
                $detail[] = [
                    'kode_obat' => $item->kdObat,
                    'nama_obat' => $item->nmObat,
                    'jumlah'    => $item->jmlObat,
                    'signa1'    => $item->signa1,
                    'signa2'    => $item->signa2,
                ];
            }

            $data = RujukBalik::where('no_surat_rujuk_balik', $srb->noSRB)->first();
            if($data == null){
                $data = new RujukBalik;
            }

            $data->pasien_id = null;
            $data->no_sep = $srb->noSEP;
            $data->no_kartu = $srb->peserta->noKartu;
            $data->no_surat_rujuk_balik = $srb->noSRB;
            $data->kode_program_prb = $srb->programPRB->kode;
            $data->program_prb = $srb->programPRB->nama;
            $data->kode_dpjp = $srb->DPJP->kode;
            $data->dpjp = $srb->DPJP->nama;
            $data->alamat_peserta = $srb->peserta->alamat;
            $data->nama_peserta = $srb->peserta->nama;
            $data->email_peserta = $srb->peserta->email;
            $data->keterangan = $srb->keterangan;
            $data->saran = $srb->saran;
            $data->plain_response = $response;
            $data->tanggal_surat_rujuk_balik = $srb->tglSRB;
            $data->status_vclaim = 1;

            $data->save();

            foreach($data->detail as $item){
                $item->delete();
            }
    
            foreach($detail as $item){
                $data_detail = new RujukBalikDetail;
                $data_detail->rujuk_balik_id = $data->id;
                $data_detail->kode_obat = $item['kode_obat'];
                $data_detail->nama_obat = $item['nama_obat'];
                $data_detail->jumlah = $item['jumlah'];
                $data_detail->signa1 = $item['signa1'];
                $data_detail->signa2 = $item['signa2'];
                $data_detail->save();
            }


            $data->load('detail');

            return $data;
        }else{
            return null;
        }
    }
}
