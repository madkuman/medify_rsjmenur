<?php

namespace App\Http\Controllers\Farmasi\Penghapusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Penghapusan;
use App\Models\Farmasi\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DateTime, stdClass;


define('relasi_penghapusan', [
                    'log.detail_item.detail_item.item_detail', 
                    'created_by_detail',
                    'penghapusan_jenis',
                    'penyedia'
                ]);

class ReadController extends Controller
{
	public function getAll($farmasi_id)
    {
        $penghapusan = Penghapusan::with(relasi_penghapusan)->where('farmasi_id', $farmasi_id)->orderBy('created_at','desc')->get();
    	return $penghapusan;
    }

    public function getDataIndex($farmid, $request)
    {
        $tgl_awal = $request->tanggal_awal;
        $tgl_akhir = $request->tanggal_akhir;
        $penyedia_id = $request->penyedia_id;
        $penghapusan_jenis_id = $request->penghapusan_jenis_id;
        $surat_perintah = $request->surat_perintah;
        $no_pengeluaran = $request->no_pengeluaran;
        $keterangan = $request->keterangan;

        $penghapusan = Penghapusan::with(relasi_penghapusan)->where('farmasi_id', $farmid);

        if($tgl_awal) {
            $tgl_awal = str_replace("/", "-", $tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
            $min_date = $min_date->copy()->startOfDay();
        } else $min_date = Carbon::minValue();

        if($tgl_akhir){
            $tgl_akhir = str_replace("/", "-", $tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else $max_date = Carbon::maxValue();

        $penghapusan = $penghapusan->whereBetween('created_at', [$min_date, $max_date])
        ->when($penyedia_id, function ($query, $penyedia_id) {
            return $query->where('penyedia_id', $penyedia_id);
        })
        ->when($penghapusan_jenis_id, function ($query, $penghapusan_jenis_id) {
            return $query->where('penghapusan_jenis_id', $penghapusan_jenis_id);
        })
        ->when($surat_perintah, function ($query, $surat_perintah) {
            return $query->where('surat_perintah', 'like','%'.$surat_perintah.'%');
        })
        ->when($no_pengeluaran, function ($query, $no_pengeluaran) {
            return $query->where('no_pengeluaran', 'like','%'.$no_pengeluaran.'%');
        })
        ->when($keterangan, function ($query, $keterangan) {
            return $query->where('keterangan', 'like','%'.$keterangan.'%');
        })
        ->latest();
        return $penghapusan;
    }

    public function get($slug)
    {
        $transactions = Penghapusan::with(relasi_penghapusan)->where('slug',$slug)->first();
        return $transactions;
    }
    public function getStatistikNilaiPenghapusanPerBulan($farmasi_ids,$start,$end)
    {
        $penghapusan = Penghapusan::whereIn('farmasi_id',$farmasi_ids)
                        ->whereBetween('created_at',[$start,$end])
                        ->groupBy('month','year')
                        ->orderBy('year', 'ASC')
                        ->orderBy('month', 'ASC')
                        ->get(array(
                            DB::raw('MONTH(created_at) as month'),
                            DB::raw('YEAR(created_at) as year'),
                            DB::raw('SUM(total_harga) as "total_harga"')
                        ));
        return $penghapusan;
    }
}
