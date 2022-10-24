<?php

namespace App\Http\Controllers\Keuangan\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Utang;
use App\Models\Keuangan\UtangDetail;
use App\Models\Keuangan\Pengeluaran;
use App\Models\Keuangan\PengeluaranDetail;
use App\Models\Keuangan\Perusahaan;
use Carbon\Carbon;

class UtangController extends Controller
{
	public function getAllUtang($data)
	{
		$bulan_start = $data['bulan_start'];
		$bulan_end = $data['bulan_end'];
		$bulan_prev_start = $data['bulan_prev_start'];
		$bulan_prev_end = $data['bulan_prev_end'];

		$perusahaan = Perusahaan::all();
		foreach($perusahaan as $pt)
		{
			$utang_bulan_ini = Utang::where('perusahaan_id',$pt->id)->whereBetween('created_at',array($bulan_start,$bulan_end))->get();
			$total_utang_bulan_ini = $utang_bulan_ini->sum('total');

			$utang_bulan_lalu = Utang::where('perusahaan_id',$pt->id)->where('created_at','<',$bulan_start)->get();
			$total_utang_bulan_lalu = $utang_bulan_lalu->sum('total');

			$utang_all = Utang::where('perusahaan_id',$pt->id)->get();
			$utang_all_id = $utang_all->pluck('id');

			$pembayaran_bulan_ini = Pengeluaran::whereBetween('created_at',array($bulan_start,$bulan_end))
			->whereIn('utang_id',$utang_all_id)->get();
			$total_pembayaran_bulan_ini = $pembayaran_bulan_ini->sum('total');

			$pembayaran_bulan_lalu = Pengeluaran::where('created_at','<',$bulan_start)
			->whereIn('utang_id',$utang_all_id)->get();
			$total_pembayaran_bulan_lalu = $pembayaran_bulan_lalu->sum('total');

			$pt->utang_bulan_lalu = $total_utang_bulan_lalu;
			$pt->utang_bulan_ini = $total_utang_bulan_ini;
			$pt->utang_sd_bulan_ini = $total_utang_bulan_lalu + $total_utang_bulan_ini;

			$pt->pembayaran_bulan_lalu = $total_pembayaran_bulan_lalu;
			$pt->pembayaran_bulan_ini = $total_pembayaran_bulan_ini;
			$pt->pembayaran_sd_bulan_ini = $total_pembayaran_bulan_lalu + $total_pembayaran_bulan_ini;

			$pt->sisa_utang = $pt->utang_sd_bulan_ini - $pt->pembayaran_sd_bulan_ini;

		}
		$data_return['perusahaan'] = $perusahaan;
		$data_return['bulan'] = $bulan_start->format('F Y'); 
		$data_return['tahun'] = $bulan_start->format('Y'); 
		return $data_return;


	}
}
