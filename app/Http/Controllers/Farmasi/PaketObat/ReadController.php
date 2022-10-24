<?php

namespace App\Http\Controllers\Farmasi\PaketObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\PaketObat;

class ReadController extends Controller
{
    public function getAPI($farmasi, $id)
	{
		$paket_obat = PaketObat::where('id',$id)->with('detail.item_detail', 'detail.item_detail.item_detail')->first();
		return json_encode($paket_obat);
	}
	public function getAllAPI($farmasi)
	{
		$farm = session('farmasi');
		$paket_obat = PaketObat::where('farmasi_id', $farm->id)->with('detail.item_detail', 'detail.item_detail.item_detail')->orderBy('created_at','desc')->get();
		return json_encode($paket_obat);
	}
}
