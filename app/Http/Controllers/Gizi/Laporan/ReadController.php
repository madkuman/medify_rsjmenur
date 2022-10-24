<?php

namespace App\Http\Controllers\Gizi\Laporan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Gizi\PemesananDetail;
use App\Models\Gizi\Bahan;
use App\Models\Gizi\BelanjaDetail;
use App\Models\Gizi\Belanja;
use App\Models\Gizi\Pemesanan;
use App\Models\Gizi\BahanMakanan;
use App\Models\Gizi\ResepDetail;

class ReadController extends Controller
{
    /*public function getRekapResep($date1,$date2)
	{
		$date = Carbon::parse($date1)->startOfDay();
		$date_end = Carbon::parse($date2)->endOfDay();

		$sore = PemesananDetail::whereBetween('untuk_tanggal',[$date,$date_end])
	            ->where('waktu_makan_id',3)
	            ->get();
  		$pagi = PemesananDetail::whereBetween('untuk_tanggal',[$date,$date_end])
	            ->where('waktu_makan_id',2)
	            ->get();
  		$siang = PemesananDetail::whereBetween('untuk_tanggal',[$date,$date_end])
	            ->where('waktu_makan_id',1)
	            ->get();
    	$s_pagi = PemesananDetail::whereBetween('untuk_tanggal',[$date,$date_end])
	            ->where('waktu_makan_id',4)
	            ->get();
    	$s_sore = PemesananDetail::whereBetween('untuk_tanggal',[$date,$date_end])
	            ->where('waktu_makan_id',5)
	            ->get();
		
		$resep = [];

	    $resep = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($sore,$resep);
	  	$resep = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($pagi,$resep);
	   	$resep = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($siang,$resep);
	    $resep = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($s_pagi,$resep);
	    $resep = app('App\Http\Controllers\Gizi\Produksi\ReadController')->countResep($s_sore,$resep);
	    
	    $bahan = [];
	    foreach($resep as $resep_item)
	    {	
	    	$bahan = app('Appp\Http\Controllers\Gizi\Produksi\ReadController')->getRekapBahan($resep_item,$bahan);
	    }
	    dd($bahan);	
	      
	    return $resep;
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
*/	
 	public function getRekapDinas($date1,$date2)
 	{
 		$date = Carbon::parse($date1)->startOfDay();
		$date_end = Carbon::parse($date2)->endOfDay();
		
		$dinas = [1,7,10,14,15,16];
	    $hankam = [2,3,4,8,9,11,12];
	    $nonhankam = [5,6,13,20];
	    $jamkesmas = [17,18,19];
	    $pc = [32,33,34,35,36,70,71,72,73,74,75,76,77,78,79,80];
		$kering = [1,3,5,6];
		$basah = [2,4];
		$all = array_merge($dinas,$hankam,$nonhankam,$jamkesmas,$pc);
		$pemesanan['all'] = $this->getPemesanan($date,$date_end,$dinas);

		$pemesanan['dinas'] = $this->getPemesanan($date,$date_end,$dinas);
		$array = [];
		$array['menu_dinas'] = [];
		$array['all'] = [];

		$array['all'] = $this->getDetailPemesanan($pemesanan['all'],$array['all']);
		$array['menu_dinas'] = $this->getDetailPemesanan($pemesanan['dinas'],$array['menu_dinas']);

		$data['all'] = $this->countBahan($array['all']);
		$data['dinas'] = $this->countBahan($array['menu_dinas']);

		return $data;
 	}

 	public function getRekapHankam($date1,$date2)
 	{
 		$date = Carbon::parse($date1)->startOfDay();
		$date_end = Carbon::parse($date2)->endOfDay();
		
		$dinas = [1,7,10,14,15,16];
	    $hankam = [2,3,4,8,9,11,12];
	    $nonhankam = [5,6,13,20];
	    $jamkesmas = [17,18,19];
	    $pc = [32,33,34,35,36,70,71,72,73,74,75,76,77,78,79,80];
		$kering = [1,3,5,6];
		$basah = [2,4];
		$all = array_merge($dinas,$hankam,$nonhankam,$jamkesmas,$pc);
		$pemesanan['all'] = $this->getPemesanan($date,$date_end,$hankam);

		$pemesanan['hankam'] = $this->getPemesanan($date,$date_end,$hankam);

		$array = [];
		$array['menu_hankam'] = [];
		$array['all'] = [];

		$array['all'] = $this->getDetailPemesanan($pemesanan['all'],$array['all']);
		$array['menu_hankam'] = $this->getDetailPemesanan($pemesanan['hankam'],$array['menu_hankam']);

		$data['all'] = $this->countBahan($array['all']);
		$data['hankam'] = $this->countBahan($array['menu_hankam']);

		return $data;
 	}

