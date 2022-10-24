<?php

namespace App\Http\Controllers\Keuangan\Deposit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Deposit;
use App\Models\Keuangan\DepositLog;

class CreateController extends Controller
{
    	public function useDeposit($pasien_id,$total,$pemasukan_id)
    	{
    		$deposit = Deposit::where('pasien_id',$pasien_id)->first();
    		$log = new DepositLog;
    		$log->deposit_id = $deposit->id;
    		$log->jumlah = $total * -1;
    		$log->pemasukan_id = $pemasukan_id;
    		$log->save();

    		$deposit->jumlah = $deposit->jumlah - $total;
    		$deposit->save();
    	}

    	public function cashBackDeposit($pasien_id,$total,$pemasukan_id)
    	{
    		$deposit = Deposit::where('pasien_id',$pasien_id)->first();
    		$log = DepositLog::where('pemasukan_id',$pemasukan_id)->delete();
    		$deposit->jumlah = $deposit->jumlah + $total;
    		$deposit->save();
    	}
}
