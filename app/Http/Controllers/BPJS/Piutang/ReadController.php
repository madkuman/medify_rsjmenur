<?php

namespace App\Http\Controllers\BPJS\Piutang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Piutang;
use App\Models\Kasus\Tagihan;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Models\Keuangan\Perusahaan;
use DB;

define('relasi_piutang', ['pasien', 'kategori', 'perusahaan', 'kasusTagihan.kasus']);

class ReadController extends Controller
{
    public function getByFilter(Request $request)
    {
        if($request->perusahaan_id)
            $all_perusahaan = $request->perusahaan_id;
        else
            $all_perusahaan = Perusahaan::where('is_bpjs', 1)->get()->pluck('id')->toArray();
        $filter = $request->filter;
        $tanggal_start = $request->tanggal_start;
        $tanggal_end = $request->tanggal_end;
        $tunai = "Tunai";
        $asal_layanan = $request->asal_layanan;
        $status_file = $request->status_file;

        $pt_array = $all_perusahaan;
        $perusahaan = $pt_array;


        $query = Piutang::with(relasi_piutang)->whereNotNull('kasus_tagihan_id')->whereIn('perusahaan_id',$pt_array)->whereNull('status')->where('pihak_ketiga', '!=', $tunai)
                ->whereNull('paket_penagihan_id');

        if(($tanggal_start != null && $tanggal_end != null)||($tanggal_start != '' && $tanggal_end != '')){
            if($tanggal_start == '')
                $tanggal_start = '00 January 0000';
            else if($tanggal_end == '')
                $tanggal_end = Carbon::today()->format('d F Y');
            $tanggal_min = Carbon::createFromFormat('d M Y H', $tanggal_start.' 0')->toDateTimeString();
            $tanggal_max = Carbon::createFromFormat('d M Y H', $tanggal_end.' 24')->toDateTimeString();
            $filtered_kasus_id = Tagihan::whereHas('kasus', function($q) use($tanggal_min, $tanggal_max){
                $q->where('krs_at', '>=', $tanggal_min)->where('krs_at', '<=', $tanggal_max);
            })->pluck('id');

            $query = $query->whereIn('kasus_tagihan_id', $filtered_kasus_id);
        }

        if($filter == 'paid'){
            $query = $query->whereRaw('total = total_paid');
        }
        else if($filter == 'unpaid'){
            $query = $query->where('total', '>', 0)->where('total', '>', 'total_paid');
        }

        if(isset($status_file))
            $query = $status_file == 1 ? $query->whereNotNull('file_created_at') : $query->whereNull('file_created_at');
        if($asal_layanan)
            $query = $query->AsalFilter($asal_layanan);

        return $this->getByFilterDatatables($query);
    }

    private function getByFilterDatatables($query)
    {
        return DataTables::of($query)
        ->addColumn('pasien', function(Piutang $piutang){
            if(empty($piutang->pasien))
                return 'none-none-'.$piutang->pihak_ketiga;
            else
                return $piutang->pasien->name.'-'.$piutang->pasien->no_rm.'-none';
        })
        ->addColumn('perusahaan', function(Piutang $piutang){
            return $piutang->perusahaan ? $piutang->perusahaan->nama : '';
        })
        ->addColumn('kategori', function (Piutang $piutang) {
            return $piutang->kategori ? str_limit($piutang->kategori->name) : '';
        })
        ->addColumn('bayar', function(Piutang $piutang){
            if($piutang->total == $piutang->total_paid)
                return 'paid-'.$piutang->id.'-'.!is_null($piutang->file_created_at);
            else
                return 'unpaid-'.$piutang->id.'-'.!is_null($piutang->file_created_at);
        })
        ->addColumn('total_id', function(Piutang $piutang){
            return $piutang->total.'-'.$piutang->id;
        })
        ->addColumn('total_paid_id', function(Piutang $piutang){
            return $piutang->total_paid.'-'.$piutang->id;
        })
        ->addColumn('krs_at', function($piutang){
            if(isset($piutang->kasusTagihan->kasus->krs_at) && !is_null($piutang->kasusTagihan->kasus->krs_at))
                return $piutang->kasusTagihan->kasus->krs_at;
            else
                return '';                
        })
        ->toJson();
    }
}