 	public function getRekapNonHankam($date1,$date2)
 	{
 		$date = Carbon::parse($date1)->startOfDay();
		$date_end = Carbon::parse($date2)->endOfDay();
		
		$dinas = [1,7,10,14,15,16];
	    $hankam = [2,3,4,8,9,11,12];
	    $nonhankam = [5,6,13,20];
	    $jamkesmas = [17,18,19];
	    $pc = [32,33,34,35,36,70,71,72,73,74,75,76,77,78,79,80];
		$kering = [1,3,5,6];
		$basah = [2,4];
		$all = array_merge($dinas,$hankam,$nonhankam,$jamkesmas,$pc);
		$pemesanan['all'] = $this->getPemesanan($date,$date_end,$nonhankam);
		$pemesanan['nonhankam'] = $this->getPemesanan($date,$date_end,$nonhankam);

		$array = [];
		$array['menu_nonhankam'] = [];
		$array['all'] = [];

		$array['all'] = $this->getDetailPemesanan($pemesanan['all'],$array['all']);
		$array['menu_nonhankam'] = $this->getDetailPemesanan($pemesanan['nonhankam'],$array['menu_nonhankam']);

		$data['all'] = $this->countBahan($array['all']);
		$data['nonhankam'] = $this->countBahan($array['menu_nonhankam']);

		return $data;
 	}

 	public function getRekapJamkesmas($date1,$date2)
 	{
 		$date = Carbon::parse($date1)->startOfDay();
		$date_end = Carbon::parse($date2)->endOfDay();
		
		$dinas = [1,7,10,14,15,16];
	    $hankam = [2,3,4,8,9,11,12];
	    $nonhankam = [5,6,13,20];
	    $jamkesmas = [17,18,19];
	    $pc = [32,33,34,35,36,70,71,72,73,74,75,76,77,78,79,80];
		$kering = [1,3,5,6];
		$basah = [2,4];
		$all = array_merge($dinas,$hankam,$nonhankam,$jamkesmas,$pc);
		$pemesanan['all'] = $this->getPemesanan($date,$date_end,$jamkesmas);
		$pemesanan['jamkesmas'] = $this->getPemesanan($date,$date_end,$jamkesmas);

		$array = [];
		$array['menu_jamkesmas'] = [];
		$array['all'] = [];

		$array['all'] = $this->getDetailPemesanan($pemesanan['all'],$array['all']);
		$array['menu_jamkesmas'] = $this->getDetailPemesanan($pemesanan['jamkesmas'],$array['menu_jamkesmas']);

		$data['all'] = $this->countBahan($array['all']);
		$data['jamkesmas'] = $this->countBahan($array['menu_jamkesmas']);

		return $data;
 	}

 	public function getRekapPC($date1,$date2)
 	{
 		$date = Carbon::parse($date1)->startOfDay();
		$date_end = Carbon::parse($date2)->endOfDay();
		
		$dinas = [1,7,10,14,15,16];
	    $hankam = [2,3,4,8,9,11,12];
	    $nonhankam = [5,6,13,20];
	    $jamkesmas = [17,18,19];
	    $pc = [32,33,34,35,36,70,71,72,73,74,75,76,77,78,79,80];
		$kering = [1,3,5,6];
		$basah = [2,4];
		$all = array_merge($dinas,$hankam,$nonhankam,$jamkesmas,$pc);
		$pemesanan['all'] = $this->getPemesanan($date,$date_end,$pc);
		$pemesanan['pc'] = $this->getPemesanan($date,$date_end,$pc);
		
		$array = [];
		$array['menu_pc'] = [];
		$array['all'] = [];

		$array['all'] = $this->getDetailPemesanan($pemesanan['all'],$array['all']);
		$array['menu_pc'] = $this->getDetailPemesanan($pemesanan['pc'],$array['menu_pc']);

		$data['all'] = $this->countBahan($array['all']);
		$data['pc'] = $this->countBahan($array['menu_pc']);

		return $data;
 	}

