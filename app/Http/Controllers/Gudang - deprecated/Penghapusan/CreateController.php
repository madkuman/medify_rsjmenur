<?php

namespace App\Http\Controllers\Gudang\Penghapusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Penghapusan;
use Illuminate\Http\Response;
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
  	public function create(Request $request)
	{	
		//dd($request);
		$description = $request->input('keterangan');
		$template = $request->input('template');
		$items = $request->input('barang');
		$qty = $request->input('jumlah');

		

		try
		{
			$transaction = new Penghapusan;
			$transaction->keterangan = $description;
			$transaction->created_by = Auth::user()->id;
			$transaction->save();
			
			$total = 0;
			$i = 0;
			foreach($items as $item)
			{
				if(is_numeric($item))
				{
					if(!is_null($qty[$i])) {
						app('App\Http\Controllers\Gudang\LogPenghapusan\CreateController')->createLog($item,$qty[$i],$transaction->id);
					}
				}
				$i++;
			}

			$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
			$transaction->save();

			
      		return redirect('gudang/penghapusan/'.$transaction->slug)
      				->with('status', 1)
              		  ->with('message', 'Penghapusan berhasil dilakukan')
                		->with('title', 'Sukses');
		}
		catch (\Exception $e) 
		{
	    	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    		
	    	//dd(Auth::user()->id);
	    	if(!empty($transaction->id))
	    	{
		    	$transaction = Penghapusan::find($transaction->id);
		    	$transaction->delete();
	    	}

	      return redirect()->back()
	      				->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
	      				->with('status', -1)
                		->with('title', 'Gagal');
		}
	}
}
