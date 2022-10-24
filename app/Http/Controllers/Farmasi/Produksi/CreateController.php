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

class CreateController extends Controller
{
	public function create($data)
	{
		if(!is_object($data))
			$data = (object) $data;
		// dd($data);
		$produksi = new Produksi;
		$produksi->nama = $data->nama_produksi;
		$produksi->farmasi_id = $data->farmasi->id;
		$produksi->tipe = $data->tipe_produksi;
		$produksi->created_by = Auth::id();
		$produksi->save();

		foreach ($data->barang_produksi as $index => $barang) {
			$barang_obj = json_decode($barang);
			$detail = new ProduksiDetail;
			$detail->produksi_id = $produksi->id;
			$detail->item_farmasi_id = $barang_obj->id;
			$detail->jumlah = $data->barang_jumlah[$index];
			$detail->save();
		}

		$this->createTransaksi($produksi->id, $data);
	}

	public function createTransaksi($produksi_id, $data)
	{
		$ed = $data->ed;
		$tanggal_kadaluarsa = implode('-', array_reverse(explode('/', $ed)));
		$produksi = Produksi::find($produksi_id);
		// dd($tanggal_kadaluarsa, $produksi, $data);
		$transaksi = new ProduksiTransaksi;
		$transaksi->produksi_id = $produksi_id;
		$transaksi->kadaluarsa = $tanggal_kadaluarsa;
		$transaksi->jumlah = $data->jumlah;
		$transaksi->harga = $data->harga_produksi;
		$transaksi->created_by = Auth::id();
		$transaksi->save();
		foreach ($data->barang_produksi as $index => $barang) {
			$barang_obj = json_decode($barang);
			$qty = $data->barang_jumlah[$index];
			while($qty)
			{
				$log = Items::where('item_farmasi_id',$barang_obj->id)->where('jumlah','>',0)->where('kadaluarsa', '>' , Carbon::today())->orderBy('kadaluarsa')->get();
				
				if($log[0]->jumlah >= $qty)
				{
					$detail = new ProduksiTransaksiDetail;
					$detail->produksi_transaksi_id = $transaksi->id;
					$detail->items_id = $log[0]->id;
					$detail->jumlah = $qty;
					$detail->save();

					$log[0]->jumlah -= $qty;
					$qty = 0;
				}
				else
				{
					$detail = new ProduksiTransaksiDetail;
					$detail->produksi_transaksi_id = $transaksi->id;
					$detail->items_id = $log[0]->id;
					$detail->jumlah = $log[0]->jumlah;
					$detail->save();

					$qty -= $log[0]->jumlah;
					$log[0]->jumlah = 0;
				}
				
				$log[0]->save();
			}
		}
		$request = new Request;
		$request->merge(['nama' => $produksi->nama]);
		$request->merge(['keterangan' => "Produksi ".$data->farmasi->nama]);
		$request->merge(['satuan' => $produksi->tipe]);
		$request->merge(['harga' => $data->harga_produksi]);
		$request->merge(['jenis' => "Obat"]);
		$request->merge(['batasan_stok' => 0]);
		$request->merge(['batasan_kadaluarsa' => 0]);
		$request->merge(['satuan_waktu' => 1]);

		if(!$produksi->item_template_id){
			$obat = app('App\Http\Controllers\Farmasi\Items\CreateController')->createAPI($request, $data->farmasi->id);
			$obat_id = $obat->id;
			$produksi->item_template_id = $obat_id;
			$produksi->save();
		}else{
			$obat_id = $produksi->item_template_id;
		}
		$obat_farmasi = ItemsFarmasi::where('farmasi_id', $data->farmasi->id)
		->where('item_template_id', $obat_id)->first();
		app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($obat_farmasi->id, $data->jumlah, $ed , $data->farmasi->id, 0);

	}
}
