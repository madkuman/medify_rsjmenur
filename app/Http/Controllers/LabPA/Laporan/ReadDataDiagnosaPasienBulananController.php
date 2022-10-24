<?php

namespace App\Http\Controllers\LabPA\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPA\TransactionDetail;

class ReadDataDiagnosaPasienBulananController extends Controller
{
	public function get($start,$end)
	{
		$layanan_array = config('const.layanan-array-4');
		foreach($layanan_array as $item_layanan)
		{
			$lokasi_id = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug($item_layanan)->pluck('id')->toArray();
			$data['lokasi_id'][$item_layanan] = $lokasi_id;
		}
		
		$data['transaksi'] = TransactionDetail::whereHas('transaction', function($q) use($start, $end){
			$q->whereDate('result_created_at', '>=', $start)->whereDate('result_created_at', '<=', $end);  
		})->with(['transaction.pasien', 'transaction.pemeriksa'])->get();

		return $data;
	}
}
