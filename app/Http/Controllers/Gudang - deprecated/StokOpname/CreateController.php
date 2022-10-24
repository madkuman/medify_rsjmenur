<?php

namespace App\Http\Controllers\Gudang\StokOpname;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\StokOpname;
use DB;
use Auth;

class CreateController extends Controller
{
    public function create(Request $request)
	{	
		// dd($request);
		if($request->tipe == 'satuan')
		{
			$flag = 1;
		}
		else
		{
			$flag = 0;
		}
		$description = $request->input('deskripsi');
		$items = $request->input('barang');
		$qty = $request->input('jumlah');
		$kadaluarsa = $request->input('kadaluarsa');
		$keterangan = $request->input('keterangan');

		

		try
		{
			$transaction = new StokOpname;
			$transaction->keterangan = $description;
			$transaction->status = 0;
			$transaction->created_by = Auth::user()->id;
			$transaction->flag = $flag;
			$transaction->save();

			$i=0;
			/*foreach ($items as $item) {
				$date = Carbon::createFromFormat('d/m/Y', $kadaluarsa[$i])->toDateTimeString();

				$detail = new OpnameDetail;
				$detail->keterangan = $keterangan[$i];
				$detail->jumlah = $qty[$i];
				$detail->farmasi_id = $farm->id;
				$detail->item_id = $item;
				$detail->kadaluarsa = $date;
				$detail->stok_opname_id = $transaction->id;
				$detail->created_by = Auth::user()->id;
				$detail->save();
				$i++;
			}*/

			$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
			$transaction->save();

			
      		return redirect('gudang/stokopname/'.$transaction->slug.'/'.$flag)
      				->with('status', 1)
              		->with('message', 'Stok Opname baru berhasil dibuat')
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
}
