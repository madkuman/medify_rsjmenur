<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LaporanWaktuPelayananController extends Controller
{
	public function get($date_start,$date_end,$farmasi_ids,$jenis_resep)
	{
		$farmasi_ids = implode(",", $farmasi_ids);
		$lokasi['igd'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('igd')->pluck('id')->toArray();
		$lokasi['rawat_jalan'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-jalan')->pluck('id')->toArray();
		$lokasi['rawat_inap'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-inap')->pluck('id')->toArray();

		$data = [];

		$sql_date_start = $date_start->copy()->format('Y-m-d');
		$sql_date_end = $date_end->copy()->format('Y-m-d');
		$query_jenis_resep = '';

		foreach($lokasi as $lokasi_name => $lokasi_ids)
		{
			if($jenis_resep == 'racikan') $query_jenis_resep = "AND is_racikan = 1";
			elseif($jenis_resep == 'non-racikan') $query_jenis_resep = "AND is_racikan = 0";

    		$lokasi_ids_implode = implode(",", $lokasi_ids);

	    	$query = 
	    	"
	    		SELECT * FROM (
			    	SELECT COUNT(1) AS total_less_60 FROM (
				    	SELECT 
				    	id, 
				    	TIMESTAMPDIFF(MINUTE,dikerjakan_at,lima_benar_at) AS response_time 
				    	FROM transaksi_obat
				    	WHERE lima_benar_at IS NOT NULL
						AND dikerjakan_at >= DATE('$sql_date_start')
						AND dikerjakan_at <= DATE('$sql_date_end')
						AND farmasi_id IN ($farmasi_ids)
						AND lokasi_id IN ($lokasi_ids_implode)
						$query_jenis_resep
                		AND deleted_at IS NULL
				    	) table1
			    	WHERE response_time <= 60
	    		)table_1,(
			    	SELECT COUNT(1) AS total_more_60 FROM (
				    	SELECT 
				    	id, 
				    	TIMESTAMPDIFF(MINUTE,dikerjakan_at,lima_benar_at) AS response_time 
				    	FROM transaksi_obat
				    	WHERE lima_benar_at IS NOT NULL
						AND dikerjakan_at >= DATE('$sql_date_start')
						AND dikerjakan_at <= DATE('$sql_date_end')
						AND farmasi_id IN ($farmasi_ids)
						AND lokasi_id IN ($lokasi_ids_implode)
						$query_jenis_resep
                		AND deleted_at IS NULL
				    	) table2
			    	WHERE response_time > 60
	    		)table_2
    		";

	    	$result = DB::connection('farmasi')->select($query);
	    	$data[$lokasi_name]['less_60'] = $result[0]->total_less_60;
	    	$data[$lokasi_name]['more_60'] = $result[0]->total_more_60;
		}
		
		return $data;
	}
}
