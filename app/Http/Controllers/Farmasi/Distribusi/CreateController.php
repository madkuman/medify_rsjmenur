<?php

namespace App\Http\Controllers\Farmasi\Distribusi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Distribusi;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\Items;
use Illuminate\Http\Response;
use DB;
use Auth;
use Bugsnag;
use Image;
use File;
use Storage;

class CreateController extends Controller
{
    public function create(Request $request)
	{
		ini_set('max_execution_time', 300);
		$client = $request->input('unit_tujuan');
		$type = $request->input('type');
		$farmasi = $request->input('farmasi');
		$description = $request->input('keterangan');
		$items = $request->input('barang');
		$item_farmasi = $request->input('template');
		$qty = $request->input('jumlah');

		$farm = session('farmasi');

		DB::connection('farmasi')->beginTransaction();

		try
		{
			$transaction = new Distribusi;
			$transaction->kategori = $type;
			$transaction->farmasi_id = $farm->id;
			$transaction->unit_tujuan = $client;
			$transaction->deskripsi = $description;
			if($type == 'Permintaan') {
				$transaction->tipe = 1;
				$transaction->status = 0;
			}
			else {
				$transaction->tipe = -1;
				$transaction->status = 1;
				$transaction->verified_by = Auth::user()->id;
			}
 			$transaction->created_by = Auth::user()->id;
			$transaction->save();

			$i = 0;
			$total = 0;
			foreach($items as $item)
			{
				if(is_numeric($item))
				{
					if(!is_null($qty[$i])) {
						if($transaction->tipe == 1) {
							app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createDraft($item,$qty[$i],$transaction->id,$client);
							$subtotal = 0;
						}
						else $subtotal = app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createLogKeluar($item,$qty[$i],$transaction->id);
						$total += $subtotal;
					}
				}
				$i++;
			}

			$transaction->total_harga = $total;
			$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
			$transaction->save();

			$request->trans_id = $transaction->id;
			$request->slug = $transaction->slug;
			$request->tujuan = $farm->id;
			
			if($transaction->tipe == 1){
				$transaction->transaksi_ptr = $this->request($request);
			}else{
				$transaction->transaksi_ptr = $this->transfer($request);
			}
		
			

			$transaction->save();

			DB::connection('farmasi')->commit();

            if ($request->no_redirect) {
                return $transaction;
            }

      		return redirect('farmasi/'.$farmasi.'/distribusi/'.$transaction->slug)
						->with('status', 1)
						->with('message', 'Distribusi baru berhasil dibuat')
						->with('title', 'Sukses');
		}
		catch (\Exception $e)
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    		DB::connection('farmasi')->rollBack();

	     	return redirect()->back()
	      				->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
	      				->with('status', -1)
                		->with('title', 'Gagal');
		}
	}

	public function createForeign($request)
	{

		$type = $request->type;
		$farmasi = $request->farmasi_id;
		$description = $request->keterangan;
		$client = $request->client;
		$items = $request->barang;
		$qty = $request->jumlah;

		$transaction = new Distribusi;
		//$transaction->client = $client;
		$transaction->kategori = $type;
		$transaction->farmasi_id = $farmasi;
		$transaction->unit_tujuan = $client;
		$transaction->deskripsi = $description;
		if($type == 'Permintaan') {
			$transaction->tipe = 1;
			$transaction->status = 0;
		}
		else {
			$transaction->tipe = -1;
			$transaction->status = 2;
			$transaction->verified_by = Auth::user()->id;
		}
		$transaction->created_by = Auth::user()->id;
		$transaction->save();

		$i = 0;
		$total = 0;
		//$item_global = array();
		foreach($items as $item)
		{
			if($transaction->tipe == 1) app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createForeignDraft($item,$qty[$i],$transaction->id,$client);
			$i++;
		}

		$transaction->total_harga = $total;
		$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
		$transaction->save();

		$request->trans_id = $transaction->id;
		$request->slug = $transaction->slug;
		$request->tujuan = $farmasi;
		if($transaction->tipe == 1) $transaction->transaksi_ptr = app('App\Http\Controllers\Farmasi\Distribusi\CreateController')->foreignRequest($request);
		else if($type == 'Retur') {
			$transaction->transaksi_ptr = app('App\Http\Controllers\Farmasi\Distribusi\CreateController')->foreignRetur($request);
		}

		$transaction->save();

        return $transaction;
	}

	public function transfer(Request $request)
	{
		//$client = $request->input('client');
		$type = $request->input('type');
		//$apotek = $request->input('apotek');
		$description = $request->input('keterangan');
		$items = $request->input('barang');
		$qty = $request->input('jumlah');
		$id = $request->input('unit_tujuan');
		$trans_id = $request->trans_id;
		$trans_slug = $request->slug;
		$unit_tujuan = $request->tujuan;

		$distribusi = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getSingle($trans_slug);

		$transaction = new Distribusi;
		//$transaction->client = $client;
		$transaction->tipe = 1;
		$transaction->farmasi_id = $id;
		$transaction->deskripsi = $description;
		$transaction->transaksi_ptr = $trans_id;
		$transaction->kategori = $type;
		$transaction->status = 1;
		$transaction->unit_tujuan = $unit_tujuan;
		$transaction->created_by = Auth::user()->id;
		$transaction->save();

		/*$i = 0;
		foreach($distribusi->record as $det)
		{

		    $temp = ItemsFarmasi::where('item_template_id', $det->detail_item->detail_item->item_template_id)->where('farmasi_id', $transaction->farmasi_id)->first();
		    app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($temp->id, $det->jumlah, $transaction->id, $det->detail_item->kadaluarsa);
		}*/

		$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
		$transaction->save();

  		return $transaction->id;
	}

	public function kiriman(Request $request)
	{
		//$client = $request->input('client');
		$type = $request->input('type');
		//$apotek = $request->input('apotek');
		$description = $request->input('keterangan');
		$items = $request->input('barang');
		$qty = $request->input('jumlah');
		$id = $request->input('unit_tujuan');
		$trans_id = $request->trans_id;
		$trans_slug = $request->slug;
		$unit_tujuan = $request->tujuan;

		$distribusi = app('App\Http\Controllers\Gudang\Distribusi\ReadController')->getSingle($trans_slug);

		$transaction = new Distribusi;
		//$transaction->client = $client;
		$transaction->tipe = 1;
		$transaction->farmasi_id = $id;
		$transaction->deskripsi = $description;
		$transaction->transaksi_ptr = $trans_id;
		$transaction->kategori = $type;
		$transaction->status = 1;
		$transaction->unit_tujuan = $unit_tujuan;
		$transaction->created_by = Auth::user()->id;
		$transaction->save();

		/*$i = 0;
		foreach($distribusi->log as $det)
		{
		    $temp = ItemsFarmasi::where('item_template_id', $det->detail_item->item_template_id)->where('farmasi_id', $transaction->farmasi_id)->first();
		    app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($temp->id, $det->jumlah, $transaction->id, $det->detail_item->kadaluarsa);
		}*/

		$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
		$transaction->save();

  		return $transaction->id;
	}

	public function retur(Request $request)
	{
		$type = $request->input('type');
		$description = $request->input('keterangan');
		$items = $request->input('barang');
		$qty = $request->input('jumlah');
		$id = $request->input('unit_tujuan');
		$trans_id = $request->trans_id;
		$trans_slug = $request->slug;
		$unit_tujuan = $request->tujuan;

		$distribusi = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getSingle($trans_slug);

		$transaction = new Distribusi;
		$transaction->tipe = 1;
		$transaction->farmasi_id = $id;
		$transaction->deskripsi = $description;
		$transaction->transaksi_ptr = $trans_id;
		$transaction->kategori = $type;
		$transaction->status = 1;
		$transaction->unit_tujuan = $unit_tujuan;
		$transaction->created_by = Auth::user()->id;
		$transaction->save();

		$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
		$transaction->save();

  		return $transaction->id;
	}

	public function foreignRetur(Request $request)
	{
		$type = $request->type;
		$description = $request->keterangan;
		$items = $request->barang;
		$qty = $request->jumlah;
		$id = $request->client;
		$trans_id = $request->trans_id;
		$trans_slug = $request->slug;
		$unit_tujuan = $request->tujuan;

		$distribusi = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getSingle($trans_slug);

		$transaction = new Distribusi;
		$transaction->tipe = 1;
		$transaction->farmasi_id = $id;
		$transaction->deskripsi = $description;
		$transaction->transaksi_ptr = $trans_id;
		$transaction->kategori = $type;
		$transaction->status = 1;
		$transaction->unit_tujuan = $unit_tujuan;
		$transaction->created_by = Auth::user()->id;
		$transaction->save();

		$i = 0;
		foreach($items as $item)
		{
			$item_farmasi = ItemsFarmasi::where('item_template_id', $item)->where('farmasi_id', $transaction->farmasi_id)->first();

	    	$item = app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($item_farmasi->id, $qty[$i], $transaction->id);
	    	app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createDraftRetur($item->id,$qty[$i],$transaction->id);
		    $i++;
		}

		$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
		$transaction->save();

  		return $transaction->id;
	}

	public function request($request)
	{
		$description = $request->input('keterangan');
		$items = $request->input('barang');
		$qty = $request->input('jumlah');
		$id = $request->input('unit_tujuan');
		$trans_id = $request->trans_id;
		$trans_slug = $request->slug;
		$unit_tujuan = $request->tujuan;
		$category = 'Permintaan';

		$distribusi = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getSingle($trans_slug);

		$transaction = new Distribusi;
		$transaction->farmasi_id = $id;
		$transaction->tipe = -1;
		$transaction->deskripsi = $description;
		$transaction->kategori = $category;
		$transaction->unit_tujuan = $unit_tujuan;
		$transaction->status = 0;
		$transaction->created_by = Auth::user()->id;
		$transaction->transaksi_ptr = $trans_id;
		$transaction->save();

		/*$i = 0;
		foreach($distribusi->log as $det)
		{
		    $temp = ItemsFarmasi::where('item_template_id', $det->detail_item->item_template_id)->where('farmasi_id', $transaction->farmasi_id)->first();
		    app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($temp->id, $det->jumlah, $transaction->id, $det->detail_item->kadaluarsa);
		}*/

		$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
		//$transaction->total_price = $total;
		$transaction->save();

		return $transaction->id;
	}

	public function foreignRequest($request)
	{
		//$apotek = $request->input('apotek');
		$description = $request->keterangan;
		$items = $request->barang;
		$qty = $request->jumlah;
		$id = $request->client;
		$trans_id = $request->trans_id;
		$trans_slug = $request->slug;
		$unit_tujuan = $request->tujuan;
		$category = 'Permintaan';

		$distribusi = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getSingle($trans_slug);

		$transaction = new Distribusi;
		$transaction->farmasi_id = $id;
		$transaction->tipe = -1;
		$transaction->deskripsi = $description;
		$transaction->kategori = $category;
		$transaction->unit_tujuan = $unit_tujuan;
		$transaction->status = 1;
		$transaction->created_by = Auth::user()->id;
		$transaction->transaksi_ptr = $trans_id;
		$transaction->save();

		/*$i = 0;
		foreach($distribusi->log as $det)
		{
		    $temp = ItemsFarmasi::where('item_template_id', $det->detail_item->item_template_id)->where('farmasi_id', $transaction->farmasi_id)->first();
		    app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($temp->id, $det->jumlah, $transaction->id, $det->detail_item->kadaluarsa);
		}*/

		$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
		//$transaction->total_price = $total;
		$transaction->save();

		return $transaction->id;
	}
}
