<?php

namespace App\Http\Controllers\Gizi\Produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Gizi\PemesananDetail;
use App\Models\Gizi\Resep;
use App\Models\Gizi\ResepDetail;
use App\Models\Gizi\BahanMakanan;
use App\Models\Gizi\Produksi;
use App\Models\Gizi\ProduksiDetail;
use App\Models\Gizi\ProduksiBahan;
use App\Models\Gizi\ProduksiMakanan;

class ReadController extends Controller
{
	public function getResep()
  {
    $data = Resep::all();
    return $data;
  }

  public function getBahan()
  {
    $data = BahanMakanan::all();
    return $data;
  }

  public function getRekapResepIndex($tanggal)
  {
    $today = Carbon::parse($tanggal)->startOfDay();
    $today_end = Carbon::parse($tanggal)->endOfDay();
    $tomorrow = Carbon::parse($tanggal)->addDay()->startOfDay();
    $tomorrow_end = Carbon::parse($tanggal)->addDay()->endOfDay();

    $sore   = PemesananDetail::whereBetween('untuk_tanggal',[$today,$today_end])
            ->where('waktu_makan_id',3)
            ->get();
    $s_sore = PemesananDetail::whereBetween('untuk_tanggal',[$today,$today_end])
            ->where('waktu_makan_id',5)
            ->get();
    $pagi   = PemesananDetail::whereBetween('untuk_tanggal',[$today,$today_end])
            ->where('waktu_makan_id',1)
            ->get();
    $s_pagi = PemesananDetail::whereBetween('untuk_tanggal',[$today,$today_end])
            ->where('waktu_makan_id',4)
            ->get();
    $siang  = PemesananDetail::whereBetween('untuk_tanggal',[$today,$today_end])
            ->where('waktu_makan_id',2)
            ->get();
    $array = [];

    $array = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($sore,$array);
    $array = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($pagi,$array);
    $array = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($siang,$array);
    $array = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($s_pagi,$array);
    $array = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($s_sore,$array);
      
    return $array;       
  }

  public function getRekapResep($tanggal,$flag_pagi,$flag_siang,$flag_sore)
	{
		$today = Carbon::parse($tanggal)->startOfDay();
		$today_end = Carbon::parse($tanggal)->endOfDay();
		$tomorrow = Carbon::parse($tanggal)->addDay()->startOfDay();
		$tomorrow_end = Carbon::parse($tanggal)->addDay()->endOfDay();
    $array = [];

		if($flag_sore == 1)
    {
      $sore   = PemesananDetail::whereBetween('untuk_tanggal',[$today,$today_end])
              ->where('waktu_makan_id',3)
              ->get();
      $s_sore = PemesananDetail::whereBetween('untuk_tanggal',[$today,$today_end])
              ->where('waktu_makan_id',5)
              ->get();
      $array = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($sore,$array);
      $array = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($s_sore,$array);      
    }
    if($flag_pagi == 1)
    {
      $pagi   = PemesananDetail::whereBetween('untuk_tanggal',[$today,$today_end])
              ->where('waktu_makan_id',1)
              ->get();
      $s_pagi = PemesananDetail::whereBetween('untuk_tanggal',[$today,$today_end])
              ->where('waktu_makan_id',4)
              ->get();
      $array = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($pagi,$array);
      $array = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($s_pagi,$array);
    }
    if($flag_siang)
    {
      $siang  = PemesananDetail::whereBetween('untuk_tanggal',[$today,$today_end])
              ->where('waktu_makan_id',2)
              ->get();
      $array = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($siang,$array);  
    }
          
    return $array;
	}

	public function countResep($query,$array)
 	{
 		foreach ($query as $query_item) 
 		{
 			if(empty($array[$query_item->resep_id]))
 			{	
 				$array[$query_item->resep_id]['id'] = $query_item->resep_id;
 				$array[$query_item->resep_id]['jumlah'] = 1;
 				$array[$query_item->resep_id]['nama'] = $query_item->resep->nama;
 			}
 			else
 			{
 				$array[$query_item->resep_id]['jumlah'] += 1;
 			}
 		}

 		return $array;	
 	}

