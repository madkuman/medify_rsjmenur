<?php

namespace App\Http\Controllers\Farmasi\Produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\Produksi;
use App\Models\Farmasi\ProduksiDetail;
use App\Models\Farmasi\ProduksiTransaksi;
use App\Models\Farmasi\ProduksiTransaksiDetail;
use Carbon\Carbon;
use Auth;

class EditController extends Controller
{
	
	public function edit($data)
	{
		if(!is_object($data))
			$data = (object) $data;
		$produksi = Produksi::find($data->produksi_id);
		$produksi->nama = $data->nama_produksi;
		$produksi->farmasi_id = $data->farmasi->id;
		$produksi->tipe = $data->tipe_produksi;
		$produksi->created_by = Auth::id();
		$produksi->save();

		foreach ($data->barang_produksi as $index => $barang) {
			$barang_obj = json_decode($barang);
			if($data->is_deleted[$index] == 1)
				ProduksiDetail::find($data->detail_produksi_id[$index])->delete();
			elseif($data->detail_produksi_id[$index] != 0){
				$detail = ProduksiDetail::find($data->detail_produksi_id[$index]);
				$detail->produksi_id = $produksi->id;
				$detail->item_farmasi_id = $barang_obj->id;
				$detail->jumlah = $data->barang_jumlah[$index];
				$detail->save();
			}else{
				$detail = new ProduksiDetail;
				$detail->produksi_id = $produksi->id;
				$detail->item_farmasi_id = $barang_obj->id;
				$detail->jumlah = $data->barang_jumlah[$index];
				$detail->save();
			}
		}

		app('App\Http\Controllers\Farmasi\Produksi\CreateController')->createTransaksi($produksi->id, $data);
	}
}