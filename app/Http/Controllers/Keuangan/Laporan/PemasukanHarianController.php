<?php

namespace App\Http\Controllers\Keuangan\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\PemasukanDetail;
use App\Models\Keuangan\Kategori;
use Carbon\Carbon;

class PemasukanHarianController extends Controller
{
	public function getPemasukanHarian($start,$end)
	{
		$kategori_1 = Kategori::where('type',1)->where('layer',1)->get();
		$kategori_2_array = [];
		$tanggal_array = [];
		$total = [];
		$current_date_start = $start->copy()->startOfDay();
		$array_pemasukan = [];
		while($current_date_start < $end)
		{
			$current_date_end = $current_date_start->copy()->EndOfDay();
			$temp_total = 0;
			$count = 0;
			foreach($kategori_1 as $kategori)
			{

				if(count($kategori->child) > 0)
				{
					foreach($kategori->child as $kategori_2)
					{
						if(!in_array($kategori_2->name, $kategori_2_array)) $kategori_2_array[] = $kategori_2->name;
						
						$total[$count] = PemasukanDetail::where('kategori_id',$kategori_2->id)
						->whereBetween('created_at',[$current_date_start,$current_date_end])->sum('subtotal');
						//$total[$count] = $kategori_2->name;
						$temp_total +=  $total[$count];
						$count++;
					}
				}
				else
				{
					$total[$count] = PemasukanDetail::where('kategori_id',$kategori->id)
						->whereBetween('created_at',[$current_date_start,$current_date_end])->sum('subtotal');
					//$total[$count] = $kategori->name;
					$temp_total +=  $total[$count];
					$count++;
				}

			}
			$pemasukan_total = Pemasukan::whereBetween('tanggal_transaksi',[$current_date_start,$current_date_end])->sum('total');

			$temp = new \StdClass();
			$temp->tanggal_transaksi = $current_date_start->format('d M Y');
			$temp->tanpa_kategori = $pemasukan_total - $temp_total;
			$temp->total = $pemasukan_total;
			$temp->pemasukan = $total;
			$array_pemasukan[] = $temp;
			$tanggal_array[] = $current_date_start->format('d M Y');
			$current_date_start->addDay();
		}
		$data['kategori_1'] = $kategori_1;
		$data['kategori_2'] = $kategori_2_array;
		$data['tanggal'] = $tanggal_array;
		$data['pemasukan'] = $array_pemasukan;
		return $data;
	}
}


/*RIWAYAT PEMASUKAN V1 YANG PAKE DEPARTEMEN*/
/*
	public function getPemasukanHarian($start,$end)
	{
        $length = $end->diffInDays($start);
        // dd($length);
		$pemasukan_array = [];
		$day = $start->subDay();
		// dd($days);
		for($i=0;$i<=$length;$i++)
		{
			$days[$i] = $day;
			$day = $day->addDay()->copy();
		}
		// dd($days);
		
		foreach($days as $day){
			$pemasukan = Pemasukan::select('id')->whereDate('created_at', '=', $day->toDateString())->get()->toArray();
			$temp = new \StdClass();
			$temp->date = $day->format('d F Y');;
			$temp->igd = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',1)->sum('subtotal');
			$temp->rajal = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',2)->sum('subtotal');
			$temp->ranap = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',3)->sum('subtotal');
			$temp->ok = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',5)->sum('subtotal');
			$temp->urikkes = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',10)->sum('subtotal');
			$temp->farmasi = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',11)->sum('subtotal');
			$temp->radiologi = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',8)->sum('subtotal');
			$temp->radioterapi = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',9)->sum('subtotal');
			$temp->lab_pk = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',6)->sum('subtotal');
			$temp->lab_pa = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',7)->sum('subtotal');
			$temp->gizi = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',14)->sum('subtotal');
			$temp->kamar_jenazah = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',15)->sum('subtotal');
			$temp->kereta_merta = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',16)->sum('subtotal');
			$temp->ambulance = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',17)->sum('subtotal');
			$temp->loket = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',20)->sum('subtotal');
			$temp->diklat = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',19)->sum('subtotal');
			$temp->lain = PemasukanDetail::whereIn('pemasukan_id',$pemasukan)->where('departemen_id',12)->sum('subtotal');
			array_push($pemasukan_array, $temp);
			
		}
		// dd($pemasukan_array);
		$data['pemasukan'] = $pemasukan_array;
		$data['count'] = $length + 1;
		return $data;
	}*/