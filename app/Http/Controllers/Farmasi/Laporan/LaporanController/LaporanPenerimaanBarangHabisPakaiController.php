<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use App\Models\Farmasi\Pengadaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanPenerimaanBarangHabisPakaiController extends Controller
{
    public function get($request,$item_template_ids,$supplier_ids)
    {
        $date_start = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
        $date_end = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();
        $sumber_dana_id = $request->sumber_dana_id;
        $katalog_id = $request->katalog_id;
        $data['data'] = Pengadaan::whereBetween('created_at',[$date_start,$date_end])
        ->when($katalog_id, function ($query, $katalog_id) {
            return $query->where('katalog_id', $katalog_id);
        })
        ->when($sumber_dana_id, function ($query, $sumber_dana_id) {
            return $query->where('sumber_dana_id', $sumber_dana_id);
        })
        ->whereIn('supplier_id',$supplier_ids)
            ->whereHas('log', function($res) use ($item_template_ids){
                $res->whereHas('detail_item', function($item) use ($item_template_ids){
                    $item->whereHas('item_farmasi', function($item_farmasi) use ($item_template_ids){
                        $item_farmasi->whereIn('item_template_id',$item_template_ids);
                    });
                });
            })
            ->with(['supplier_detail','sumber_dana','katalog','log.detail_item.item_farmasi.item_template' =>function($q) use($item_template_ids){
                $q->whereIn('id',$item_template_ids);
            }])->get();
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
        return $data;
    }
}
