<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LaporanResponseTimeTahunanController extends Controller
{
	public function get($date_start,$date_end,$farmasi_ids,$lokasi_ids)
    {
		$farmasi_ids = implode(",", $farmasi_ids);
		$lokasi_ids = implode(",", $lokasi_ids);
		$data['non_racikan'] = $this->getData($date_start,$date_end,'non-racikan',$farmasi_ids,$lokasi_ids);
		$data['racikan'] = $this->getData($date_start,$date_end,'racikan',$farmasi_ids,$lokasi_ids);
		return $data;
		
    }

    private function getData($date_start,$date_end,$jenis_resep,$farmasi_ids,$lokasi_ids)
    {
		$sql_date_start = $date_start->copy()->format('Y-m-d');
		$sql_date_end = $date_end->copy()->format('Y-m-d');

		$data = [];
		$current_date = $date_start->copy();
		while($current_date <= $date_end)
		{
			$tahun = $current_date->copy()->format('Y');
			$bulan = (int) $current_date->copy()->format('m');
			$data[$tahun.'-'.$bulan] = 0;
			$current_date->addMonth();
		}

		$query_jenis_resep = '';

    	if($jenis_resep == 'racikan') $query_jenis_resep = "AND is_racikan = 1";
		elseif($jenis_resep == 'non-racikan') $query_jenis_resep = "AND is_racikan = 0";
    	$query = 
    	"
	    	SELECT 
	    	CONCAT(YEAR(dikerjakan_at), '-' ,MONTH(dikerjakan_at)) AS tanggal, 
			AVG(TIMESTAMPDIFF(MINUTE,dikerjakan_at,lima_benar_at)) AS rata_rata
	    	FROM transaksi_obat
	    	WHERE dikerjakan_at IS NOT NULL
			AND dikerjakan_at >= DATE('$sql_date_start')
			AND dikerjakan_at <= DATE('$sql_date_end')
			AND farmasi_id IN ($farmasi_ids)
			$query_jenis_resep
			AND lokasi_id IN ($lokasi_ids)
			AND deleted_at IS NULL
			AND lima_benar_at IS NOT NULL
	    	GROUP BY YEAR(dikerjakan_at), MONTH(dikerjakan_at);
    	";
    	$data_query = DB::connection('farmasi')->select($query);
    	foreach($data_query as $item)
    	{
    		$data[$item->tanggal] = $item->rata_rata;
    	}

    	return $data;
    }
}
