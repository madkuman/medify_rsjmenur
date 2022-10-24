<?php

namespace App\Http\Controllers\Gudang\Items;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Items;
use App\Models\Gudang\ItemsTemplate;
use App\Models\Gudang\Kategori;
use App\Models\Gudang\Pengadaan;
use App\Models\Gudang\ItemsKategori;
use App\Models\Gudang\LogDistribusi;
use App\Models\Farmasi\TipeObat;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;
use Bugsnag;
use File;
use Image;

class EditController extends Controller
{
	public function edit(Request $request)
	{	
		//dd($request);
		//$image = $request->file('input_image');

		if ($request->hasFile('input_image')) {
			$file_ext = $request->input_image->extension();
			if($file_ext != 'jpeg' && $file_ext != 'png') return $response->setStatusCode(400, 'File type Invalid'); 
			$images = $this->uploadImage($request);
		}

		$item_id = $request->input('id');
		$name = $request->input('nama');
		$desc = $request->input('keterangan');
		$satuan = $request->input('satuan');
		$harga = $request->input('harga');
		$jenis = $request->input('jenis');
		$stok = $request->input('batasan_stok');
		$kadaluarsa = $request->input('batasan_kadaluarsa');
		$waktu = $request->input('satuan_waktu');
		$kategori = $request->input('kategori');

		//$array = explode(',', $kategori);

		

		try {
			$item = ItemsTemplate::find($item_id);
			$item->nama = $name;
			$item->deskripsi = $desc;
			$item->satuan = $satuan;
			$item->harga = $harga;
			$item->jenis = $jenis;
			$item->min_stok = $stok;
			$item->min_kadaluarsa = $kadaluarsa*$waktu;
			$item->save();

			//$blugori = Kategori::where('item_template_id', $item_id)->get();
			foreach ($item->items_category as $gor) {
				$gor->delete();
			}

			if($kategori)
			{
				foreach ($kategori as $arr) {
					if(!is_numeric($arr)) $arr = app('App\Http\Controllers\Gudang\Kategori\CreateController')->createByName($arr)->id;
					$gori = new ItemsKategori;
					$gori->kategori_id = $arr;
					$gori->item_template_id = $item->id;				
					$gori->save();
				}
			}

			$temp = TipeObat::where('nama',$satuan)->first();
			if(!$temp)
			{
				$tuan = new TipeObat;
				$tuan->nama = $satuan;
				$tuan->save();
			}

			
			
			return redirect('gudang/item/'.$item->slug)
				->with('status', 1)
				->with('message', 'Barang berhasil diedit')
				->with('title', 'Sukses');
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    		

	     	return redirect()->back()
	      				->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
	      				->with('status', -1)
                		->with('title', 'Gagal');
		}
		
	}

	public function editItem($item_id, $item, $qty = 0, $pengadaan_id = 0, $harga = 0, $diskon = 0, $ppn = 10, $subtotal = 0, $expired = null, $tanggal)
	{
		$pengadaan = Pengadaan::find($pengadaan_id);
		$new_log = Items::find($item_id);

		if(!is_null($expired))
		{
			$date = Carbon::createFromFormat('d/m/Y', $expired)->toDateTimeString();
		}
		else $date = null;

		$new_log->item_template_id = $item;
		$new_log->jumlah_total = $qty;
		$new_log->jumlah_sedia = $qty;
		$new_log->kadaluarsa = $date;
		$new_log->tanggal = $tanggal;
		$new_log->status = 1;
		$new_log->pengadaan_id = $pengadaan_id;
		$new_log->supplier_id = $pengadaan->supplier_id;

		$items = ItemsTemplate::find($item);
		if($harga) 
		{
			$items->harga = $harga;
			$items->save();
		}
		$new_log->harga_saat_itu = $items->harga;
		$new_log->diskon = $diskon;
		$new_log->ppn = $ppn;
		$new_log->subtotal = $items->harga * $qty;
		$new_log->save();
		
		return $new_log->subtotal;
		
	}

	public function editHarga($item_id, $template_id, $harga)
	{

		$items = ItemsTemplate::find($template_id);
		if($harga) 
		{
			$items->harga = $harga;
			$items->save();
			if($item_id != 0){
				$new_log = Items::find($item_id);
				$new_log->harga_saat_itu = $items->harga;
				$new_log->save();
			}
			app('App\Http\Controllers\Farmasi\Items\EditController')->editHarga($template_id, $harga);		
		}
	}

	public function verifyRetur($draft)
	{
		$log = Items::find($draft->item_id);
		$log->jumlah_sedia += $draft->jumlah;
		$log->status = 1;
		$log->save();

		$draft->jenis = 1;
		$draft->subtotal = $draft->jumlah * $log->detail_item->harga;
		$draft->save();

		$subtotal = $draft->subtotal;
		return $subtotal;
	}

	/*public function verifyRetur($ref, $item, $qty, $expired)
	{
		if(!is_null($expired))
		{
			$date = Carbon::createFromFormat('d/m/Y', $expired);
		}
		else $date = null;
		$draft = LogDistribusi::find($ref);
		$exp = Carbon::parse($draft->detail_item->kadaluarsa);
		if($date->isSameDay($exp) && $item == $draft->detail_item->item_template_id)
		{
			$log = Items::find($draft->item_id);
			$log->jumlah_sedia += $qty;
			$log->status = 1;
			$log->save();

			$draft->jenis = 1;
			$draft->jumlah = $qty;
			$draft->subtotal = $draft->jumlah * $log->detail_item->harga;
			$draft->save();

			$subtotal = $draft->subtotal;
		}
		else 
		{
			$log = app('App\Http\Controllers\Gudang\Items\CreateController')->newReturItem($item,$qty,$date->toDateTimeString());
			$log->jumlah_sedia = $qty;
			//$log->kadaluarsa = $date->toDateTimeString();
			$log->status = 1;
			$log->save();

			$new_log = new LogDistribusi;
			$new_log->distribusi_id = $draft->distribusi_id;
			$new_log->jumlah = $qty;
			$new_log->item_id = $log->id;
			$new_log->jenis = 1;
			$new_log->subtotal = $new_log->jumlah * $log->detail_item->harga;
			$new_log->save();

			$subtotal = $new_log->subtotal;
		}
		
		return $subtotal;
	}*/
}
