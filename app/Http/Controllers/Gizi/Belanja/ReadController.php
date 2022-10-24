<?php

namespace App\Http\Controllers\Gizi\Belanja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Gizi\Pemesanan;
use App\Models\Gizi\PemesananDetail;
use App\Models\Gizi\ResepDetail;
use App\Models\Gizi\BahanMakanan;
use App\Models\Gizi\Belanja;
use App\Models\Gizi\BelanjaDetail;
use Auth;


class ReadController extends Controller
{
    public function getBahanMakanan()
    {
    	$query = BahanMakanan::all();

    	return $query;
    }

    public function getKonfirmasi($id)
    {	
    	$data['belanja'] = Belanja::where('id',$id)->first();
    	$query = BelanjaDetail::where('belanja_id',$id)->get();
      $data['detail_kering'] = [];
      $data['detail_basah'] = [];

      foreach ($query as $item) 
      {
        if($item->detail_bahan->jenis_bahan_id == 1)
        {
          array_push($data['detail_kering'],$item);
        }
        else
        {
          array_push($data['detail_basah'],$item);
        }
      }

    	return $data;
    }

    public function getBelanjaWithTanggal($tanggal)
    {	
      $today = Carbon::parse($tanggal)->startOfDay();
      $today_end = Carbon::parse($tanggal)->endOfDay();
      $tomorrow = Carbon::parse($tanggal)->addDay()->startOfDay();
      $tomorrow_end = Carbon::parse($tanggal)->addDay()->endOfDay();
      //dd($today,$today_end,$tomorrow,$tomorrow_end);
      $sore = PemesananDetail::where('waktu_makan_id',3)
            ->with('resep')
            ->get();
      $pagi = PemesananDetail::whereBetween('untuk_tanggal',[$tomorrow,$tomorrow_end])
            ->where('waktu_makan_id',1)
            ->with('resep')
            ->get();
      $siang = PemesananDetail::whereBetween('untuk_tanggal',[$tomorrow,$tomorrow_end])
            ->where('waktu_makan_id',2)
            ->with('resep')
            ->get();
      $array = [];


      $array = app('App\Http\Controllers\Gizi\Belanja\ReadController')->countResep($sore,$array);
      $array = app('App\Http\Controllers\Gizi\Belanja\ReadController')->countResep($pagi,$array);
      $array = app('App\Http\Controllers\Gizi\Belanja\ReadController')->countResep($siang,$array);

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
            $result = ResepDetail::where('resep_id',$query_item['id'])->get();
            $count = 0;
            foreach ($result as $result_item)
            {
                if(empty($bahan[$result_item->bahan_makanan_id]))
                {
                    $bahan[$result_item->bahan_makanan_id]['id'] = $result_item->bahan_makanan_id;
                    $bahan[$result_item->bahan_makanan_id]['nama'] = $result_item->bahan_makanan->nama;
                    $temp = BahanMakanan::where('id',$result_item->bahan_makanan_id)
                        ->select('stok','satuan','harga')->first();
                    $bahan[$result_item->bahan_makanan_id]['stok'] = $temp->stok;
                    $bahan[$result_item->bahan_makanan_id]['satuan'] = $temp->satuan;
                    $bahan[$result_item->bahan_makanan_id]['harga'] = $temp->harga;
                }

                $bahan[$result_item->bahan_makanan_id]['bb'] = $result_item->jumlah_bb;
                $bahan[$result_item->bahan_makanan_id]['bk'] = $result_item->jumlah_bk;

                $bahan[$result_item->bahan_makanan_id]['total_bb'] = 0;
                $bahan[$result_item->bahan_makanan_id]['total_bk'] = 0;
                if($bahan[$result_item->bahan_makanan_id]['bb']!=null || $bahan[$result_item->bahan_makanan_id]['bb']!='') {
                    $bahan[$result_item->bahan_makanan_id]['total_bb'] =
                        $bahan[$result_item->bahan_makanan_id]['bb'] * $query_item['jumlah'];
                }
                if($bahan[$result_item->bahan_makanan_id]['bk']!=null || $bahan[$result_item->bahan_makanan_id]['bk']!='') {
                    $bahan[$result_item->bahan_makanan_id]['total_bk'] =
                        $bahan[$result_item->bahan_makanan_id]['bk'] * $query_item['jumlah'];
                }

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
        return $bahan;
    }

/*	public function getStokBahan($query)
	{
		// /dd($query);
		$stok = [];
		foreach ($query as $query_item) 
		{
			$stok[$query_item['nama']] = BahanMakanan::where('id',$query_item['id'])
					->select('nama','stok')->get(); 
		}
		
		return $stok;
	}*/

	public function getAll()
	{
		$data = Belanja::orderBy('id','DESC')->get();
		return $data;
	}

  public function getFlag($date)
  { 
    $start = Carbon::parse($date)->startOfDay();
    $end = Carbon::parse($date)->endOfDay();
    $data = Belanja::whereBetween('created_at',[$start,$end])->get();
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
