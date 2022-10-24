<?php

namespace App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\CatatanPengobatanPasien;
use Auth;

class CreateController extends Controller
{
	public function create($data,$kasus_id)
	{
		$obat = new CatatanPengobatanPasien;
		$obat->obat_id = $data->obat_id;
		$obat->nama_obat = $data->nama_obat;
		$obat->aturan_pemakaian = $data->aturan_pemakaian;
		$obat->rute = $data->rute;
		$obat->keterangan = $data->keterangan;
		$obat->kasus_id = $kasus_id;
		$obat->created_by = Auth::user()->id;
		$obat->save();

		return $obat;
	}
}
