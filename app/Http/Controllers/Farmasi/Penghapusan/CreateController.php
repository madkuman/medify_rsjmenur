<?php

namespace App\Http\Controllers\Farmasi\Penghapusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Penghapusan;
use Illuminate\Http\Response;
use App\Models\Farmasi\Items;
use Carbon\Carbon;
use DB;
use Auth;
use Bugsnag;
use Image;
use File;
use Storage;
use DateTime;

class CreateController extends Controller
{
  	public function create(Request $request, $farmasi)
	{	
		$description = $request->input('keterangan');
		$template = $request->input('template');
		$items = $request->input('barang');
		$qty = $request->input('jumlah');
		$tgl_pengeluaran = $request->tgl_pengeluaran ?? Carbon::now()->format('d-m-Y');
		$tgl_pengeluaran = Carbon::createFromFormat("d-m-Y",$tgl_pengeluaran);

		$farm = session('farmasi');

		DB::connection('farmasi')->beginTransaction();

		try
		{
			$transaction = new Penghapusan;
			$transaction->keterangan = $description;
			$transaction->farmasi_id = $farm->id;
			$transaction->created_by = Auth::user()->id;
			$transaction->penghapusan_jenis_id = $request->jenis_penghapusan_id ?? null;
			$transaction->surat_perintah = $request->surat_perintah ?? null;
			$transaction->tgl_pengeluaran = $tgl_pengeluaran;
			$transaction->no_pengeluaran = $request->no_pengeluaran ?? null;
			$transaction->penyedia_id = $request->penyedia_id ?? null;
			$transaction->save();
			
			$total = 0;
			$i = 0;
            $total_harga = 0;
			foreach($items as $item)
			{
				if(is_numeric($item))
				{
					if(!is_null($qty[$i])) {
						$new_log = app('App\Http\Controllers\Farmasi\LogPenghapusan\CreateController')->createLog($item,$qty[$i],$transaction->id);
						$total_harga+= $new_log->subtotal;
					}
				}
				$i++;
			}

			$transaction->total_harga = $total_harga;
			$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
			$transaction->save();

			DB::connection('farmasi')->commit();
      		return redirect('farmasi/'.$farmasi.'/penghapusan/'.$transaction->slug)
      				->with('status', 1)
              		  ->with('message', 'Penghapusan berhasil dilakukan')
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
}
