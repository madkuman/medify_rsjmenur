<?php

namespace App\Http\Controllers\CSSD\AlkesSatuanLog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\AlkesSatuanLog;
use Auth;

class DeleteController extends Controller
{
    	public function delete($transaksi_id,$alkes_id)
    	{
    		AlkesSatuanLog::where('transaksi_id',$transaksi_id)->where('alkes_satuan_id',$alkes_id)->delete();
    		return 1;
    	}
}
