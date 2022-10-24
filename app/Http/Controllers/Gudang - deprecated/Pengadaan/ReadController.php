<?php

namespace App\Http\Controllers\Gudang\Pengadaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Pengadaan;
use App\Models\Gudang\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DateTime, stdClass;

class ReadController extends Controller
{
	public function getAll()
    {
        $pengadaan = Pengadaan::orderBy('created_at','desc')->get();

    	// $transaction = Transaction::orderBy($order_by, 'desc')->get();
    	return $pengadaan;
    }

    public function getPerPage($limit, $offset)
    {
        $pengadaan = Pengadaan::orderBy('created_at','desc')->limit($limit)->offset($offset)->get();
        return $pengadaan;
    }

    public function filteredData($limit, $offset, $penyedia, $tgl_awal, $tgl_akhir, $harga_min, $harga_max, $no_faktur, $no_surat)
    {   
        $pengadaan = Pengadaan::orderBy('created_at','desc');
        // dd($harga_min);
        if(!is_null($penyedia)){
            $pengadaan = $pengadaan->where('supplier_id', $penyedia);
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
        
        $pengadaan = $pengadaan->whereBetween('tanggal', [$min_date, $max_date]);

        if(!is_null($harga_min)) {
            $pengadaan = $pengadaan->where('total_harga', '>=', $harga_min);
        }

        if(!is_null($harga_max)) {
            $pengadaan = $pengadaan->where('total_harga', '<=', $harga_max);
        }

        if(!is_null($no_faktur)) {
            $pengadaan = $pengadaan->where('nomor_referensi', $no_faktur);
        }

        if(!is_null($no_surat)) {
            $pengadaan = $pengadaan->where('nomor_surat_jalan', $no_surat);
        }

        $count = $pengadaan->get()->count();
        $pengadaan = $pengadaan->limit($limit)->offset($offset)->get();
        $pengadaan->count = $count;

        return $pengadaan;
    }

    public function getPengadaanBySupplier($supplier_id)
    {
        $pengadaan = Pengadaan::where('supplier_id', $supplier_id)->latest()->get();

        return $pengadaan;
    }

    public function get($slug)
    {
        $transactions = Pengadaan::with('log.detail_item.detail_item')->where('slug',$slug)->first();
        // $transaction = Transaction::orderBy($order_by, 'desc')->get();

        return $transactions;
    }

    public function getStatistik()
    {
        $day = Carbon::now();
        $stats = new stdClass();

        $pengadaan = Pengadaan::whereDate('created_at', '>=', $day->copy()->startOfDay())->get();
        $stats->pengadaan = $pengadaan->count();

        $pengadaan = Pengadaan::whereDate('created_at', '>=', $day->copy()->startOfWeek())
                    ->groupBy('supplier_id')
                    ->get(array(
                            DB::raw('supplier_id'),
                            DB::raw('COUNT(*) as "transaksi_count"')
                        ));

        $supp = array();
        
        $k = 0;
        foreach ($pengadaan as $ada) {
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
