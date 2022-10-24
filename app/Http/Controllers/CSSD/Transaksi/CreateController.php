<?php

namespace App\Http\Controllers\CSSD\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\Transaksi;
use Auth;

class CreateController extends Controller
{
    	public function create($data)
    	{
    		$transaksi = new Transaksi;
    		$transaksi->type = $data['type'];
    		$transaksi->ok_transaksi_id = $data['ok_transaksi_id'];
    		$transaksi->status = $data['status'];
    		$transaksi->keterangan = $data['keterangan'];
    		$transaksi->created_by = Auth::user()->id;
    		$transaksi->save();

    		return $transaksi;
    	}
}
