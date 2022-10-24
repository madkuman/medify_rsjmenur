<?php

namespace App\Http\Controllers\CSSD\AlkesSatuanLog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\AlkesSatuanLog;
use Auth;

class CreateController extends Controller
{
    	public function createSingle($transaksi_id,$alkes_satuan_id)
    	{
    		$log = new AlkesSatuanLog;
    		$log->transaksi_id = $transaksi_id;
    		$log->alkes_satuan_id = $alkes_satuan_id;
    		$log->created_by = Auth::user()->id;
    		$log->save();
    	}
}
