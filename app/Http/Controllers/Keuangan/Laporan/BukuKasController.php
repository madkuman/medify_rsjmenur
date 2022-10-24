<?php

namespace App\Http\Controllers\Keuangan\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\Pengeluaran;
use Carbon\Carbon;
use DB;

class BukuKasController extends Controller
{
    public function get($data)
	{
		$bulan_start = $data['bulan_start'];
		$bulan_end = $data['bulan_end'];

		$pemasukan = Pemasukan::select('id','judul','total','akun_id','tanggal_transaksi')->with('akun')
					->addSelect(DB::raw("'1' as flag"))
					->whereBetween('created_at',array($bulan_start,$bulan_end))->get();
		$pengeluaran = Pengeluaran::select('id','judul','total','akun_id','tanggal_transaksi')->with('akun')
					->addSelect(DB::raw("'2' as flag"))
					->whereBetween('created_at',array($bulan_start,$bulan_end))->get();
		
        $kas = array_merge($pemasukan->toArray(), $pengeluaran->toArray());
		$kas = collect($kas)->sortBy('tanggal_transaksi')->values();
		$count = count($kas);
		$perpage = 30;
		$page = ceil($count/$perpage);

		$pemasukan_prev = Pemasukan::where('created_at','<',$bulan_start)->sum('total');
		$pengeluaran_prev = Pengeluaran::where('created_at','<',$bulan_start)->sum('total');
		$total_sisa = $pemasukan_prev - $pengeluaran_prev;
		if($total_sisa >= 0){
			$sisa['total'] = $total_sisa;
			$sisa['flag'] = '1';
		}
		else{
			$sisa['total'] = 0 - $total_sisa;
			$sisa['flag'] = '2';
		}

		for($i=0;$i<$page;$i++){
			$total[$i]['debet'] = $kas->slice(0, ($i+1)*$perpage)->where('flag','2')->sum('total');
			$total[$i]['kredit'] = $kas->slice(0, ($i+1)*$perpage)->where('flag','1')->sum('total');
			$total[$i]['tunai_debet'] = $kas->slice(0, ($i+1)*$perpage)->where('akun_id',1)->where('flag','2')->sum('total');
			$total[$i]['tunai_kredit'] = $kas->slice(0, ($i+1)*$perpage)->where('akun_id',1)->where('flag','1')->sum('total');
			$total[$i]['mandiri_debet'] = $kas->slice(0, ($i+1)*$perpage)->where('akun_id',3)->where('flag','2')->sum('total');
			$total[$i]['mandiri_kredit'] = $kas->slice(0, ($i+1)*$perpage)->where('akun_id',3)->where('flag','1')->sum('total');
			$total[$i]['bni_debet'] = $kas->slice(0, ($i+1)*$perpage)->where('akun_id',2)->where('flag','2')->sum('total');
			$total[$i]['bni_kredit'] = $kas->slice(0, ($i+1)*$perpage)->where('akun_id',2)->where('flag','1')->sum('total');
			
			if($sisa['flag']=='2')
				$total[$i]['debet'] = $total[$i]['debet'] + $sisa['total'];
			else
				$total[$i]['kredit'] = $total[$i]['kredit'] + $sisa['total'];
			
		}

		// $total = collect($total);
		// $total_all['debet'] = $total->sum('debet');
		// $total_all['kredit'] = $total->sum('kredit');
		// $total_all['tunai_debet'] = $total->sum('tunai_debet');
		// $total_all['tunai_kredit'] = $total->sum('tunai_kredit');
		// $total_all['mandiri_debet'] = $total->sum('mandiri_debet');
		// $total_all['mandiri_kredit'] = $total->sum('mandiri_kredit');
		// $total_all['bni_debet'] = $total->sum('bni_debet');
		// $total_all['bni_kredit'] = $total->sum('bni_kredit');
		
		$data_return['kas'] = $kas;
		$data_return['sisa'] = $sisa;
		$data_return['count'] = $count;
		$data_return['perpage'] = $perpage;
		$data_return['page'] = $page;
		$data_return['total'] = $total;
		// $data_return['total_all'] = $total_all;
		$data_return['bulan'] = $bulan_start->format('F Y'); 
		$data_return['tahun'] = $bulan_start->format('Y'); 
		return $data_return;
	}
}
