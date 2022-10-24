<?php

namespace App\Http\Controllers\Keuangan\JasaMedis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\JasaMedis;
use Carbon\Carbon;

class PostController extends Controller
{
	public function multiplepay(Request $request)
	{
		$total_paid = $request->total_paid;
		$transaksi = $request->transaksi;
		$transaksi = json_decode($transaksi);

		foreach($transaksi as $item)
		{
			$jasmed = JasaMedis::find($item->pk_id);
			$jasmed->paid_at = Carbon::now();
			$jasmed->save();
		}

		$data['type'] = 'success';
		$data['title'] = 'Berhasil';
		$data['text'] = 'Pembayaran Berhasil';
		$data['url'] = 'keuangan/jasa-medis';

		return json_encode($data);
	}
}
