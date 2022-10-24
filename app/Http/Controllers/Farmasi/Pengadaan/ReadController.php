<?php

namespace App\Http\Controllers\Farmasi\Pengadaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Pengadaan;
use App\Models\Keuangan\Perusahaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DateTime, stdClass;

class ReadController extends Controller
{
	public function getAll($farmasi)
    {
        $pengadaan = Pengadaan::where('farmasi_id', $farmasi)->orderBy('created_at','desc')->get();
    	return $pengadaan;
    }

    public function getDataIndex($farmid, $request)
    {
        $penyedia = $request->penyedia;
		$tgl_awal = $request->tanggal_awal;
		$tgl_akhir = $request->tanggal_akhir;
		$harga_min = $request->harga_minimal;
		$harga_max = $request->harga_maksimal;
		$no_faktur = $request->no_faktur;
		$no_surat = $request->no_surat;
        $pengadaan = Pengadaan::where('farmasi_id', $farmid)->orderBy('created_at','desc');

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

        return $pengadaan;
    }

    public function getPengadaanBySupplier($supplier_id)
    {
        $pengadaan = Pengadaan::where('supplier_id', $supplier_id)->latest()->get();

        return $pengadaan;
    }

    public function get($slug)
    {
        $transactions = Pengadaan::where('slug',$slug)->first();
        return $transactions;
    }

    public function getStatistik($id)
    {
        $day = Carbon::now();

        $pengadaan = Pengadaan::where('farmasi_id',$id)->whereDate('created_at', '>=', $day->copy()->startOfDay())->get();
        $count = $pengadaan->count();

        return $count;
    }

    public function getStatistikSupplier($id)
    {
        $day = Carbon::now();
        $stats = new stdClass();

        $pengadaan = Pengadaan::where('farmasi_id', $id)->whereDate('created_at', '>=', $day->copy()->startOfDay())->get();
        $stats->pengadaan = $pengadaan->count();

        $pengadaan = Pengadaan::where('farmasi_id', $id)->whereDate('created_at', '>=', $day->copy()->startOfWeek())
                    ->groupBy('supplier_id')
                    ->get(array(
                            DB::raw('supplier_id'),
                            DB::raw('COUNT(*) as "transaksi_count"')
                        ));

        $supp = array();
        
        $k = 0;
        foreach ($pengadaan as $ada) {
            $supplier = Perusahaan::find($ada->supplier_id); //exclude gudang
            if($supplier) {
                $supp[$k]['transaksi_count'] = $ada->transaksi_count;
                $supp[$k]['supplier'] = $supplier->nama;
                $k++;
            }
        }
        $stats->supplier = $supp;
        return $stats;
    }

    public function getStatistikNilaiPengadaanPerBulan($farmasi_ids,$month_start,$month_end)
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
               SELECT IFNULL(SUM(total_harga),0) AS pengadaan_$index FROM `pengadaan`
                    WHERE tanggal_faktur >= '".$current_month_start->toDateTimeString()."'
                    AND tanggal_faktur <= '".$current_month_end->toDateTimeString()."'
                    AND farmasi_id IN (".implode(",", $farmasi_ids).")
            )table_$index";
            if($i != $iteration)
            {
                $select_query.=",";
            }
            $current_month->addMonth();
            $data[$current_month->format('Y-m')] = $index;
        }
        $pengadaan = DB::connection('farmasi')->select($select_query);
        $new_data = [];
        foreach($data as $index =>$item)
        {   
            $variable = "pengadaan_".$item;
            $value = $pengadaan[0]->$variable;

            $object = new \stdClass();
            $object->date = $index;
            $object->value = $value/1000000;
            $new_data[] = $object;
        }
        return $new_data;
    }



    public function getStatistikNilaiPengadaanPerBulanLaravel($farmasi_ids,$start,$end)
    {
        $pengadaan = Pengadaan::whereIn('farmasi_id',$farmasi_ids)
                        ->whereBetween('created_at',[$start,$end])
                        ->groupBy('month','year')
                        ->orderBy('year', 'ASC')
                        ->orderBy('month', 'ASC')
                        ->get(array(
                            DB::raw('MONTH(created_at) as month'),
                            DB::raw('YEAR(created_at) as year'),
                            DB::raw('SUM(total_harga) as "total_harga"')
                        ));
        return $pengadaan;
    }


}
