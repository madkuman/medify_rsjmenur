<?php

namespace App\Http\Controllers\Keuangan\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\Pengeluaran;
use App\Models\Keuangan\Utang;
use App\Models\Keuangan\Piutang;
use Carbon\Carbon;
use DB;

class ViewController extends Controller
{
    	public function index()
    	{
			$data['sidebar_active'] = "dashboard";
			$today = Carbon::today();
			$data['pemasukan_total'] = Pemasukan::where('tanggal_transaksi','>',$today)->sum('total');
			$data['pengeluaran_total'] = Pengeluaran::where('tanggal_transaksi','>',$today)->sum('total');
			$data['utang_total'] = Utang::where('tanggal_transaksi','>',$today)->sum('total');
			$data['piutang_total'] = Piutang::where('tanggal_transaksi','>',$today)->sum('total');
			
    		return view('keuangan.dashboard.index',$data);
    	}
}
