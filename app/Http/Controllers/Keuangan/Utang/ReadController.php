<?php

namespace App\Http\Controllers\Keuangan\Utang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Utang;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;

class ReadController extends Controller
{
    public function getByFilterPenerimaan(Request $request)
    {
        $filter = $request->filter;
        $tanggal_start = $request->tanggal_start;
        $tanggal_end = $request->tanggal_end;
        if(($tanggal_start == null && $tanggal_end == null)||($tanggal_start == '' && $tanggal_end == '')){
            if ($filter == 'all')
                $query = Utang::with('perusahaan')->whereNotNull('no_faktur');
            else if($filter == 'processed')
                $query = Utang::with('perusahaan')->whereNotNull('no_faktur')->whereNotNull('no_pjk');
            else if($filter == 'unprocessed')
                $query = Utang::with('perusahaan')->whereNotNull('no_faktur')->whereNull('no_pjk');
        }
        else {
            if($tanggal_start == '')
                $tanggal_start = '00 January 0000';
            else if($tanggal_end == '')
                $tanggal_end = Carbon::today()->format('d F Y');
            $tanggal_min = Carbon::createFromFormat('d F Y H', $tanggal_start.' 0')->toDateTimeString();
            $tanggal_max = Carbon::createFromFormat('d F Y H', $tanggal_end.' 24')->toDateTimeString();
            if($filter == 'all')
                $query = Utang::with('perusahaan')->where('tanggal_faktur','>',$tanggal_min)->where('tanggal_faktur','<',$tanggal_max)->whereNotNull('no_faktur');
            else if($filter == 'processed')
                $query = Utang::with('perusahaan')->where('tanggal_faktur','>',$tanggal_min)->where('tanggal_faktur','<',$tanggal_max)->whereNotNull('no_faktur')->whereNotNull('no_pjk');
            else if($filter == 'unprocessed')
                $query = Utang::with('perusahaan')->where('tanggal_faktur','>',$tanggal_min)->where('tanggal_faktur','<',$tanggal_max)->whereNotNull('no_faktur')->whereNull('no_pjk');
        }
            
        return DataTables::of($query)
            ->make(true);
    }

    public function getByFilterPJK(Request $request)
    {
        $filter = $request->filter;
        $tanggal_start = $request->tanggal_start;
        $tanggal_end = $request->tanggal_end;
        if(($tanggal_start == null && $tanggal_end == null)||($tanggal_start == '' && $tanggal_end == '')){
            if ($filter == 'all')
                $query = Utang::with('perusahaan')->whereNotNull('no_pjk');
            else if($filter == 'processed')
                $query = Utang::with('perusahaan')->whereNotNull('no_pjk')->whereNotNull('tanggal_spp');
            else if($filter == 'unprocessed')
                $query = Utang::with('perusahaan')->whereNotNull('no_pjk')->whereNull('tanggal_spp');
        }
        else {
            if($tanggal_start == '')
                $tanggal_start = '00 January 0000';
            else if($tanggal_end == '')
                $tanggal_end = Carbon::today()->format('d F Y');
            $tanggal_min = Carbon::createFromFormat('d F Y H', $tanggal_start.' 0')->toDateTimeString();
            $tanggal_max = Carbon::createFromFormat('d F Y H', $tanggal_end.' 24')->toDateTimeString();
            if($filter == 'all')
                $query = Utang::with('perusahaan')->where('tanggal_transaksi','>',$tanggal_min)->where('tanggal_transaksi','<',$tanggal_max)->whereNotNull('no_pjk');
            else if($filter == 'processed')
                $query = Utang::with('perusahaan')->where('tanggal_transaksi','>',$tanggal_min)->where('tanggal_transaksi','<',$tanggal_max)->whereNotNull('no_pjk')->whereNotNull('tanggal_spp');
            else if($filter == 'unprocessed')
                $query = Utang::with('perusahaan')->where('tanggal_transaksi','>',$tanggal_min)->where('tanggal_transaksi','<',$tanggal_max)->whereNotNull('no_pjk')->whereNull('tanggal_spp');
        }
            
        return DataTables::of($query)
            ->addColumn('nomor_pjk', function (Utang $utang) {
                return $utang->nomor_pjk ? str_limit($utang->nomor_pjk) : '';
            })
            ->make(true);
    }

    public function getByFilterSPP(Request $request)
    {
        $filter = $request->filter;
        $tanggal_start = $request->tanggal_start;
        $tanggal_end = $request->tanggal_end;
        if(($tanggal_start == null && $tanggal_end == null)||($tanggal_start == '' && $tanggal_end == '')){
            if ($filter == 'all')
                $query = Utang::with('perusahaan')->whereNotNull('tanggal_spp');
            else if($filter == 'paid')
                $query = Utang::with('perusahaan')->whereNotNull('tanggal_spp')
                ->whereHas('UJIDetail')->where('total_paid', '>', 0)->whereColumn('total_paid', '>=', 'total');
            else if($filter == 'unpaid')
                $query = Utang::with('perusahaan')->whereNotNull('tanggal_spp')
                ->where(function($q){
                    $q->whereDoesntHave('UJIDetail')->orWhere(function($q2){
                        $q2->whereHas('UJIDetail')->where('total_paid', 0);
                    });
                });
        }
        else {
            if($tanggal_start == '')
                $tanggal_start = '00 January 0000';
            else if($tanggal_end == '')
                $tanggal_end = Carbon::today()->format('d F Y');
            $tanggal_min = Carbon::createFromFormat('d F Y H', $tanggal_start.' 0')->toDateTimeString();
            $tanggal_max = Carbon::createFromFormat('d F Y H', $tanggal_end.' 24')->toDateTimeString();
            if($filter == 'all')
                $query = Utang::with('perusahaan')->where('tanggal_spp','>',$tanggal_min)->where('tanggal_spp','<',$tanggal_max)->whereNotNull('tanggal_spp');
            else if($filter == 'paid')
                $query = Utang::with('perusahaan')->where('tanggal_spp','>',$tanggal_min)->where('tanggal_spp','<',$tanggal_max)->whereNotNull('tanggal_spp')
                ->whereHas('UJIDetail')->where('total_paid', '>', 0)->whereColumn('total_paid', '>=', 'total');
            else if($filter == 'unpaid')
                $query = Utang::with('perusahaan')->where('tanggal_spp','>',$tanggal_min)->where('tanggal_spp','<',$tanggal_max)
                ->whereNotNull('tanggal_spp')
                ->where(function($q){
                    $q->whereDoesntHave('UJIDetail')->orWhere(function($q2){
                        $q2->whereHas('UJIDetail')->where('total_paid', 0);
                    });
                });
        }
            
        return DataTables::of($query)
            ->addColumn('nomor_pjk', function (Utang $utang) {
                return $utang->nomor_pjk ? str_limit($utang->nomor_pjk) : '';
            })
            ->make(true);
    }

    public function getPJKForSPP($id)
    {
        $pjk = Utang::with(['perusahaan','detail','po'])->find($id);
            
        return json_encode($pjk);
    }

    public function getForPJK()
    {
        $pjk = Utang::with('perusahaan')->whereNotNull('no_faktur')->whereNull('no_pjk')->get();
            
        return json_encode($pjk);
    }
}
