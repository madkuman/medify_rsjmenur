<?php

namespace App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\CatatanPengobatanPasien;

class ReadController extends Controller
{
	public function checkIfExist($kasus_id,$nama_obat, $obat_id, $aturan){

		$count = CatatanPengobatanPasien::where('kasus_id',$kasus_id)->where('aturan_pemakaian',$aturan)->where('nama_obat',$nama_obat)->get();

		if(count($count) == 0)
		{
			$count = CatatanPengobatanPasien::where('kasus_id',$kasus_id)->where('aturan_pemakaian',$aturan)->where('obat_id',$obat_id)->get();

			if(count($count) == 0) return 1;
			else return 0;
		}
		else
		{
			return 0;
		}
	}
}
