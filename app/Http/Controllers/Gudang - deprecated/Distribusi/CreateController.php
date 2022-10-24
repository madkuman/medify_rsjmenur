<?php

namespace App\Http\Controllers\Gudang\Distribusi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Distribusi;
use App\Models\Gudang\Items;
use Illuminate\Http\Response;
use DB;
use Bugsnag;
use Auth;
use Image;
use File;
use Storage;

class CreateController extends Controller
{
  public function create(Request $request)
	{
		//dd($request);
		$client = $request->input('unit_tujuan');
		$type = $request->input('type');
		$description = $request->input('keterangan');
		//$category = $request->input('category');
		//$referral_number = $request->input('referral_number');
		$items = $request->input('barang');
		$qty = $request->input('jumlah');
		$data = array();
		//$image = $request->file('image');

		
		DB::connection('farmasi')->beginTransaction();

		try
		{
			$transaction = new Distribusi;
			$transaction->farmasi_id = $client;

			if($type == 'Kiriman')
			{
				$transaction->tipe = -1;
			}
			else
			{
				$transaction->tipe = 1;
			}
			$transaction->deskripsi = $description;
			$transaction->kategori = $type;
			//$transaction->referral_number = $referral_number;
			$transaction->status = 1;
			$transaction->created_by = Auth::user()->id;
			$transaction->verified_by = Auth::user()->id;
			$transaction->save();
			
			$i = 0;
			$total = 0;
			foreach($items as $item)
			{
				if(is_numeric($item))
				{
					if(!is_null($qty[$i])) {
						$subtotal = app('App\Http\Controllers\Gudang\LogDistribusi\CreateController')->createLog($item,$qty[$i],$transaction->id);

					}
				}
				$i++;
				$total += $subtotal;
			}

			$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
			$request->trans_id = $transaction->id;
			$request->slug = $transaction->slug;
			$request->tujuan = 0;
			$transaction->total_harga = $total;
			$transaction->save();

			//Uploading Image
			/*if ($request->hasFile('image')) {
				$img = $this->uploadImage($request,$transaction->slug);
				$transaction->foto = $img['thumb'];
			}*/

			//$transaction->total_price = $total;
			$transaction->transaksi_ptr = app('App\Http\Controllers\Farmasi\Distribusi\CreateController')->kiriman($request);
			$transaction->save();

			
			DB::connection('farmasi')->commit();
      		return redirect('gudang/distribusi/'.$transaction->slug)
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

	public function request($request, $id, $client)
	{
		//dd($client);
		$type = -1;
		$description = $request->input('keterangan');
		$category = 'Permintaan';
		$qty = $request->input('jumlah');

		$transaction = new Distribusi;
		$transaction->farmasi_id = $client;
		$transaction->tipe = $type;
		$transaction->deskripsi = $description;
		$transaction->kategori = $category;
		$transaction->status = 0;
		$transaction->created_by = Auth::user()->id;
		$transaction->transaksi_ptr = $id;
		$transaction->save();
		
		$i = 0;
		foreach($request->barang as $item)
		{
			if(is_numeric($item))
			{
				if(!is_null($qty[$i])) {
					$log_id = app('App\Http\Controllers\Gudang\LogDistribusi\CreateController')->createLog($item,$qty[$i],$transaction->id);
					//app('App\Http\Controllers\Warehouse\ItemsRecord\CreateController')->createRecord($item,$qty[$i],$log_id);
				}
			}
			$i++;
		}

		$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
		//$transaction->total_price = $total;
		$transaction->save();

		return $transaction->id;
	}

	public function retur(Request $request)
	{
		$type = $request->input('type');
		$description = $request->input('keterangan');
		$items = $request->input('barang');
		$qty = $request->input('jumlah');
		$trans_id = $request->trans_id;
		$trans_slug = $request->slug;
		$unit_tujuan = $request->tujuan;
		//dd($request);

		$distribusi = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getSingle($trans_slug);

		$transaction = new Distribusi;
		//$transaction->client = $client;
		$transaction->tipe = 1;
		$transaction->farmasi_id = $unit_tujuan;
		$transaction->deskripsi = $description;
		$transaction->transaksi_ptr = $trans_id;
		$transaction->kategori = $type;
		$transaction->status = 1;
		$transaction->created_by = Auth::user()->id;
		$transaction->save();
		
		$i = 0;
		foreach($distribusi->log as $det)
		{				
			//dd($det->detail_item->detail_item->item_template_id);
		    $temp = Items::where('item_template_id', $det->detail_item->detail_item->item_template_id)->whereDate('kadaluarsa',date('Y-m-d', strtotime($det->detail_item->kadaluarsa)))->first();
		    
		    if(is_null($temp)) {
		    	$item = app('App\Http\Controllers\Gudang\Items\CreateController')->newReturItem($det->detail_item->detail_item->item_template_id,$det->jumlah,$det->detail_item->kadaluarsa);
		    	app('App\Http\Controllers\Gudang\LogDistribusi\CreateController')->createDraftRetur($item->id,$det->jumlah,$transaction->id);
		    }
		    else {
		    	app('App\Http\Controllers\Gudang\LogDistribusi\CreateController')->createDraftRetur($temp->id,$qty[$i],$transaction->id);
		    }
		    $i++; 
		}

		$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
		$transaction->save();

  		return $transaction->id;
		
	}

}