  public function countBahan($query)
  {
    $bahan = [];
    foreach ($query as $query_item) 
    { 
      //dd($query_item->resep_id);
      $result = ResepDetail::where('resep_id',$query_item['resep_id'])->get();
      $count = 0;
      foreach ($result as $result_item) 
      {
        if(empty($bahan[$result_item->bahan_makanan_id]))
        {
          $bahan[$result_item->bahan_makanan_id]['id'] = $result_item->bahan_makanan_id;
          $bahan[$result_item->bahan_makanan_id]['nama'] = $result_item->bahan_makanan->nama;
          $temp = BahanMakanan::where('id',$result_item->bahan_makanan_id)
          ->select('stok','satuan','jenis_bahan_id')->first();
          $bahan[$result_item->bahan_makanan_id]['stok'] = $temp->stok;
          $bahan[$result_item->bahan_makanan_id]['satuan'] = $temp->satuan;
          $bahan[$result_item->bahan_makanan_id]['jenis_bahan'] = $temp->jenis_bahan_id;
        }

        $bahan[$result_item->bahan_makanan_id]['bb'] = $result_item->jumlah_bb;
        $bahan[$result_item->bahan_makanan_id]['bk'] = $result_item->jumlah_bk;
        
        $bahan[$result_item->bahan_makanan_id]['total_bb'] = 0;
        $bahan[$result_item->bahan_makanan_id]['total_bk'] = 0;

        $bahan[$result_item->bahan_makanan_id]['total_bb'] = 
        $bahan[$result_item->bahan_makanan_id]['bb'] * $query_item['jumlah_realisasi'];
        $bahan[$result_item->bahan_makanan_id]['total_bk'] = 
        $bahan[$result_item->bahan_makanan_id]['bk'] * $query_item['jumlah_realisasi'];

        if(empty($bahan[$result_item->bahan_makanan_id]['total_bb_final']))
        {
          $bahan[$result_item->bahan_makanan_id]['total_bb_final'] = 
          $bahan[$result_item->bahan_makanan_id]['total_bb'];
          $bahan[$result_item->bahan_makanan_id]['total_bk_final'] =
          $bahan[$result_item->bahan_makanan_id]['total_bk']; 
        }
        else
        {
          $bahan[$result_item->bahan_makanan_id]['total_bb_final'] += 
          $bahan[$result_item->bahan_makanan_id]['total_bb'];
          $bahan[$result_item->bahan_makanan_id]['total_bk_final'] +=
          $bahan[$result_item->bahan_makanan_id]['total_bk'];
        }
      }
    }
    //dd($bahan);
    return $bahan;
  }

  public function getRekap($id)
  {
     $data = Produksi::where('id',$id)->first();
     //dd($data);
     return $data;
  }

  public function getRekapMakanan($id)
  {
    $data = ProduksiMakanan::where('produksi_id',$id)->get();
    return $data;
  }

  public function getRekapBahan($id)
  {
    $data = ProduksiBahan::where('produksi_id',$id)->get();
    return $data;
  }

  public function getRekapDetail($id)
  {
    $data = ProduksiDetail::where('produksi_id',$id)->get();
    return $data;
  }

  public function getAllRekap()
  {
    $data = Produksi::orderBy('created_at','DESC')->get();
    return $data;
  }

  public function getProduksi($date)
  { 
    $start = Carbon::parse($date)->startOfDay();
    $end = Carbon::parse($date)->endOfDay();
    $data = Produksi::whereBetween('tanggal_produksi',[$start,$end])->get();
    if(count($data) > 0)
    {
      return 1;
    }
    else
    {
      return 0;
    }
  }

}
