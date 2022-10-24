<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use App\Models\Farmasi\TransaksiObat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Farmasi\Farmasi;
use Illuminate\Support\Facades\DB;

class LaporanPelayananResepController extends Controller
{
    public function get($params)
    {
    	$lokasi['igd'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('igd')->pluck('id')->toArray();
		$lokasi['rawat_jalan'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-jalan')->pluck('id')->toArray();
		$lokasi['rawat_inap'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-inap')->pluck('id')->toArray();

		$date_start = $params['date_start'];
        $date_end = $params['date_end'];
        $farmasi_ids = $params['farmasi_ids'];
        $lokasi_departemen = $params['lokasi_departemen'];
        $item_template_ids = $params['item_template_ids'];
        $item_template_ids_generik = $params['item_template_ids_generik'];
        $item_template_ids_non_generik_formularium_arr = $params['item_template_ids_non_generik_formularium_arr'];
        $item_template_ids_non_generik_non_formularium_arr = $params['item_template_ids_non_generik_non_formularium_arr'];

        if($params['jenis_pembayaran']){
            $transaksi_ids = TransaksiObat::whereBetween('created_at',[$date_start->copy()->startOfDay(),$date_end->copy()->endOfDay()])
                ->whereIn('farmasi_id',$farmasi_ids)
                ->wherehas('pembayaran_detail', function ($subquery) use ($params){
                    $subquery->from(config('app.db_name') . '_patients.pasien_pembayaran')->select('id','perusahaan_id')->whereIn('perusahaan_id', $params['jenis_pembayaran']);
                })
                ->get()->pluck('id')->toArray();
        }else{
            $transaksi_ids = TransaksiObat::whereBetween('created_at',[$date_start->copy()->startOfDay(),$date_end->copy()->endOfDay()])
                ->whereIn('farmasi_id',$farmasi_ids)->get()->pluck('id')->toArray();
        }

		$sql_date_start = $date_start->copy()->startOfDay()->toDateTimeString();
		$sql_date_end = $date_end->copy()->endOfDay()->toDateTimeString();
		$farmasi_ids = implode(",", $farmasi_ids);
		$transaksi_ids = implode(",",$transaksi_ids);
		$item_template_ids = implode(",", $item_template_ids);
		$item_template_ids_generik = implode(",", $item_template_ids_generik);
		$item_template_ids_non_generik_formularium = implode(",", $item_template_ids_non_generik_formularium_arr);
		$item_template_ids_non_generik_non_formularium = implode(",", $item_template_ids_non_generik_non_formularium_arr);

		$query = "SELECT * FROM";
		$query .= $this->getQueryPasienDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query .= $this->getQueryPasienTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query .= $this->getQueryPasienPriaDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query .= $this->getQueryPasienPriaTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query .= $this->getQueryPasienWanitaDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query .= $this->getQueryPasienWanitaTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query .= $this->getQueryTransaksiDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query .= $this->getQueryTransaksiTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query .= $this->getQueryObatDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query .= $this->getQueryObatTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query .= $this->getQueryObatNonRacikanDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query .= $this->getQueryObatNonRacikanTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query .= $this->getQueryObatRacikanDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query .= $this->getQueryObatRacikanTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query .= $this->getQueryObatGenerikDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids_generik,$transaksi_ids);
		$query .= $this->getQueryObatGenerikTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids_generik,$transaksi_ids);
		$query .= $this->getQueryObatNonGenerikFormulariumDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids_non_generik_formularium,$transaksi_ids);
		$query .= $this->getQueryObatNonGenerikFormulariumTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids_non_generik_formularium,$transaksi_ids);