 	public function getRekapBelanjaBahan($date1,$date2)
 	{
 		$date = Carbon::parse($date1)->startOfDay();
		$date_end = Carbon::parse($date2)->endOfDay();
		
		$dinas = [1,7,10,14,15,16];
	    $hankam = [2,3,4,8,9,11,12];
	    $nonhankam = [5,6,13,20];
	    $jamkesmas = [17,18,19];
	    $pc = [32,33,34,35,36,70,71,72,73,74,75,76,77,78,79,80];
		$kering = [1,3,5,6];
		$basah = [2,4];
		$all = array_merge($dinas,$hankam,$nonhankam,$jamkesmas,$pc);
		$pemesanan['all'] = $this->getPemesanan($date,$date_end,$all);
		//dd($query);
		$pemesanan['dinas'] = $this->getPemesanan($date,$date_end,$dinas);
		//dd($pemesanan['dinas']);
		$pemesanan['hankam'] = $this->getPemesanan($date,$date_end,$hankam);
		$pemesanan['nonhankam'] = $this->getPemesanan($date,$date_end,$nonhankam);
		$pemesanan['jamkesmas'] = $this->getPemesanan($date,$date_end,$jamkesmas);
		$pemesanan['pc'] = $this->getPemesanan($date,$date_end,$pc);

		$array = [];
		$array['menu_dinas'] = [];
		$array['menu_hankam'] = [];
		$array['menu_nonhankam'] = [];
		$array['menu_jamkesmas'] = [];
		$array['menu_pc'] = [];
		$array['all'] = [];
		
		$array['all'] = $this->getDetailPemesanan($pemesanan['all'],$array['all']);
		$array['menu_dinas'] = $this->getDetailPemesanan($pemesanan['dinas'],$array['menu_dinas']);
		$array['menu_hankam'] = $this->getDetailPemesanan($pemesanan['hankam'],$array['menu_hankam']);
		$array['menu_nonhankam'] = $this->getDetailPemesanan($pemesanan['nonhankam'],$array['menu_nonhankam']);
		$array['menu_jamkesmas'] = $this->getDetailPemesanan($pemesanan['jamkesmas'],$array['menu_jamkesmas']);
		$array['menu_pc'] = $this->getDetailPemesanan($pemesanan['pc'],$array['menu_pc']);

		$data['all'] = $this->countBahan($array['all']);
		$data['dinas'] = $this->countBahan($array['menu_dinas']);
		$data['hankam'] = $this->countBahan($array['menu_hankam']);
		$data['nonhankam'] = $this->countBahan($array['menu_nonhankam']);
		$data['jamkesmas'] = $this->countBahan($array['menu_jamkesmas']);
		$data['pc'] = $this->countBahan($array['menu_pc']);
		//dd($data);
		//$data['bahan'] = BahanMakanan::all();
		
		
		return $data;
 	}

 	private function getDetailPemesanan($pemesanan,$array)
 	{
 		foreach ($pemesanan as $item) 
 		{
 			$query = PemesananDetail::where('pemesanan_id',$item->id)
 					->get();
 			foreach ($query as $resep) 
 			{
 				if(empty($array[$resep->resep_id]))
 				{
					$array[$resep->resep_id]['id'] = $resep->resep_id;
					$array[$resep->resep_id]['jumlah'] = 1;
					$array[$resep->resep_id]['nama'] = $resep->resep->nama;
 				}
 				else
 				{
 					$array[$resep->resep_id]['jumlah'] += 1;
 				}
 			}
 		}
 		return $array;
 	}

 	/*private function akhir($bahan,$menu)
 	{
 		$data = [];
 		foreach ($bahan as $item) 
 		{
 			
 		}
 	}*/

