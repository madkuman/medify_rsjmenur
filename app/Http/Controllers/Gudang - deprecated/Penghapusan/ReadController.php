<?php

namespace App\Http\Controllers\Gudang\Penghapusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Penghapusan;
use App\Models\Gudang\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DateTime, stdClass;


define('relasi', [
                    'log.detail_item.detail_item',
                    'created_by_detail'
]);

class ReadController extends Controller
{
	public function getAll()
    {
        $penghapusan = Penghapusan::with(relasi)->orderBy('created_at','desc')->get();

    	// $transaction = Transaction::orderBy($order_by, 'desc')->get();
    	return $penghapusan;
    }

    public function getPerPage($limit, $offset)
    {
        $penghapusan = Penghapusan::with(relasi)->orderBy('created_at','desc')->limit($limit)->offset($offset)->get();
        return $penghapusan;
    }

    public function filteredData($limit, $offset, $tgl_awal, $tgl_akhir)
    {   
        $penghapusan = Penghapusan::with(relasi)->orderBy('created_at','desc');

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
        
        $penghapusan = $penghapusan->whereBetween('created_at', [$min_date, $max_date]);

        $count = $penghapusan->get()->count();
        $penghapusan = $penghapusan->limit($limit)->offset($offset)->get();
        $penghapusan->count = $count;

        return $penghapusan;
    }

    public function getPenghapusanBySupplier($supplier_id)
    {
        $penghapusan = Penghapusan::with(relasi)->where('supplier_id', $supplier_id)->latest()->get();

        return $penghapusan;
    }

    public function get($slug)
    {
        $transactions = Penghapusan::with(relasi)->where('slug',$slug)->first();
        // $transaction = Transaction::orderBy($order_by, 'desc')->get();

        return $transactions;
    }

    public function getStatistik()
    {
        $day = Carbon::now();
        $stats = new stdClass();

        $penghapusan = Penghapusan::with(relasi)->whereDate('created_at', '>=', $day->copy()->startOfDay())->get();
        $stats->penghapusan = $penghapusan->count();

        $penghapusan = Penghapusan::with(relasi)->whereDate('created_at', '>=', $day->copy()->startOfWeek())
                    ->groupBy('supplier_id')
                    ->get(array(
                            DB::raw('supplier_id'),
                            DB::raw('COUNT(*) as "transaksi_count"')
                        ));

        $supp = array();
        
        $k = 0;
        foreach ($penghapusan as $ada) {
            $supplier = Supplier::find($ada->supplier_id);
            if($supplier) {
                $supp[$k]['transaksi_count'] = $ada->transaksi_count;
                $supp[$k]['supplier'] = $supplier->nama;
                $k++;
            }
        }
        $stats->supplier = $supp;
        //dd($supp);

        return $stats;
    }
}
