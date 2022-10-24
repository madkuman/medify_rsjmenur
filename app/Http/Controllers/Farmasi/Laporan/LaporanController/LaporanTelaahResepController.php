<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LaporanTelaahResepController extends Controller
{
	public function get($date_start,$date_end)
    {

    	$lokasi['igd'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('igd')->pluck('id')->toArray();
		$lokasi['rawat_jalan'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-jalan')->pluck('id')->toArray();
		$lokasi['rawat_inap'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-inap')->pluck('id')->toArray();

		$sql_date_start = $date_start->copy()->format('Y-m-d H:i:s');
		$sql_date_end = $date_end->copy()->format('Y-m-d H:i:s');

		foreach($lokasi as $lokasi_name => $lokasi_ids)
		{
			$lokasi_ids_implode = implode(",", $lokasi_ids);
	    	$query = 
	    	"
		    	SELECT 
		    	COUNT(1) AS total,
		    	SUM(analisa_resep_sep) AS total_analisa_resep_sep,
		    	SUM(analisa_resep_fotokopi_kartu) AS total_analisa_resep_fotokopi_kartu,
		    	SUM(analisa_resep_identitas_pasien) AS total_analisa_resep_identitas_pasien,
		    	SUM(analisa_resep_paraf_dokter) AS total_analisa_resep_paraf_dokter,
		    	SUM(analisa_resep_nama_obat) AS total_analisa_resep_nama_obat,
		    	SUM(analisa_resep_jumlah_obat) AS total_analisa_resep_jumlah_obat,
		    	SUM(analisa_resep_signa_obat) AS total_analisa_resep_signa_obat,
		    	SUM(analisa_resep_tepat_indikasi) AS total_analisa_resep_tepat_indikasi,
		    	SUM(analisa_resep_tepat_dosis) AS total_analisa_resep_tepat_dosis,
		    	SUM(analisa_resep_tepat_rute) AS total_analisa_resep_tepat_rute,
		    	SUM(analisa_resep_tepat_waktu) AS total_analisa_resep_tepat_waktu,
		    	SUM(analisa_resep_duplikasi_terapi) AS total_analisa_resep_duplikasi_terapi,
		    	SUM(analisa_resep_alergi_obat) AS total_analisa_resep_alergi_obat,
		    	SUM(analisa_resep_interaksi_obat) AS total_analisa_resep_interaksi_obat,
		    	SUM(analisa_resep_kontra_indikasi) AS total_analisa_resep_kontra_indikasi
		    	FROM transaksi_obat 
		    	WHERE created_at >= '$sql_date_start'
		    	AND created_at <= '$sql_date_end'
		    	AND lokasi_id IN ($lokasi_ids_implode)
		    	AND deleted_at IS NULL
		    	AND analisa_resep_at IS NOT NULL
		    	;
	    	";
			$result = DB::connection('farmasi')->select($query);
			$data[$lokasi_name] = $result[0];
		}

		return $data;
    }
}