		$query_1 = "SELECT * FROM";
		$query_1 .= $this->getQueryObatNonGenerikNonFormulariumDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids_non_generik_non_formularium,$transaksi_ids);
		$query_1 .= $this->getQueryObatNonGenerikNonFormulariumTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids_non_generik_non_formularium,$transaksi_ids);
		$query_1 .= $this->getQueryTransaksiFornasDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query_1 .= $this->getQueryTransaksiFornasTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query_1 .= $this->getQueryTransaksiTidakFornasDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query_1 .= $this->getQueryTransaksiTidakFornasTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query_1 .= $this->getQueryTransaksiFormulariumDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query_1 .= $this->getQueryTransaksiFormulariumTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query_1 .= $this->getQueryTransaksiTidakFormulariumDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);
		$query_1 .= $this->getQueryTransaksiTidakFormulariumTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids);

		$query = substr($query, 0,-1);
		$query_1 = substr($query_1, 0,-1);
		$data = DB::connection('farmasi')->select($query);
		$data_1 = DB::connection('farmasi')->select($query_1);

		return $data = [
			1 => $data[0],
			2 => $data_1[0]
		];
    }

    private function getQueryPasienDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		    SELECT SUM(jumlah.value) as pasien_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(DISTINCT(t.pasien_id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND t.paid_at IS NOT NULL
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(DISTINCT(t.pasien_id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND t.paid_at IS NOT NULL
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_pasien_dilyani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryPasienTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		    SELECT SUM(jumlah.value) AS pasien_tidak_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(DISTINCT(t.pasien_id)) AS value 
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND t.paid_at IS NULL
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(DISTINCT(t.pasien_id)) AS value 
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND t.paid_at IS NULL
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_pasien_tidak_dilyani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryPasienPriaDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		    SELECT SUM(jumlah.value) AS pasien_pria_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(DISTINCT(t.pasien_id)) AS value 
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				INNER JOIN ".config('app.db_name')."_patients.pasien pasien ON t.pasien_id = pasien.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND pasien.gender = 1
				AND t.paid_at IS NOT NULL
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(DISTINCT(t.pasien_id)) AS value 
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				INNER JOIN ".config('app.db_name')."_patients.pasien pasien ON t.pasien_id = pasien.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND pasien.gender = 1
				AND t.paid_at IS NOT NULL
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_pasien_pria_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryPasienPriaTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		    SELECT SUM(jumlah.value) AS pasien_pria_tidak_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(DISTINCT(t.pasien_id)) AS  value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				INNER JOIN ".config('app.db_name')."_patients.pasien pasien ON t.pasien_id = pasien.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND pasien.gender = 1
				AND t.paid_at IS NULL
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(DISTINCT(t.pasien_id)) AS  value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				INNER JOIN ".config('app.db_name')."_patients.pasien pasien ON t.pasien_id = pasien.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND pasien.gender = 1
				AND t.paid_at IS NULL
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_pasien_pria_tidak_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryPasienWanitaDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		SELECT SUM(jumlah.value) AS pasien_wanita_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(DISTINCT(t.pasien_id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				INNER JOIN ".config('app.db_name')."_patients.pasien pasien ON t.pasien_id = pasien.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND pasien.gender <> 1
				AND t.paid_at IS NOT NULL
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(DISTINCT(t.pasien_id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				INNER JOIN ".config('app.db_name')."_patients.pasien pasien ON t.pasien_id = pasien.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND pasien.gender <> 1
				AND t.paid_at IS NOT NULL
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_pasien_wanita_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryPasienWanitaTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		SELECT SUM(jumlah.value) AS pasien_wanita_tidak_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(DISTINCT(t.pasien_id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				INNER JOIN ".config('app.db_name')."_patients.pasien pasien ON t.pasien_id = pasien.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND pasien.gender <> 1
				AND t.paid_at IS NULL
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(DISTINCT(t.pasien_id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				INNER JOIN ".config('app.db_name')."_patients.pasien pasien ON t.pasien_id = pasien.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND pasien.gender <> 1
				AND t.paid_at IS NULL
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_pasien_wanita_tidak_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

    private function getQueryTransaksiDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		SELECT SUM(jumlah.value) AS transaksi_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(DISTINCT(t.id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                AND t.id IN($transaksi_ids)
                UNION 
                SELECT COUNT(DISTINCT(t.id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_transaksi_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryTransaksiTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		SELECT SUM(jumlah.value) AS transaksi_tidak_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(DISTINCT(t.id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(DISTINCT(t.id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_transaksi_tidak_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

    private function getQueryObatDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
	    		SELECT SUM(jumlah_obat.obat) as obat_dilayani_$lokasi_name FROM (
					SELECT COUNT(rd.id) AS obat
					FROM transaksi_obat t
					INNER JOIN resep r ON r.id = t.resep_final
					INNER JOIN resep_detail rd ON rd.resep_id = r.id
					INNER JOIN items_farmasi item ON rd.obat_id = item.id
					WHERE t.created_at >= '$sql_date_start'
					AND t.created_at <= '$sql_date_end'
					AND t.lokasi_id IN ($lokasi_ids_implode)
					AND t.farmasi_id IN ($farmasi_ids)
					AND item.item_template_id IN ($item_template_ids)
					AND t.deleted_at IS NULL
					AND t.paid_at IS NOT NULL
					AND t.id IN($transaksi_ids)
					UNION
					SELECT COUNT(rd.id) AS obat
					FROM transaksi_obat t
					INNER JOIN resep r ON r.id = t.resep_final
					INNER JOIN resep_detail rd ON rd.resep_id = r.id
					INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
					INNER JOIN items_farmasi item ON racikan.obat_id = item.id
					WHERE t.created_at >= '$sql_date_start'
					AND t.created_at <= '$sql_date_end'
					AND t.lokasi_id IN ($lokasi_ids_implode)
					AND t.farmasi_id IN ($farmasi_ids)
					AND item.item_template_id IN ($item_template_ids)
					AND t.deleted_at IS NULL
					AND t.paid_at IS NOT NULL
					AND t.id IN($transaksi_ids)
				)jumlah_obat
			) table_obat_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryObatTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
	    		SELECT SUM(jumlah_obat.obat) as obat_tidak_dilayani_$lokasi_name FROM (
					SELECT COUNT(rd.id) AS obat
					FROM transaksi_obat t
					INNER JOIN resep r ON r.id = t.resep_final
					INNER JOIN resep_detail rd ON rd.resep_id = r.id
					INNER JOIN items_farmasi item ON rd.obat_id = item.id
					WHERE t.created_at >= '$sql_date_start'
					AND t.created_at <= '$sql_date_end'
					AND t.lokasi_id IN ($lokasi_ids_implode)
					AND t.farmasi_id IN ($farmasi_ids)
					AND item.item_template_id IN ($item_template_ids)
					AND t.deleted_at IS NULL
					AND t.paid_at IS NULL
					AND t.id IN($transaksi_ids)
					UNION
					SELECT COUNT(rd.id) AS obat
					FROM transaksi_obat t
					INNER JOIN resep r ON r.id = t.resep_final
					INNER JOIN resep_detail rd ON rd.resep_id = r.id
					INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
					INNER JOIN items_farmasi item ON racikan.obat_id = item.id
					WHERE t.created_at >= '$sql_date_start'
					AND t.created_at <= '$sql_date_end'
					AND t.lokasi_id IN ($lokasi_ids_implode)
					AND t.farmasi_id IN ($farmasi_ids)
					AND item.item_template_id IN ($item_template_ids)
					AND t.deleted_at IS NULL
					AND t.paid_at IS NULL
					AND t.id IN($transaksi_ids)
				)jumlah_obat
			) table_obat_tidak_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

    private function getQueryObatRacikanDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
				SELECT COUNT(rd.id) AS obat_racikan_dilayani_$lokasi_name
				FROM transaksi_obat t
				INNER JOIN resep r ON r.id = t.resep_final
				INNER JOIN resep_detail rd ON rd.resep_id = r.id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND t.deleted_at IS NULL
				AND t.paid_at IS NOT NULL
				AND t.id IN($transaksi_ids)
			) table_obat_racikan_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryObatRacikanTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
				SELECT COUNT(rd.id) AS obat_racikan_tidak_dilayani_$lokasi_name
				FROM transaksi_obat t
				INNER JOIN resep r ON r.id = t.resep_final
				INNER JOIN resep_detail rd ON rd.resep_id = r.id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND t.deleted_at IS NULL
				AND t.paid_at IS NULL
				AND t.id IN($transaksi_ids)
			) table_obat_racikan_tidak_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

    private function getQueryObatNonRacikanDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
	    		SELECT COUNT(rd.id) AS obat_non_racikan_dilayani_$lokasi_name
				FROM transaksi_obat t
				INNER JOIN resep r ON r.id = t.resep_final
				INNER JOIN resep_detail rd ON rd.resep_id = r.id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND t.deleted_at IS NULL
				AND t.paid_at IS NOT NULL
				AND t.id IN($transaksi_ids)
			) table_obat_non_racikan_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryObatNonRacikanTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
	    		SELECT COUNT(rd.id) AS obat_non_racikan_tidak_dilayani_$lokasi_name
				FROM transaksi_obat t
				INNER JOIN resep r ON r.id = t.resep_final
				INNER JOIN resep_detail rd ON rd.resep_id = r.id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND t.deleted_at IS NULL
				AND t.paid_at IS NULL
				AND t.id IN($transaksi_ids)
			) table_obat_non_racikan_tidak_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	public function getQueryObatGenerikDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids_generik,$transaksi_ids)
	{
		$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		SELECT SUM(jumlah.value) AS obat_generik_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t
				INNER JOIN resep r ON r.id = t.resep_final
				INNER JOIN resep_detail rd ON rd.resep_id = r.id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids_generik)
				AND t.deleted_at IS NULL
				AND t.paid_at IS NOT NULL
				AND t.id IN($transaksi_ids)
				UNION
				SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t
				INNER JOIN resep r ON r.id = t.resep_final
				INNER JOIN resep_detail rd ON rd.resep_id = r.id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids_generik)
				AND t.deleted_at IS NULL
				AND t.paid_at IS NOT NULL
				AND t.id IN($transaksi_ids)
				)jumlah
			) table_obat_generik_dilayani_$lokasi_name,";
    	}
    	return $query;
	}

	public function getQueryObatGenerikTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids_generik,$transaksi_ids)
	{
		$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		SELECT SUM(jumlah.value) AS obat_generik_tidak_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t
				INNER JOIN resep r ON r.id = t.resep_final
				INNER JOIN resep_detail rd ON rd.resep_id = r.id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids_generik)
				AND t.deleted_at IS NULL
				AND t.paid_at IS NULL
				AND t.id IN($transaksi_ids)
				UNION
				SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t
				INNER JOIN resep r ON r.id = t.resep_final
				INNER JOIN resep_detail rd ON rd.resep_id = r.id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids_generik)
				AND t.deleted_at IS NULL
				AND t.paid_at IS NULL
				AND t.id IN($transaksi_ids)
				)jumlah
			) table_obat_generik_tidak_dilayani_$lokasi_name,";
    	}
    	return $query;
	}

	private function getQueryObatNonGenerikFormulariumDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids_non_generik_formularium,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
	    		SELECT SUM(jumlah_obat.obat) as obat_non_generik_formularium_dilayani_$lokasi_name FROM (
					SELECT COUNT(rd.id) AS obat
					FROM transaksi_obat t
					INNER JOIN resep r ON r.id = t.resep_final
					INNER JOIN resep_detail rd ON rd.resep_id = r.id
					INNER JOIN items_farmasi item ON rd.obat_id = item.id
					WHERE t.created_at >= '$sql_date_start'
					AND t.created_at <= '$sql_date_end'
					AND t.lokasi_id IN ($lokasi_ids_implode)
					AND t.farmasi_id IN ($farmasi_ids)
					AND item.item_template_id IN ($item_template_ids_non_generik_formularium)
					AND t.deleted_at IS NULL
					AND t.paid_at IS NOT NULL
					AND t.id IN($transaksi_ids)
					UNION
					SELECT COUNT(rd.id) AS obat
					FROM transaksi_obat t
					INNER JOIN resep r ON r.id = t.resep_final
					INNER JOIN resep_detail rd ON rd.resep_id = r.id
					INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
					INNER JOIN items_farmasi item ON racikan.obat_id = item.id
					WHERE t.created_at >= '$sql_date_start'
					AND t.created_at <= '$sql_date_end'
					AND t.lokasi_id IN ($lokasi_ids_implode)
					AND t.farmasi_id IN ($farmasi_ids)
					AND item.item_template_id IN ($item_template_ids_non_generik_formularium)
					AND t.deleted_at IS NULL
					AND t.paid_at IS NOT NULL
					AND t.id IN($transaksi_ids)
				)jumlah_obat
			) table_obat_non_generik_formularium_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryObatNonGenerikFormulariumTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids_non_generik_formularium,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
	    		SELECT SUM(jumlah_obat.obat) as obat_non_generik_formularium_tidak_dilayani_$lokasi_name FROM (
					SELECT COUNT(rd.id) AS obat
					FROM transaksi_obat t
					INNER JOIN resep r ON r.id = t.resep_final
					INNER JOIN resep_detail rd ON rd.resep_id = r.id
					INNER JOIN items_farmasi item ON rd.obat_id = item.id
					WHERE t.created_at >= '$sql_date_start'
					AND t.created_at <= '$sql_date_end'
					AND t.lokasi_id IN ($lokasi_ids_implode)
					AND t.farmasi_id IN ($farmasi_ids)
					AND item.item_template_id IN ($item_template_ids_non_generik_formularium)
					AND t.deleted_at IS NULL
					AND t.paid_at IS NULL
					AND t.id IN($transaksi_ids)
					UNION
					SELECT COUNT(rd.id) AS obat
					FROM transaksi_obat t
					INNER JOIN resep r ON r.id = t.resep_final
					INNER JOIN resep_detail rd ON rd.resep_id = r.id
					INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
					INNER JOIN items_farmasi item ON racikan.obat_id = item.id
					WHERE t.created_at >= '$sql_date_start'
					AND t.created_at <= '$sql_date_end'
					AND t.lokasi_id IN ($lokasi_ids_implode)
					AND t.farmasi_id IN ($farmasi_ids)
					AND item.item_template_id IN ($item_template_ids_non_generik_formularium)
					AND t.deleted_at IS NULL
					AND t.paid_at IS NULL
					AND t.id IN($transaksi_ids)
				)jumlah_obat
			) table_obat_non_generik_formularium_tidak_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryObatNonGenerikNonFormulariumDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids_non_generik_non_formularium,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
	    		SELECT SUM(jumlah_obat.obat) as obat_non_generik_non_formularium_dilayani_$lokasi_name FROM (
					SELECT COUNT(rd.id) AS obat
					FROM transaksi_obat t
					INNER JOIN resep r ON r.id = t.resep_final
					INNER JOIN resep_detail rd ON rd.resep_id = r.id
					INNER JOIN items_farmasi item ON rd.obat_id = item.id
					WHERE t.created_at >= '$sql_date_start'
					AND t.created_at <= '$sql_date_end'
					AND t.lokasi_id IN ($lokasi_ids_implode)
					AND t.farmasi_id IN ($farmasi_ids)
					AND item.item_template_id IN ($item_template_ids_non_generik_non_formularium)
					AND t.deleted_at IS NULL
					AND t.paid_at IS NOT NULL
					AND t.id IN($transaksi_ids)
					UNION
					SELECT COUNT(rd.id) AS obat
					FROM transaksi_obat t
					INNER JOIN resep r ON r.id = t.resep_final
					INNER JOIN resep_detail rd ON rd.resep_id = r.id
					INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
					INNER JOIN items_farmasi item ON racikan.obat_id = item.id
					WHERE t.created_at >= '$sql_date_start'
					AND t.created_at <= '$sql_date_end'
					AND t.lokasi_id IN ($lokasi_ids_implode)
					AND t.farmasi_id IN ($farmasi_ids)
					AND item.item_template_id IN ($item_template_ids_non_generik_non_formularium)
					AND t.deleted_at IS NULL
					AND t.paid_at IS NOT NULL
					AND t.id IN($transaksi_ids)
				)jumlah_obat
			) table_obat_non_generik_non_formularium_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryObatNonGenerikNonFormulariumTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids_non_generik_non_formularium,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
	    		SELECT SUM(jumlah_obat.obat) as obat_non_generik_non_formularium_tidak_dilayani_$lokasi_name FROM (
					SELECT COUNT(rd.id) AS obat
					FROM transaksi_obat t
					INNER JOIN resep r ON r.id = t.resep_final
					INNER JOIN resep_detail rd ON rd.resep_id = r.id
					INNER JOIN items_farmasi item ON rd.obat_id = item.id
					WHERE t.created_at >= '$sql_date_start'
					AND t.created_at <= '$sql_date_end'
					AND t.lokasi_id IN ($lokasi_ids_implode)
					AND t.farmasi_id IN ($farmasi_ids)
					AND item.item_template_id IN ($item_template_ids_non_generik_non_formularium)
					AND t.deleted_at IS NULL
					AND t.paid_at IS NULL
					AND t.id IN($transaksi_ids)
					UNION
					SELECT COUNT(rd.id) AS obat
					FROM transaksi_obat t
					INNER JOIN resep r ON r.id = t.resep_final
					INNER JOIN resep_detail rd ON rd.resep_id = r.id
					INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
					INNER JOIN items_farmasi item ON racikan.obat_id = item.id
					WHERE t.created_at >= '$sql_date_start'
					AND t.created_at <= '$sql_date_end'
					AND t.lokasi_id IN ($lokasi_ids_implode)
					AND t.farmasi_id IN ($farmasi_ids)
					AND item.item_template_id IN ($item_template_ids_non_generik_non_formularium)
					AND t.deleted_at IS NULL
					AND t.paid_at IS NULL
					AND t.id IN($transaksi_ids)
				)jumlah_obat
			) table_obat_non_generik_non_formularium_tidak_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

    private function getQueryTransaksiFornasDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		SELECT SUM(jumlah.value) AS transaksi_fornas_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_fornas = 1
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_fornas = 1
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_transaksi_fornas_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryTransaksiFornasTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		SELECT SUM(jumlah.value) AS transaksi_fornas_tidak_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_fornas = 1
                AND t.deleted_at IS NULL
                AND t.paid_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_fornas = 1
                AND t.deleted_at IS NULL
                AND t.paid_at IS NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_transaksi_fornas_tidak_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryTransaksiTidakFornasDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		SELECT SUM(jumlah.value) AS transaksi_tidak_fornas_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_fornas = 0
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_fornas = 0
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_transaksi_tidak_fornas_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryTransaksiTidakFornasTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		SELECT SUM(jumlah.value) AS transaksi_tidak_fornas_tidak_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_fornas = 0
                AND t.deleted_at IS NULL
                AND t.paid_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_fornas = 0
                AND t.deleted_at IS NULL
                AND t.paid_at IS NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_transaksi_tidak_fornas_tidak_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryTransaksiFormulariumDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		SELECT SUM(jumlah.value) AS transaksi_formularium_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_formularium_rs = 1
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_formularium_rs = 1
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_transaksi_formularium_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryTransaksiFormulariumTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		SELECT SUM(jumlah.value) AS transaksi_formularium_tidak_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_formularium_rs = 1
                AND t.deleted_at IS NULL
                AND t.paid_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_formularium_rs = 1
                AND t.deleted_at IS NULL
                AND t.paid_at IS NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_transaksi_formularium_tidak_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryTransaksiTidakFormulariumDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		SELECT SUM(jumlah.value) AS transaksi_tidak_formularium_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_formularium_rs = 0
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_formularium_rs = 0
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_transaksi_tidak_formularium_dilayani_$lokasi_name,";
    	}
    	return $query;
    }

	private function getQueryTransaksiTidakFormulariumTidakDilayani($lokasi,$sql_date_start,$sql_date_end,$farmasi_ids,$lokasi_departemen,$item_template_ids,$transaksi_ids)
    {
    	$query = '';
    	foreach($lokasi as $lokasi_name => $lokasi_ids)
    	{
			if (!in_array($lokasi_name, $lokasi_departemen)) continue;
    		$lokasi_ids_implode = implode(",", $lokasi_ids);
    		$query.= "
    		(
    		SELECT SUM(jumlah.value) AS transaksi_tidak_formularium_tidak_dilayani_$lokasi_name FROM (
	    		SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_formularium_rs = 0
                AND t.deleted_at IS NULL
                AND t.paid_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$sql_date_start'
				AND t.created_at <= '$sql_date_end'
				AND t.lokasi_id IN ($lokasi_ids_implode)
				AND t.farmasi_id IN ($farmasi_ids)
				AND item.item_template_id IN ($item_template_ids)
				AND rd.is_formularium_rs = 0
                AND t.deleted_at IS NULL
                AND t.paid_at IS NULL
                AND t.id IN($transaksi_ids)
                )jumlah
			) table_transaksi_tidak_formularium_tidak_dilayani_$lokasi_name,";
    	}
    	return $query;
    }
}
