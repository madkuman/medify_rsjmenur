<?php

namespace App\Http\Controllers\Farmasi\ResepDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ResepDetail;

class DeleteController extends Controller{
	
	public function deleteDetail($id, $id_baru = null)
	{
		$resepDetail = ResepDetail::with('detail_asal')->find($id);
		if(isset($resepDetail->detail_asal)){
			$resepDetail->detail_asal->jumlah += $resepDetail->jumlah;
			$resepDetail->detail_asal->jumlah_diambil -= $resepDetail->jumlah;
			$resepDetail->detail_asal->save();
		}
		$resepDetail->delete();
	}
}