<?php

namespace App\Http\Controllers\RawatJalan\AntrianCall;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\AntrianCall;
use Auth;

class CreateController extends Controller
{
	public function create($data, $transaksi)
	{
		$call = new AntrianCall;
		$call->poliklinik_id = $transaksi->poliklinik_id;
		$call->transaksi_id = $transaksi->id;
		$call->antrian_level_id = $data['level'];
		$call->no_antrian = $transaksi->nomor_antrian;
		$call->is_bpjs = isset($data['is_bpjs']) ? $data['is_bpjs'] : 0;
		$call->created_by = Auth::user()->id;
		$call->save();

		return $call;
	}
}
