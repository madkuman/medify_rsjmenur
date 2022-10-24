<?php

namespace App\Http\Controllers\Keuangan\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\Pengeluaran;
use Carbon\Carbon;
use DB;

class ReadController extends Controller
{
    	public function index()
    	{
			for($i=0;$i<7;$i++){
				$sevendays = Carbon::today()->subDays($i);
				$data['pemasukan'.$i] = DB::connection('keuangan')->table('pemasukan')
				->whereDate('tanggal_transaksi','=',$sevendays)
                ->sum('total');
                $data['pengeluaran'.$i] = DB::connection('keuangan')->table('pengeluaran')
				->whereDate('tanggal_transaksi','=',$sevendays)
				->sum('total');
                $data['utang'.$i] = DB::connection('keuangan')->table('utang')
                ->whereDate('tanggal_transaksi','=',$sevendays)
                ->sum('total');
                $data['piutang'.$i] = DB::connection('keuangan')->table('piutang')
                ->whereDate('tanggal_transaksi','=',$sevendays)
                ->sum('total');
                $data['day'.$i] = Carbon::today()->subDays($i)->englishDayOfWeek;
                $data['date'.$i] = Carbon::today()->subDays($i)->format('d/m/y');
			}
    		return json_encode($data);
    	}
}
