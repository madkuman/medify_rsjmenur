<?php

namespace App\Http\Controllers\RawatInap\TempatTidur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\TempatTidur;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\Transaksi;

class ReadController extends Controller
{
  public function apiRuanganKosong(Request $request)
  {
    $filter_kelas = $request->input('filter_kelas');
    $filter_bangsal = $request->input('filter_bangsal');
    $transaksi_id = $request->input('transaksi_id');
    $transaksi = Transaksi::find($transaksi_id);
    
    if(empty($filter_bangsal))
    {
      $query = Bangsal::orderBy('id', 'asc');
      // if($transaksi->is_bayi)
      //   $query = Bangsal::where('bayi',1);
      // else
      //   $query = Bangsal::where(function($q){
      //       $q->whereNull('bayi')->orWhere('bayi',0);
      //   });

      // if($transaksi->is_intensif == 1)
      //   $query = $query->where('intensif',1);
      // else
      //   $query = $query->where(function($q){
      //     $q->whereNull('intensif')->orWhere('intensif',0);
      //   });

      $filter_bangsal = $query->pluck('id')->toArray();
    }

    if(empty($filter_kelas)) {
      $filter_kelas = Ruangan::whereIn('bangsal_id', $filter_bangsal)->groupBy('kelas')->pluck('kelas')->toArray();
    }

    $bed = TempatTidur::whereHas('ruangan', function($q) use ($filter_kelas,$filter_bangsal)
    {
      $q->whereIn('kelas', $filter_kelas)->whereHas('bangsal', function($q2) use ($filter_bangsal)
      {
        $q2->whereIn('id', $filter_bangsal);
      });
    })
    ->whereNull('booking_id')
    ->with('ruangan')
    ->with('ruangan.bangsal')
    ->with('transaksi')
    ->with('transaksi.pasien')
    ->paginate(10);

    return json_encode($bed);
  }

  public function apiRuangKosongNoTransaksi(Request $request)
  {
    $is_bayi = $request->is_bayi;
    $filter_bangsal = $request->input('filter_bangsal');
    $is_intensif = $request->is_intensif;

    if(empty($filter_bangsal))
    {

      
      $query = Bangsal::orderBy('id', 'asc');
      // if($is_bayi)
      //   $query = Bangsal::where('bayi',1);
      // else
      //   $query = Bangsal::orderBy('id', 'asc');

      // if($is_intensif)
      //   $query = $query->where('intensif',1);
      // else
      //   $query = $query->where('intensif','!=',1)->orderBy('id', 'desc');

      $filter_bangsal = $query->pluck('id')->toArray();
    }

    if(empty($filter_kelas)) {
      $filter_kelas = Ruangan::whereIn('bangsal_id', $filter_bangsal)->groupBy('kelas')->pluck('kelas')->toArray();
    }

    $bed = TempatTidur::whereHas('ruangan', function($q) use ($filter_kelas,$filter_bangsal)
    {
      $q->whereIn('kelas', $filter_kelas)->whereHas('bangsal', function($q2) use ($filter_bangsal)
      {
        $q2->whereIn('id', $filter_bangsal);

      });
    })
    ->whereNull('booking_id')
    ->whereNull('transaksi_id')
    ->with('ruangan')
    ->with('ruangan.bangsal')
    ->with('transaksi')
    ->with('transaksi.pasien')
    ->paginate(10);
    return json_encode($bed);

  }

  public function apiGetBedKosong(Request $request)
  {
    $keyword = $request->keyword;
    $filter_bangsal = $request->filter_bangsal;
    $is_bayi = $request->is_bayi;
    $is_intensif = $request->is_intensif;

    if(empty($filter_bangsal))
    {

      
      $query = Bangsal::orderBy('id', 'asc')->where('nama', 'like', '%'.$keyword.'%');
      // if($is_bayi)
      //   $query = Bangsal::where('bayi',1);
      // else
      //   $query = Bangsal::orderBy('id', 'asc');

      // if($is_intensif)
      //   $query = $query->where('intensif',1);
      // else
      //   $query = $query->where('intensif','!=',1)->orderBy('id', 'desc');

      $filter_bangsal = $query->pluck('id')->toArray();
    }

    if(empty($filter_kelas)) {
      $filter_kelas = Ruangan::whereIn('bangsal_id', $filter_bangsal)->groupBy('kelas')->pluck('kelas')->toArray();
    }

    $bed = TempatTidur::whereHas('ruangan', function($q) use ($filter_kelas,$filter_bangsal)
    {
      $q->whereIn('kelas', $filter_kelas)->whereHas('bangsal', function($q2) use ($filter_bangsal)
      {
        $q2->whereIn('id', $filter_bangsal);

      });
    })
    ->whereNull('booking_id')
    ->whereNull('transaksi_id')
    ->with('ruangan.kelas_ruang')
    ->with('ruangan.bangsal')
    ->with('transaksi')
    ->with('transaksi.pasien')
    ->paginate(10);
    return json_encode($bed);
  }
}
