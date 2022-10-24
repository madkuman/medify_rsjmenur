<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;

class PersalinanBulananController extends Controller
{
	public function get($start,$end)
	{
		$persalinan = AlatBantu::whereBetween('created_at',[$start,$end])->where('type','Persalinan')->with('children','kasus.pasien.alamat_kecamatan','kasus.pasien.alamat_kota','kasus.identitas')->get();
		return $persalinan;

	}
}
