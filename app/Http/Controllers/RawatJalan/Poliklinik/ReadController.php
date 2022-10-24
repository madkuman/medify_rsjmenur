<?php

namespace App\Http\Controllers\RawatJalan\Poliklinik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Models\RawatJalan\Poliklinik;

class ReadController extends Controller
{
	public function getAll()
	{
		$items = Poliklinik::all();
		return json_encode(['data' => $items]);
	}


	public function get($id)
	{
		$items = Poliklinik::find($id);
		return $items;
	}

	public function allPoliPrint($is_count = false)
	{
		if (!$is_count)
			$items = Poliklinik::all();
		else
			$items = Poliklinik::count();
		return $items;
	}

	public function getPoliBySkip($take, $skip = null)
	{
		$items = Poliklinik::take($take);
		if ($skip)
			$items->skip($skip);

		return $items->get();
	}

	public function getPoliAllName()
	{
		$poli = Poliklinik::pluck('name', 'id');
		return $poli;
	}

	public function getBPJS($kode_bpjs)
	{
		return Poliklinik::where('bpjs_id', $kode_bpjs)->first();
	}


	public function antrianPoliAPI($id)
	{
		app('debugbar')->disable();
		$poli = Poliklinik::with('antrian_terakhir', 'antrian_sedang_dilayani')->find($id);
		return json_encode($poli);
	}
}
