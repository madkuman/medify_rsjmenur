<?php

namespace App\Http\Controllers\Kasus\Penunjang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Penunjang;

class ReadController extends Controller
{
	public function get($id)
	{
		$penunjang = Penunjang::with('permintaan')->where('kasus_id',$id)->orderBy('id','desc')->get();
		return $penunjang;
	}
	public function getHistori($kasus_id)
	{
		$penunjang = Penunjang::with('permintaan')->whereIn('kasus_id',$kasus_id)->orderBy('kasus_id','desc')->get();
		return $penunjang;
	}
	public function getDetailItem($id, $action)
	{
		$penunjang = Penunjang::find($id);
		if($action != 'current') {
			$kasus_id = $penunjang->kasus_id;
			$items = Penunjang::where('kasus_id', $kasus_id)->select('id')->get();
			$items = $items->map(function($item){
				return $item->id;
			})->toArray();
			$index = array_search($id, $items);
			if($index == 0 and $action == 'previous')
				$penunjang = Penunjang::find($items[count($items)-1]);
			else if($index == (count($items)-1) and $action == 'next')
				$penunjang = Penunjang::find($items[0]);
			else{
				if($action == 'previous')
					$penunjang = Penunjang::find($items[--$index]);
				else
					$penunjang = Penunjang::find($items[++$index]);
			}
		}
		return $penunjang;
	}
}
