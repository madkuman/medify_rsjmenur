<?php

namespace App\Http\Controllers\Farmasi\AturanObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\AturanObat;
use DB;
use Response;

class ReadController extends Controller
{
	public function getAll()
	{
		$aturan = AturanObat::get();

		return $aturan;
	}

	public function getHasUsage(){
		$usage = AturanObat::whereNotNull('usage_per_day')->pluck('nama');
		return json_encode($usage);
	}
	public function searchHasUsage(Request $request){
		$usage = AturanObat::whereNotNull('usage_per_day')->where('nama' , 'like', '%'.$request->keyword.'%')->selectRaw('nama as ids, nama as text')->get();
		$result = [];
		foreach ($usage as $key => $item){
		    $result[$key]['id']=$item->ids;
            $result[$key]['text']=$item->text;
        }
		return json_encode($result);
	}
}
