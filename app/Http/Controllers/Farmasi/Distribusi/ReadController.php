<?php

namespace App\Http\Controllers\Farmasi\Distribusi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Distribusi;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\ItemsFarmasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DateTime;
use stdClass;

define('relasi_distribusi', [
                    'transaksi_detail.log.detail_item.detail_item', 
                    'log.detail_item.detail_item.item_detail', 
                    'draft.item_farmasi.item_detail',
                    'distribusi_detail.draft.item_farmasi.item_detail',
                    'created_by_detail', 'verified_by_detail',
                    'detail_tujuan'
                ]);
class ReadController extends Controller
{
	public function getAll($farmasi_id, $request)
    {
        $distribusi = $this->all($farmasi_id, $request)->get();
        return $distribusi;
    }
    public function all($farmasi_id, $request)
    {
        $unit_tujuan = $request->unit_tujuan;
        if($unit_tujuan == "Semua Unit") $unit_tujuan = null;
        
        $jenis = $request->jenis;
        if($jenis == "Semua Jenis") $jenis = null;

        $distribusi = Distribusi::with(relasi_distribusi)->where('farmasi_id', $farmasi_id);

        if($unit_tujuan){
            $distribusi = $distribusi->where('unit_tujuan', $unit_tujuan);
        }

        if($request->tanggal_awal) {
            $tgl_awal = str_replace("/", "-", $request->tanggal_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
        } else $min_date = Carbon::minValue();

        if($request->tanggal_akhir){
            $tgl_akhir = str_replace("/", "-", $request->tanggal_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else $max_date = Carbon::maxValue();
        
        $distribusi = $distribusi->whereBetween('created_at', [$min_date, $max_date]);

        if(!is_null($request->status)) {
            $us = explode(',', $request->status);
            if(strlen($request->status) == 1) $distribusi = $distribusi->where('status', $request->status);
            else $distribusi = $distribusi->whereIn('status', $us);
        }

        if(!is_null($request->kategori)) {
            $us = explode(',', $request->kategori);
            if(strlen($request->kategori) == 1) $distribusi = $distribusi->where('tipe', $request->kategori);
            else $distribusi = $distribusi->whereIn('tipe', $us);
        }

        if($jenis) {
            $distribusi = $distribusi->where('kategori', $jenis);
        }

        $distribusi = $distribusi->latest();
        return $distribusi;
    }

    public function getAllMasuk($farmasi_id) //berupa penerimaan dari upf lain
    {
        $distribusi = Distribusi::with(relasi_distribusi)->where('farmasi_id', $farmasi_id)->where('kategori','Permintaan')->latest()->get();

        return $distribusi;
    }

    public function getAllKirim($farmasi_id) //berupa pengiriman ke upf lain
    {
        $distribusi = Distribusi::with(relasi_distribusi)->where('farmasi_id', $farmasi_id)->where('kategori','Kiriman')->latest()->get();

        return $distribusi;
    }

    public function getSingle($slug)
    {
        $distribusi = Distribusi::with(relasi_distribusi)->where('slug',$slug)->first();
        return $distribusi;
    }

    public function getPengadaanBySupplier($supplier_id)
    {
        $pengadaan = Pengadaan::where('supplier_id', $supplier_id)->latest()->get();

        return $pengadaan;
    }

    public function getStatistik($id)
    {
        $day = Carbon::now();
        
        $distribusi = Distribusi::with(relasi_distribusi)->where('farmasi_id',$id)->whereDate('verified_at', '>=', $day->copy()->startOfDay())->get();
        $count = $distribusi->count();

        return $count;
        
    }

    public function getStatistikGudang($id)
    {
        $day = Carbon::now();
        
        $distribusi = Distribusi::with(relasi_distribusi)->where('farmasi_id',$id)
                        ->whereNotNull('verified_at')
                        ->groupBy('month')
                        ->orderBy('month', 'ASC')
                        ->get(array(
                            DB::raw('MONTH(created_at) as month'),
                            DB::raw('COUNT(*) as "transaksi_count"')
                        ));
        $j=0;

        for ($i=1; $i <= 12; $i++) {
            if(!$distribusi->isEmpty() && $distribusi[$j]->month == $i){
                $data[$i] = $distribusi[$j];
                unset($distribusi[$j]);
                $j++;
            }else{
                $data[$i]['month'] = $i;
                $data[$i]['transaksi_count'] = 0;
            }
        }

        //Statistik per farmasi
        $temp = Distribusi::with(relasi_distribusi)->where('farmasi_id',$id)->whereDate('verified_at', '>=', $day->copy()->startOfWeek())
                    ->groupBy('unit_tujuan')
                    ->get(array(
                            DB::raw('unit_tujuan'),
                            DB::raw('COUNT(*) as "transaksi_count"')
                        ));

        $farm = array();
        $k = 0;
        foreach ($temp as $dis) {
            $farmasi = Farmasi::find($dis->unit_tujuan);
            if($farmasi) {
                $farm[$k]['transaksi_count'] = $dis->transaksi_count;
                $farm[$k]['farmasi'] = $farmasi->nama;
                $k++;
            }
        }
        // dd($farm);
        $stats = new stdClass();
        $stats->data = $data;
        $stats->farmasi = $farm;

        $distribusi = Distribusi::with(relasi_distribusi)->where('farmasi_id',$id)->whereDate('verified_at', '>=', $day->copy()->startOfDay())->get();
        $stats->distribusi = $distribusi->count();

        return $stats;
    }

    public function getUnconfirmed($id)
    {
        $distribusi = Distribusi::with(relasi_distribusi)->where('farmasi_id',$id)->where('kategori', 'Permintaan')->whereNull('verified_at')->latest()->limit(10)->get();
        // $transaction = Transaction::orderBy($order_by, 'desc')->get();

        return $distribusi;
    }

    public function getStatistikNilaiDistribusiPerBulan($farmasi_ids,$tipe,$month_start,$month_end)
    {
        $current_month = $month_start;
        $data = [];
        $index = 1;
        $select_query = "SELECT * FROM";
        $iteration = $month_start->diffInMonths($month_end);
        for($i=1;$i<=$iteration;$i++)
        {
            $index = $i;
            $current_month_start = $current_month->copy()->startOfMonth();
            $current_month_end = $current_month->copy()->endOfMonth();

            $select_query.= "
            (
                SELECT IFNULL(SUM(total_harga),0) AS distribusi_$index FROM `distribusi`
                    WHERE verified_at <= '".$current_month_end->toDateTimeString()."'
                    AND verified_at >= '".$current_month_start->toDateTimeString()."'
                    AND farmasi_id IN (".implode(",", $farmasi_ids).")
                    AND tipe = $tipe
            )table_$index";
            if($i != $iteration)
            {
                $select_query.=",";
            }
            $current_month->addMonth();
            $data[$current_month->format('Y-m')] = $index;
        }

        $distribusi = DB::connection('farmasi')->select($select_query);

        $new_data = [];
        foreach($data as $index =>$item)
        {   
            $variable = "distribusi_".$item;
            $value = $distribusi[0]->$variable;

            $object = new \stdClass();
            $object->date = $index;
            $object->value = $value/1000000;
            $new_data[] = $object;
        }
        return $new_data;

    }

    public function getAutoFillFromItems($farmasi_id,$item_ids)
    {
        if(!is_array($item_ids)) return [];
        elseif(empty($item_ids)) return [];

        $item_farmasi_ids = Items::whereIn('id',$item_ids)->pluck('item_farmasi_id')->toArray();
        $item_template_ids = ItemsFarmasi::whereIn('id',$item_farmasi_ids)->pluck('item_template_id')->toArray();

        $items_farmasi = ItemsFarmasi::whereIn('item_template_id',$item_template_ids)->where('farmasi_id',$farmasi_id)->with('item_template','stok')->get();
        
        return $items_farmasi;
    }

    public function getAutoFillFromItemsFarmasi($farmasi_id,$item_farmasi_ids)
    {
        if(!is_array($item_farmasi_ids)) return [];
        elseif(empty($item_farmasi_ids)) return [];
        
        $item_template_ids = ItemsFarmasi::whereIn('id',$item_farmasi_ids)->pluck('item_template_id')->toArray();

        $items_farmasi = ItemsFarmasi::whereIn('item_template_id',$item_template_ids)->where('farmasi_id',$farmasi_id)->with('item_template','stok')->get();
        
        return $items_farmasi;
    }

    public function getAutoFillItems($item_ids)
    {
        if(!is_array($item_ids)) return [];
        elseif(empty($item_ids)) return [];

        $items = Items::whereIn('id',$item_ids)->with(['item_farmasi.item_template'])->get();

        return $items;
    }
}
