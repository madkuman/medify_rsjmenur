<?php

namespace App\Http\Controllers\CSSD\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\Transaksi;
use App\Models\KamarOperasi\Transaksi as TransaksiOK;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use DB;

class ReadController extends Controller
{
    public function permintaanIndexApi(Request $request)
    {
        $ruangan_ok = $request->ruangan_ok;
        $ronde_ok_min = $request->ronde_ok_min;
        $ronde_ok_max = $request->ronde_ok_max;
        $tanggal_str_max = $request->tanggal_max;
        $tanggal_str_min = $request->tanggal_min;
        $status_selesai = $request->status_selesai;
        $status_belum_selesai = $request->status_belum_selesai;

        if(empty($ronde_ok_min)) $ronde_ok_min = 0;
        if(empty($ronde_ok_max)) $ronde_ok_max = 8;
        if(empty($tanggal_str_max)) $tanggal_max = Carbon::maxValue();
        else $tanggal_max = Carbon::createFromFormat('m/d/Y', $tanggal_str_max, 'Asia/Jakarta')->endOfDay();

        if(empty($tanggal_str_min)) $tanggal_min = Carbon::minValue();   
        else $tanggal_min = Carbon::createFromFormat('m/d/Y', $tanggal_str_min, 'Asia/Jakarta')->startOfDay();

        $status = [];
        if($status_selesai == "true") $status[] = 1;
        if($status_belum_selesai == "true") $status[] = 0;
        elseif(empty($status_belum_selesai)) $status[] = 0;

        $transaksi_ok = TransaksiOK::whereBetween('jadwal_operasi', array($tanggal_min,$tanggal_max))->whereBetween('nomor_ronde', array($ronde_ok_min,$ronde_ok_max))->get();
        if(!empty($ruangan_ok))
        {
            $transaksi_ok_filtered = $transaksi_ok->whereIn('ruangan_id',$ruangan_ok)->pluck('id');
        }
        else $transaksi_ok_filtered = $transaksi_ok->pluck('id');

        $transaksi = Transaksi::where('type',1)->whereIn('status',$status)->whereIn('ok_transaksi_id',$transaksi_ok_filtered)->get();

        $i = 1;
        foreach($transaksi as $item)
        {
            $item->no = $i++;
            if(empty($item->transaksi_ok->ruangan->name)) $ruangan = '-';
            else $ruangan = $item->transaksi_ok->ruangan->name;
            $item->tanggal_operasi = $item->transaksi_ok->jadwal_operasi->format('d F Y');
            $item->kamar_operasi = $ruangan;
            $item->ronde = $item->transaksi_ok->nomor_ronde;
            $item->dokter = $item->transaksi_ok->dokter->name;
            $item->status = $item->status_text;
        }

        return DataTables::of($transaksi)
        ->addColumn('no', function(Transaksi $item){
            return $item->no;
        })
        ->addColumn('id', function(Transaksi $item){
            return $item->id;
        })
        ->addColumn('tanggal_operasi', function(Transaksi $item){
            return $item->tanggal_operasi;
        })
        ->addColumn('kamar_operasi', function (Transaksi $item) {
            return $item->kamar_operasi;
        })
        ->addColumn('ronde', function (Transaksi $item) {
            return $item->ronde;
        })
        ->addColumn('dokter', function (Transaksi $item) {
            return $item->dokter;
        })
        ->addColumn('status', function (Transaksi $item) {
            return $item->status;
        })
        ->toJson();
    }

    public function pengembalianIndexApi(Request $request)
    {
     $ruangan_ok = $request->ruangan_ok;
     $ronde_ok_min = $request->ronde_ok_min;
     $ronde_ok_max = $request->ronde_ok_max;
     $tanggal_str_max = $request->tanggal_max;
     $tanggal_str_min = $request->tanggal_min;
     $status_selesai = $request->status_selesai;
     $status_belum_selesai = $request->status_belum_selesai;

     if(empty($ronde_ok_min)) $ronde_ok_min = 0;
     if(empty($ronde_ok_max)) $ronde_ok_max = 8;
     if(empty($tanggal_str_max)) $tanggal_max = Carbon::maxValue();
     else $tanggal_max = Carbon::createFromFormat('m/d/Y', $tanggal_str_max, 'Asia/Jakarta')->endOfDay();

     if(empty($tanggal_str_min)) $tanggal_min = Carbon::minValue();   
     else $tanggal_min = Carbon::createFromFormat('m/d/Y', $tanggal_str_min, 'Asia/Jakarta')->startOfDay();

     $status = [];
     if($status_selesai == "true") $status[] = 1;
     if($status_belum_selesai == "true") $status[] = 0;
     elseif(empty($status_belum_selesai)) $status[] = 0;


     $transaksi_ok = TransaksiOK::whereBetween('jadwal_operasi', array($tanggal_min,$tanggal_max))->whereBetween('nomor_ronde', array($ronde_ok_min,$ronde_ok_max))->get();
     if(!empty($ruangan_ok))
     {
        $transaksi_ok_filtered = $transaksi_ok->whereIn('ruangan_id',$ruangan_ok)->pluck('id');
    }
    else $transaksi_ok_filtered = $transaksi_ok->pluck('id');

    $transaksi = Transaksi::where('type',2)->whereIn('status',$status)->whereIn('ok_transaksi_id',$transaksi_ok_filtered)->get();

    $i = 1;
    foreach($transaksi as $item)
    {
        $item->no = $i++;
        $item->tanggal_operasi = $item->transaksi_ok->jadwal_operasi->format('d F Y');
        if(empty($item->transaksi_ok->ruangan->name)) $ruangan = '-';
        else $ruangan = $item->transaksi_ok->ruangan->name;
        $item->kamar_operasi = $ruangan;
        $item->ronde = $item->transaksi_ok->nomor_ronde;
        $item->dokter = $item->transaksi_ok->dokter->name;
        $item->status = $item->status_text;
    }

    return DataTables::of($transaksi)
    ->addColumn('no', function(Transaksi $item){
        return $item->no;
    })
    ->addColumn('id', function(Transaksi $item){
        return $item->id;
    })
    ->addColumn('tanggal_operasi', function(Transaksi $item){
        return $item->tanggal_operasi;
    })
    ->addColumn('kamar_operasi', function (Transaksi $item) {
        return $item->kamar_operasi;
    })
    ->addColumn('ronde', function (Transaksi $item) {
        return $item->ronde;
    })
    ->addColumn('dokter', function (Transaksi $item) {
        return $item->dokter;
    })
    ->addColumn('status', function (Transaksi $item) {
        return $item->status;
    })
    ->toJson();
}

public function cekJadwalOperasiAPi(Request $request)
{
    $tanggal_ok = $request->tanggal_ok;
    $ronde_ok = $request->ronde_ok;
    $ruangan_ok = $request->ruangan_ok;
    if(empty($tanggal_ok)) return 0;
    $tanggal_min = Carbon::createFromFormat('d/m/Y', $tanggal_ok, 'Asia/Jakarta')->startOfDay();
    $tanggal_max = Carbon::createFromFormat('d/m/Y', $tanggal_ok, 'Asia/Jakarta')->endOfDay();

    $transaksi_ok = TransaksiOK::whereBetween('jadwal_operasi', array($tanggal_min,$tanggal_max))
    ->where('nomor_ronde',$ronde_ok)
    ->where('ruangan_id',$ruangan_ok)->first();

    if(!empty($transaksi_ok->id))
        return $transaksi_ok->id;
    else
        return 0;
}
}