 	private function countBahan($query)
    {
      $bahan = [];
      //dd($query);
      foreach ($query as $query_item) 
      {	
        $result = ResepDetail::where('resep_id',$query_item['id'])->orderBy('bahan_makanan_id')->get();
        $count = 0;
        foreach ($result as $result_item) 
        {
          $temp = BahanMakanan::where('id',$result_item->bahan_makanan_id)->first();
            if($temp->jenis_bahan_id == 1)
            {
            	$jenis = 'bahan_kering';
            }
            else if($temp->jenis_bahan_id == 2)
            {
            	$jenis = 'sayur_mayur';
            }
            else if($temp->jenis_bahan_id == 3)
            {
            	$jenis = 'bumbu';
            }
            else if($temp->jenis_bahan_id == 4)
            {
            	$jenis = 'lauk_pauk';
            }
            else if($temp->jenis_bahan_id == 5)
            {
            	$jenis = 'buah';
            }
            else if($temp->jenis_bahan_id == 6)
            {
            	$jenis = 'lain';
            }
          if(empty($bahan[$jenis][$result_item->bahan_makanan_id]))
          {
            
            $bahan[$jenis][$result_item->bahan_makanan_id]['id'] = $result_item->bahan_makanan_id;
            $bahan[$jenis][$result_item->bahan_makanan_id]['nama'] = $result_item->bahan_makanan->nama;
            
            $bahan[$jenis][$result_item->bahan_makanan_id]['stok'] = $temp->stok;
            $bahan[$jenis][$result_item->bahan_makanan_id]['satuan'] = $temp->satuan;
            $bahan[$jenis][$result_item->bahan_makanan_id]['harga'] = $temp->harga;
            $bahan[$jenis][$result_item->bahan_makanan_id]['jenis_bahan_id'] = $temp->jenis_bahan_id;
          }

          $bahan[$jenis][$result_item->bahan_makanan_id]['bb'] = $result_item->jumlah_bb;
          $bahan[$jenis][$result_item->bahan_makanan_id]['bk'] = $result_item->jumlah_bk;
          
          $bahan[$jenis][$result_item->bahan_makanan_id]['total_bb'] = 0;
          $bahan[$jenis][$result_item->bahan_makanan_id]['total_bk'] = 0;

          if($bahan[$jenis][$result_item->bahan_makanan_id]['bb'] != null || $bahan[$jenis][$result_item->bahan_makanan_id]['bb'] !=''){
          $bahan[$jenis][$result_item->bahan_makanan_id]['total_bb'] =
          $bahan[$jenis][$result_item->bahan_makanan_id]['bb'] * $query_item['jumlah'];
          }
          if($bahan[$jenis][$result_item->bahan_makanan_id]['bk'] != null|| $bahan[$jenis][$result_item->bahan_makanan_id]['bk'] != ''){
          $bahan[$jenis][$result_item->bahan_makanan_id]['total_bk'] =
          $bahan[$jenis][$result_item->bahan_makanan_id]['bk'] * $query_item['jumlah'];
          }

          if(empty($bahan[$jenis][$result_item->bahan_makanan_id]['total_bb_final']))
          {
            $bahan[$jenis][$result_item->bahan_makanan_id]['total_bb_final'] = 
            $bahan[$jenis][$result_item->bahan_makanan_id]['total_bb'];
            $bahan[$jenis][$result_item->bahan_makanan_id]['total_bk_final'] =
            $bahan[$jenis][$result_item->bahan_makanan_id]['total_bk']; 
          }
          else
          {
            $bahan[$jenis][$result_item->bahan_makanan_id]['total_bb_final'] += 
            $bahan[$jenis][$result_item->bahan_makanan_id]['total_bb'];
            $bahan[$jenis][$result_item->bahan_makanan_id]['total_bk_final'] +=
            $bahan[$jenis][$result_item->bahan_makanan_id]['total_bk'];
          }
        }
      }
        return $bahan;
    }

 	private function getPemesanan($date,$date_end,$jenis)
 	{
 		$query = Pemesanan::whereBetween('jadwal_pengantaran',[$date,$date_end])
				->whereHas('pembayaran',function($q) use ($jenis){
					$q->from(config('app.db_name').'_patients.pasien_pembayaran')
					->whereIn('perusahaan_id',$jenis);
				})->get();

		return $query;
 	}

 	/*public function getRekapBelanjaBahan($date1,$date2)
 	{
 		$date = Carbon::parse($date1)->startOfDay();
		$date_end = Carbon::parse($date2)->endOfDay();

		$query = Belanja::whereBetween('confirmed_at',[$date,$date_end])->get();
		
		$bahan = [];
		$bahan = app('App\Http\Controllers\Gizi\Laporan\ReadController')->countBahan($query,$bahan);
		
		return $bahan;
 	}

 	public function countBahan($query,$array)
 	{
 		$array['total_akhir'] = 0;
 		foreach ($query as $query_item) 
 		{
 			$bahan = BelanjaDetail::where('belanja_id',$query_item->id)->get();
 			foreach ($bahan as $bahan_item) 
 			{	

 				if(empty($array[$bahan_item->bahan_makanan_id]))
 				{	
 					$array[$bahan_item->bahan_makanan_id]['id'] = $bahan_item->bahan_makanan_id;
 					$array[$bahan_item->bahan_makanan_id]['nama'] = $bahan_item->detail_bahan->nama;
 					$array[$bahan_item->bahan_makanan_id]['berat'] = 0;
 					$array[$bahan_item->bahan_makanan_id]['harga'] = 0;
 					$array[$bahan_item->bahan_makanan_id]['satuan'] = $bahan_item->detail_bahan->satuan;
 					$array[$bahan_item->bahan_makanan_id]['harga_satuan'] = $bahan_item->detail_bahan->harga;
 				}
 				$array[$bahan_item->bahan_makanan_id]['berat'] += $bahan_item->jumlah_realisasi;
 				$array[$bahan_item->bahan_makanan_id]['harga'] += $bahan_item->total_satuan;
 				$array['total_akhir'] += $array[$bahan_item->bahan_makanan_id]['harga'];
 			}
 		}
 		
 		return $array;
 	}*/
}
