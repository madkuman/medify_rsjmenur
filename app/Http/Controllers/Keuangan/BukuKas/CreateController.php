<?php

namespace App\Http\Controllers\Keuangan\BukuKas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\BukuKas;
use Carbon\Carbon;

class CreateController extends Controller
{
	public function create()
	{
		$bk = new BukuKas;
		$start_month = Carbon::now()->startOfMonth();
		$end_month = Carbon::now()->endOfMonth();

		$bk_last = BukuKas::whereBetween('created_at',[$start_month,$end_month])->orderBy('created_at','desc')->first();
		//dd($bk_last);		
		if(!empty($bk_last->id))
		{	
			$temp = explode('/', $bk_last->no_bk);
			//dd($temp);
			$no_bk = $temp[0] + 1;
			//dd($no_bk);
		}
		else
		{
			$no_bk = 1;
		}

		$bk->no_bk = $no_bk;
		$bk->save();
		return $bk->id;
	}

	public function createManual($no_bk)
	{
		$bk = new BukuKas;
		$bk->no_bk = $no_bk;
		$bk->save();
		return $bk->id;
	}
}
