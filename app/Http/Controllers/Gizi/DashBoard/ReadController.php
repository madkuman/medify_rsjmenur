<?php

namespace App\Http\Controllers\Gizi\DashBoard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Pemesanan;
use App\Models\Gizi\PemesananDetail;
use App\Models\Gizi\Belanja;
use Carbon\Carbon;

class ReadController extends Controller
{
  //   public function getPemesanan($start,$end,$flag)
  //   {

  //   	$pemesanan = Pemesanan::whereBetween('jadwal_pengantaran',[$start,$end])->get();
  //   	$count = 0;
    	
		// foreach ($pemesanan as $item) 
		// {
  //   		$detail = PemesananDetail::where('pemesanan_id',$item->id)
  //   					->where('waktu_makan_id',$flag)->first();
  //   		if(!is_null($detail))
  //   		{
  //   			$count++;
  //   		}
		// }
    	
  //   	return $count;
  //   }

    public function getPemesanan($start,$end,$flag)
    {   
        $pemesanan = Pemesanan::whereBetween('jadwal_pengantaran',[$start,$end])->whereHas('pemesanan_detail',function($q) use ($flag){
            $q->where('waktu_makan_id',$flag);
        })->count();
        return $pemesanan;
    }

    // public function getPemesananBulanan($start,$end)
    // {
    //     $total_harian = [];
    //     for($i=1;$i<=3;$i++)
    //     {
    //         $pemesanan = Pemesanan::withCount(['pemesanan_detail' => function($q) use ($i){
    //             $q->where('waktu_makan_id',$i);
    //         }]);
    //     }   
    // }

    public function getPemesananBulanan($start,$end)
    {
    	// $total_harian = [];
    	// $pemesanan = Pemesanan::whereBetween('jadwal_pengantaran',[$start,$end])->get();
    	// foreach ($pemesanan as $item) 
    	// {	
    	// 	for ($i=1;$i<=3;$i++) 
    	// 	{ 
    	// 		$detail = PemesananDetail::where('pemesanan_id',$item->id)
    	// 				->where('waktu_makan_id',$i)->first();
	    // 		if(!empty($detail))
	    // 		{	
	    // 			if(empty($total_harian[Carbon::parse($detail->untuk_tanggal)->format('d-m-Y')]))
	    // 			{
	    // 				$total_harian[Carbon::parse($detail->untuk_tanggal)->format('d-m-Y')] = 1;	
	    // 			}
	    // 			else
	    // 			{
	    // 				$total_harian[Carbon::parse($detail->untuk_tanggal)->format('d-m-Y')]++;
	    // 			}
	    // 		}
    	// 	}
    	// }
    	// return $total_harian;
    }

    public function getTotalBelanja($start,$end)
    {
    	//dd($start,$end);
    	$belanja = Belanja::whereBetween('confirmed_at',[$start,$end])->get();
    	$count = 0;
    	foreach ($belanja as $item) 
    	{
    		$count += $item->total_belanja;
    	}
    	return $count;
    }

    public function getBelanjaBUlanan($start,$end)
    {
    	$total_harian = [];
    	$belanja = Belanja::whereBetween('confirmed_at',[$start,$end])->get();
    	foreach ($belanja as $item) 
    	{
    		if(empty($total_harian[Carbon::parse($item->confirmed_at)->format('d-m-Y')]))
    		{
    			$total_harian[Carbon::parse($item->confirmed_at)->format('d-m-Y')] = $item->total_belanja;
    		}
    		else
    		{
    			$total_harian[Carbon::parse($item->confirmed_at)->format('d-m-Y')] += $item->total_belanja;
    		}
    	}
    	//dd($total_harian);
    	return $total_harian;
    }

    public function loadDataStatistik()
    {
        $today = Carbon::today()->startOfDay();
        $end = Carbon::today()->endOfDay();

        $data['pemesanan_pagi']=$this->getPemesanan($today,$end,1);
        $data['pemesanan_siang']=$this->getPemesanan($today,$end,2);
        $data['pemesanan_sore']=$this->getPemesanan($today,$end,3);
        $data['total_belanja']=$this->getTotalBelanja($today,$end);
        return $data;
    }
}
