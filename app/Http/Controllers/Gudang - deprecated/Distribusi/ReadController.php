<?php

namespace App\Http\Controllers\Gudang\Distribusi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Distribusi;
use App\Models\Farmasi\Farmasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DateTime, stdClass;

define('relasi', [
                    'farmasi_detail',
                    'transaksi_detail.log.detail_item.detail_item.item_detail',
                    'log.detail_item.detail_item',
                    'transaksi_detail.draft.detail_draft',
                    'created_by_detail', 'verified_by_detail',
                    'draft.detail_item.detail_item'
]);


class ReadController extends Controller
{
	public function getAll()
    {
        $distribusi = Distribusi::with(relasi)->latest()->get();

        return $distribusi;
    }

    public function getPerPage($limit, $offset)
    {
        $distribusi = Distribusi::with(relasi)->latest()->limit($limit)->offset($offset)->get();
        return $distribusi;
    }

    public function getUnconfirmed()
    {
        $distribusi = Distribusi::with(relasi)->where('status',0)->latest()->limit(10)->get();
        //dd($distribusi);
        // $transaction = Transaction::orderBy($order_by, 'desc')->get();

        return $distribusi;
    }

    public function getSingle($slug)
    {
        $distribusi = Distribusi::with(relasi)->where('slug',$slug)->first();
        //dd($distribusi);
        // $transaction = Transaction::orderBy($order_by, 'desc')->get();

        return $distribusi;
    }

    public function filteredData($limit, $offset, $unit_tujuan, $tgl_awal, $tgl_akhir, $status, $kategori)
    {   
        $distribusi = Distribusi::with(relasi)->orderBy('created_at','desc');
        if($unit_tujuan){
            $distribusi = $distribusi->where('farmasi_id', $unit_tujuan);
        }

        if($tgl_awal) {
            $tgl_awal = str_replace("/", "-", $tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
        } else $min_date = Carbon::minValue();

        if($tgl_akhir){
            $tgl_akhir = str_replace("/", "-", $tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else $max_date = Carbon::maxValue();
        
        $distribusi = $distribusi->whereBetween('created_at', [$min_date, $max_date]);

        if($status!=2) {
            $distribusi = $distribusi->where('status', $status);
        }

        if($kategori) {
            $distribusi = $distribusi->where('kategori', $kategori);
        }

        $count = $distribusi->get()->count();
        $distribusi = $distribusi->limit($limit)->offset($offset)->get();
        $distribusi->count = $count;

        return $distribusi;
    }

    public function getStatistik()
    {
        //Statistik per bulan
        $day = Carbon::now();

        $distribusi = Distribusi::with(relasi)->whereDate('verified_at', '>=', $day->copy()->startOfYear())
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
        $distribusi = Distribusi::with(relasi)->whereDate('verified_at', '>=', $day->copy()->startOfWeek())
                    ->groupBy('farmasi_id')
                    ->get(array(
                            DB::raw('farmasi_id'),
                            DB::raw('COUNT(*) as "transaksi_count"')
                        ));

        $farm = array();
        $k = 0;
        foreach ($distribusi as $dis) {
            $farmasi = Farmasi::find($dis->farmasi_id);
            if($farmasi) {
                $farm[$k]['transaksi_count'] = $dis->transaksi_count;
                $farm[$k]['farmasi'] = $farmasi->nama;
                $k++;
            }
        }

        $stats = new stdClass();
        $stats->data = $data;
        $stats->farmasi = $farm;

        $distribusi = Distribusi::with(relasi)->whereDate('verified_at', '>=', $day->copy()->startOfDay())->get();
        $stats->distribusi = $distribusi->count();

        return $stats;
    }
}
