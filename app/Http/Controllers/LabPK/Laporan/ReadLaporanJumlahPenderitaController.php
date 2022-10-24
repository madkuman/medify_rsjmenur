<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\TransaksiDetail;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifMaster;
use App\Models\Urikkes\Paket;
use DB;

class ReadLaporanJumlahPenderitaController extends Controller
{
	public function get($start,$end)
	{
		$labpk = config('const.lab-pk');

		$data = [];

        $lokasi_rawat_inap = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap']);
        $data['rawat_inap'] = $this->getData($start,$end,$lokasi_rawat_inap);

        $lokasi_rawat_jalan = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-jalan']);
        $data['rawat_jalan'] = $this->getData($start,$end,$lokasi_rawat_jalan);

        $lokasi_igd = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['igd']);
        $data['igd'] = $this->getData($start,$end,$lokasi_igd);

        $data['medical_checkup'] = $this->getDataMedicalCheckup($start,$end);

        return $data;
	}

	private function getData($start,$end,$lokasi_list)
	{
		$data = [];
		foreach($lokasi_list as $lokasi)
		{
			$temp = [];
			$temp['lokasi'] = $lokasi->nama;

			$transaksi = TransaksiDetail::where('transaksi_detail.status', 'done')
			->leftJoin('transaksi','transaksi.id','=','transaksi_detail.transaksi_id')
			->whereDate('transaksi.result_created_at', '>=', $start)
			->whereDate('transaksi.result_created_at', '<=', $end)
			->whereIn('transaksi.lokasi_id', [$lokasi->id])
			->count();	

			$total = $transaksi;

			$temp['total'] = $total;

			$data[] = $temp;
		}

		return $data;
	}

	private function getDataMedicalCheckup($start,$end)
	{
		$temp_start_of_month = $start->startOfMonth()->format('Y-m-d');
		$temp_end_of_month = $end->endOfMonth()->format('Y-m-d');
		$db_name = config('app.db_name');

		$query = "SELECT p.id, COUNT(1) as total FROM 
		`".$db_name."_kasus`.kasus k,
		`".$db_name."_urikkes`.transaksi t,
		`".$db_name."_urikkes`.transaksi_detail td,
		`".$db_name."_urikkes`.paket p,
		`".$db_name."_lab_pk`.transaksi t_labpk
		WHERE t.kasus_id = k.id
		AND t.id = td.transaksi_id
		AND td.paket_id = p.id
		AND t_labpk.kasus_id = k.id
		AND t_labpk.created_at BETWEEN CAST('$temp_start_of_month' AS DATE) 
		AND CAST('$temp_end_of_month' AS DATE)
		GROUP BY p.id;";

		$result = DB::connection('lab_pk')->select($query);
		
		$data = [];
		$exclude_ids = [];

		foreach($result as $item)
		{
			$paket = Paket::find($item->id);
			$temp = [];
			$temp['lokasi'] = $paket->nama;
			$temp['total'] = $item->total;
			$data[] = $temp;
			$exclude_ids[] = $item->id;
		}

		$paket_not_include = Paket::whereNotIn('id',$exclude_ids)->get();

		foreach($paket_not_include as $item)
		{
			$temp = [];
			$temp['lokasi'] = $item->nama;
			$temp['total'] = 0;
			$data[] = $temp;
		}

		return $data;
	}
}
