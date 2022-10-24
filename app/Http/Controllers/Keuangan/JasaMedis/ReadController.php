<?php

namespace App\Http\Controllers\Keuangan\JasaMedis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\JasaMedis;
use Yajra\DataTables\DataTables;
use DB;
use Carbon\Carbon;

class ReadController extends Controller
{
	public function index(Request $request)
	{
		$jasmed = JasaMedis::where('paid_at',null)->get();
		foreach($jasmed as $item)
		{
			if($item->group_id == NULL)
			{
				$item->username = $item->user->name;
			}
			else
				$item->username = $item->grup->name;
		}

		return DataTables::of($jasmed)
		->addColumn('id', function (JasaMedis $item) {
			return $item->id;
		})
		->addColumn('username', function(JasaMedis $item){
			return $item->username = $item->user->name;
		})
		->addColumn('created_at', function (JasaMedis $item) {
			return $item->created_at_formatted;
		})
		->addColumn('deskripsi', function (JasaMedis $item) {
			return $item->deskripsi;
		})
		->addColumn('total', function (JasaMedis $item) {
			return $item->total;
		})
		->addColumn('bayar', function (JasaMedis $item) {
			return 'unpaid-'.$item->total;
		})
		->toJson();
	}

	public function getUnpaidJasaMedis($user_id)
	{
		$data = JasaMedis::where('user_id',$user_id)->where('paid_at',NULL)->orderBy('id','desc')->get();

		$total = JasaMedis::where('user_id',$user_id)->where('paid_at',NULL)->sum('total');
		if($total <= 50000000) $pph = 5;
		elseif($total > 50000000 && $total <= 250000000) $pph = 10;
		elseif($total > 250000000 && $total <= 500000000) $pph = 10;
		elseif($total > 50000000 ) $pph = 30;


		foreach ($data as $item) {
			$item->pph = $item->total*$pph/100;
			$item->pph_persentase = $pph;
			$item->netto = $item->total - $item->pph;
		}

		return $data;
	}

	public function getPaidJasaMedis($user_id)
	{
		$data = JasaMedis::where('user_id',$user_id)->where('paid_at','!=',NULL)->orderBy('id','desc')->get();

		$total = JasaMedis::where('user_id',$user_id)->where('paid_at','!=',NULL)->sum('total');
		if($total <= 50000000) $pph = 5;
		elseif($total > 50000000 && $total <= 250000000) $pph = 10;
		elseif($total > 250000000 && $total <= 500000000) $pph = 10;
		elseif($total > 50000000 ) $pph = 30;


		foreach ($data as $item) {
			$item->pph = $item->total*$pph/100;
			$item->pph_persentase = $pph;
			$item->netto = $item->total - $item->pph;
		}

		$grouped = $data->groupBy(function($d) {
			return Carbon::parse($d->paid_at)->format('F Y');
		});
		
		return $grouped;
	}
}
