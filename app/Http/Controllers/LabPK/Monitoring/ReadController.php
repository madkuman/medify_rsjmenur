<?php

namespace App\Http\Controllers\LabPK\Monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Transaksi;
use App\Models\LabPK\TransaksiDetail;
use App\Models\LabPK\Form;
use App\Models\LabPK\Hasil;
use App\Models\LabPK\FormDetail;
use Carbon\Carbon;

class ReadController extends Controller
{
	public function getData(Request $request)
	{
		$pasien_id = $request->pasien_id;
		$parameter = $request->parameter;
		$date1 = Carbon::createFromFormat('d-m-Y', $request->start_date)->startOfDay();
		$date2 = Carbon::createFromFormat('d-m-Y', $request->end_date)->endOfDay();

		$form_detail_ids = FormDetail::where('form_id',$parameter)->pluck('id')->toArray();

		$hasil = 
		Hasil::leftJoin('transaksi_detail','transaksi_detail.id','=','hasil.transaksi_detail_id')
		->leftJoin('transaksi','transaksi.id','=','transaksi_detail.transaksi_id')
		->whereBetween('transaksi.result_created_at',[$date1,$date2])
		->whereIn('form_detail_id',$form_detail_ids)
		->where('transaksi.pasien_id',$pasien_id)
		->get();

		$data = [];

		foreach($hasil as $item)
		{
			$temp = new \stdClass();
			$temp->date = Carbon::parse($item->result_created_at)->format('Y-m-d H:i');
			$temp->value = floatval($item->value);
			$temp->satuan = $item->satuan;
			$temp->parameter = $item->parameter;
			$data[] = $temp;
		}

		return json_encode($data);

	}	
}
