<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;

class LaporanKesesuaianDokterFornasBulananController extends Controller
{
	public function get($date_start,$date_end, $jenis_resep)
	{
		if($jenis_resep == 'fornas') $query_jenis_resep = 'fornas';
		else $query_jenis_resep = 'formularium_rs';

		$lokasi['igd'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('igd')->pluck('id')->toArray();
		$lokasi['rawat_jalan'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-jalan')->pluck('id')->toArray();
		$lokasi['rawat_inap'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-inap')->pluck('id')->toArray();

		if(config('app.debug')) $fakes = [0,1];
		else $fakes = [0];

		$dokters = User::where('profesi',1)->whereIn('fake_account',$fakes)->get();

		$data = [];

		$sql_date_start = $date_start->copy()->format('Y-m-d');
		$sql_date_end = $date_end->copy()->format('Y-m-d');

		foreach($dokters as $dokter)
		{
			$dokter_id = $dokter->id;
			foreach($lokasi as $lokasi_name => $lokasi_ids)
			{
    			$lokasi_ids_implode = implode(",", $lokasi_ids);
				$query = 
				"
				SELECT * FROM 
				(
					SELECT count(1) as total_sesuai
					FROM transaksi_obat
					WHERE paid_at IS NOT NULL
					AND created_at >= DATE('$sql_date_start')
					AND created_at <= DATE('$sql_date_end')
					AND dokter_id = $dokter_id
					AND is_$query_jenis_resep = 1
					AND lokasi_id IN ($lokasi_ids_implode)
                	AND deleted_at IS NULL
				)table_1,
				(
					SELECT count(1) as total_tidak_sesuai
					FROM transaksi_obat
					WHERE paid_at IS NOT NULL
					AND created_at >= DATE('$sql_date_start')
					AND created_at <= DATE('$sql_date_end')
					AND dokter_id = $dokter_id
					AND is_$query_jenis_resep = 0
					AND lokasi_id IN ($lokasi_ids_implode)
                	AND deleted_at IS NULL
				)table_2
				";

				$result = DB::connection('farmasi')->select($query);
				$data[$dokter->name][$lokasi_name]['sesuai'] = $result[0]->total_sesuai;
				$data[$dokter->name][$lokasi_name]['tidak_sesuai'] = $result[0]->total_tidak_sesuai;
				$data[$dokter->name][$lokasi_name]['total'] = $data[$dokter->name][$lokasi_name]['sesuai'] + $data[$dokter->name][$lokasi_name]['tidak_sesuai'];
			}
		}

		return $data;
	}
}
