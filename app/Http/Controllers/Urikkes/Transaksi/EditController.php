<?php

namespace App\Http\Controllers\Urikkes\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Urikkes\Transaksi;

class EditController extends Controller
{
	
    public function simpanRetribusi($retribusi,$transaksi_id)
    {
        $transaksi = Transaksi::find($transaksi_id);
        $transaksi->retribusi_list = $retribusi;
        $transaksi->save();
        return $transaksi;
    }
}
