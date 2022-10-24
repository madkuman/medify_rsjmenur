<?php

namespace App\Http\Controllers\Farmasi\Produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Produksi;
use App\Models\Farmasi\Farmasi;
use Carbon\Carbon;

class ReadController extends Controller
{

	public function getAll($farmasi_id)
	{
		return Produksi::with('detail.itemFarmasi.item_detail', 'lastTransaksi')->where('farmasi_id', $farmasi_id)->orderBy('updated_at', 'desc')->get();
	}

	public function get(Request $request, $farmasi_slug)
	{
		$farmasi = Farmasi::where('slug', $farmasi_slug)->first();
		return Produksi::with('detail.itemFarmasi.item_detail', 'detail.itemFarmasi.stok', 'lastTransaksi')->where('farmasi_id', $farmasi->id)->where('nama', 'like', '%'.$request->keyword.'%')->get();
	}

	public function single($produksi_id)
	{
		return Produksi::with('detail.itemFarmasi.item_detail', 'transaksi')->where('id', $produksi_id)->first();
	}
}