<?php

namespace App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\CatatanPengobatanPasien;
use Auth;

class EditController extends Controller
{
	public function edit($data)
	{
		$obat = CatatanPengobatanPasien::find($data->id);
		$obat->obat_id = $data->obat_id;
		$obat->nama_obat = $data->nama_obat;
		$obat->aturan_pemakaian = $data->aturan_pemakaian;
		$obat->rute = $data->rute;
		$obat->keterangan = $data->keterangan;
		$obat->updated_by = Auth::user()->id;
		$obat->cb_segera_diberikan 	  = $data->cb_segera_diberikan ?? null;
		$obat->cb_terlambat_diberikan = $data->cb_terlambat_diberikan ?? null;
		$obat->cb_pemberian_bebas     = $data->cb_pemberian_bebas ?? null;

		$obat->save();

		return $obat;
	}
}
