<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\MasterKodeBidang;
use App\Models\Farmasi\MasterKodeRekening;
use Carbon\Carbon;

class LaporanBeritaAcaraPemeriksaanController extends Controller
{
    public function get($data)
    {
        if($data['jenis_dokumen'] == 'berita-acara') return $this->getBeritaAcara($data);
        else return $this->getLampiran($data);
    }

    private function getBeritaAcara($data)
    {
        if(empty($data['kode_rekening_id'])) $list_kode_rekening = MasterKodeRekening::get();
        else $list_kode_rekening = MasterKodeRekening::whereIn('id',$data['kode_rekening_id'])->get();
        $farmasi_ids = $data['farmasi_ids'];
        $start_date = Carbon::minValue();
        $end_date = $data['tanggal'];

        $data_kode_rekening = [];
        foreach($list_kode_rekening as $item_kode_rekening)
        {
            $item_template_ids = ItemsTemplate::where('kode_rekening_id',$item_kode_rekening->id)->pluck('id')->toArray();
            $nominal_total = 0;
            
            if(!empty($item_template_ids))
            {
                $data_item_templates = app(\App\Http\Controllers\Farmasi\Items\ReadController::class)->mutasiStokQuery($farmasi_ids, $start_date, $end_date, $item_template_ids);
                foreach($data_item_templates as $row)
                {
                    $nominal_current = $row->stok_akhir * $row->harga;
                    $nominal_total += $nominal_current;
                }
            }

            $temp = new \stdClass();
            $temp->kode = $item_kode_rekening->kode;
            $temp->nama = $item_kode_rekening->nama;
            $temp->nominal = $nominal_total;
            $data_kode_rekening[] = $temp;
        }

        return $data_kode_rekening;
    }

    private function getLampiran($data)
    {
        if(empty($data['kode_bidang_id'])) $list_kode_bidang = MasterKodeBidang::get();
        else $list_kode_bidang = MasterKodeBidang::whereIn('id',$data['kode_bidang_id'])->get();
        
        $farmasi_ids = $data['farmasi_ids'];
        $start_date = Carbon::minValue();
        $end_date = $data['tanggal'];

        $data_kode_bidang = [];
        $item_template_all= [];
        foreach($list_kode_bidang as $item_kode_bidang)
        {
            $item_template_ids = ItemsTemplate::where('kode_bidang_id',$item_kode_bidang->id)->pluck('id')->toArray();
            $item_template_all = array_unique(array_merge($item_template_all,$item_template_ids));
        }
        $data_item_templates = app(\App\Http\Controllers\Farmasi\Items\ReadController::class)->mutasiStokQuery($farmasi_ids, $start_date, $end_date, $item_template_all);

        foreach($list_kode_bidang as $item_kode_bidang)
        {
            $item_template_ids = ItemsTemplate::where('kode_bidang_id',$item_kode_bidang->id)->pluck('id')->toArray();
            $temp = new \stdClass();
            $temp->kode = $item_kode_bidang->kode;
            $temp->nama = $item_kode_bidang->nama;

            $item_template_list = [];
            foreach($item_template_ids as $item_template_id_single)
            {
                $data_item_template_single = $this->traverseItemTemplateData($data_item_templates,$item_template_id_single);
                $stok = $data_item_template_single->stok_akhir ?? 0;

                $item_template = ItemsTemplate::find($item_template_id_single);
                $temp_item_template = new \stdClass();
                $temp_item_template->id = $item_template->id;
                $temp_item_template->nama = $item_template->nama;
                $temp_item_template->satuan = $item_template->satuan;
                $temp_item_template->harga = $item_template->harga;
                $temp_item_template->jumlah = $stok;
                $item_template_list[] = $temp_item_template;

            }
            $temp->item_template_list = $item_template_list;
            $data_kode_bidang[] = $temp;
        }
        return $data_kode_bidang;
    }

    private function traverseItemTemplateData($data_item_templates,$item_template_id_single){
        $selected = new \stdClass();
        foreach($data_item_templates as $item_template){
            if($item_template->item_template_id == $item_template_id_single){
                $selected = $item_template;
                break;
            }
        }
        return $selected;
    }
}
