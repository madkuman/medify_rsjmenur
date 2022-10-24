<?php

namespace App\Http\Controllers\SPM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\Models\Kasus\ICD10;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatInap\Transaksi as TransaksiRawatInap;

class ReadController extends Controller
{
	public function kematianPasien(Request $request)
	{
		$date = $this->requestDateMutator($request->all());
		if(empty($request->departemen)) $departemen = '1,2,3';
		else $departemen = $request->departemen;

		$query = '
			SELECT 
				pasien.name AS pasien_nama, 
				pasien.id AS pasien_id, 
				pasien.no_rm, 
				pasien.death_at, 
				kasus_last.`last_transaksi`,
				kasus.id AS kasus_id, 
				kasus_lokasi.nama,
				kasus_lokasi.lokasi_departemen_id,
				TIMESTAMPDIFF(HOUR, kasus_last.`last_transaksi`,pasien.death_at) AS selisih 
			FROM 
				`'.config('app.db_name').'_patients`.`pasien`, 
				`'.config('app.db_name').'_kasus`.kasus,
				(
					SELECT pasien_id, MAX(created_at) AS last_transaksi
					FROM `'.config('app.db_name').'_kasus`.kasus 
					GROUP BY pasien_id
				) kasus_last,
				(
					SELECT lokasi_kasus.`kasus_id`, lokasi_master.`nama`,lokasi_master.`lokasi_departemen_id`
					FROM 
						`'.config('app.db_name').'_kasus`.`lokasi` lokasi_kasus,
						`'.config('app.db_name').'`.lokasi lokasi_master,
						(
							SELECT kasus_id, MAX(created_at) AS last_lokasi_created_at
							FROM `'.config('app.db_name').'_kasus`.lokasi 
							GROUP BY kasus_id
						) lokasi_last
					WHERE
						lokasi_last.kasus_id = lokasi_kasus.kasus_id
						AND lokasi_last.last_lokasi_created_at = lokasi_kasus.created_at
						AND lokasi_kasus.lokasi_id = lokasi_master.id
					GROUP BY lokasi_kasus.`kasus_id`, lokasi_master.`nama`,lokasi_master.`lokasi_departemen_id`
				) kasus_lokasi
			WHERE 
				kasus_last.`pasien_id` = pasien.id
				AND pasien.death_at IS NOT NULL
				AND pasien.death_at >= "'.$date["start"].'"
				AND pasien.death_at <= "'.$date["end"].'"
				AND kasus.`pasien_id` = pasien.id
				AND kasus.`created_at` = kasus_last.last_transaksi
				AND kasus.id = kasus_lokasi.kasus_id
				AND kasus_lokasi.lokasi_departemen_id IN ('.$departemen.')
				;

			';

		$data = DB::select($query);
		$result['<1'] = 0;
		$result['1-6h'] = 0;
		$result['6-12h'] = 0;
		$result['12-24h'] = 0;
		$result['24-48h'] = 0;
		$result['>48h'] = 0;
		$total = 0;


		foreach($data as $item){
			if($item->selisih == 0) $result['<1'] = $result['<1'] + 1;
			else if($item->selisih > 0 && $item->selisih < 6) $result['1-6h'] = $result['1-6h'] + 1;
			else if($item->selisih >= 6 && $item->selisih < 12) $result['6-12h'] = $result['6-12h'] + 1;
			else if($item->selisih >= 12 && $item->selisih < 24) $result['12-24h'] = $result['12-24h'] + 1;
			else if($item->selisih >= 24 && $item->selisih < 48) $result['24-48h'] = $result['24-48h'] + 1;
			else if($item->selisih >= 48) $result['>48h'] = $result['>48h'] + 1;
			$total = $total + 1;
		}

		$result_data = [];
		foreach ($result as $key => $value)
		{
			$temp = new \stdClass();
			$temp->kategori = $key;
			$temp->value = $value;
			array_push($result_data, $temp);
		}
		$result_final['data'] = $result_data;
		$result_final['total'] = $total;

		return json_encode($result_final);
	}

	public function waktuTungguRawatJalan(Request $request)
	{
		$tanggal_awal = Carbon::createFromFormat('d-m-Y', $request['tanggal-awal'])->startOfDay();
		$tanggal_akhir = Carbon::createFromFormat('d-m-Y', $request['tanggal-akhir'])->endOfDay();
		$tipe_waktu = $request['tipe-waktu'];
		$poliklinik_id = $request->poli;
		$dates = $this->splitDate($tanggal_awal,$tanggal_akhir,$tipe_waktu);

		if($poliklinik_id == 0) {
			$poliklinik_ids = Poliklinik::pluck('id')->toArray();
			$poliklinik_ids = implode(',', $poliklinik_ids);
		}
		else $poliklinik_ids = $poliklinik_id;

		$result_data = [];
		$total = 0;
		$total_data = 0;
		foreach($dates as $month){

			$query = '
				SELECT AVG(selisih) AS average, COUNT(1) AS total
				FROM (
					SELECT 
						transaksi.id, transaksi.created_at, transaksi.waktu_pemeriksaan, transaksi.`poliklinik_id`,
						IF( 
							CAST(transaksi.`created_at` AS TIME) < CAST("08:00:00" AS TIME), 
							IF(
								TIMESTAMPDIFF(MINUTE, CAST("08:00:00" AS TIME), CAST(transaksi.waktu_pemeriksaan AS TIME)) < 0,
								0,
								TIMESTAMPDIFF(MINUTE, CAST("08:00:00" AS TIME), CAST(transaksi.waktu_pemeriksaan AS TIME))
							), 
							TIMESTAMPDIFF(MINUTE, transaksi.`created_at`, transaksi.waktu_pemeriksaan) 
						) AS selisih 
					FROM 
						`'.config('app.db_name').'_rawat_jalan`.`transaksi`
					WHERE 
						transaksi.waktu_pemeriksaan IS NOT NULL
						AND transaksi.created_at >= "'.$month->start.'"
						AND transaksi.created_at <= "'.$month->end.'"
						AND transaksi.poliklinik_id IN ('.$poliklinik_ids.')


				) transaksi

				';
			$data = DB::connection('rawatjalan')->select($query);
			$data = $data[0];
			if(empty($data->average) || $data->average == 0 || $data->average == null)
			{
				$average = 0;
			}
			else
			{
				$average = $data->average;
				$total += $average;
				$total_data+= 1;

			}
			
			$temp = new \stdClass();
			$temp->kategori = $month->format_kategori.'('.$data->total.')';
			$temp->value = $average;
			array_push($result_data, $temp);
		}

		

		$result_final['data'] = $result_data;
		if($total_data != 0)
			$result_final['total_rata_rata'] = $total/$total_data;
		else
			$result_final['total_rata_rata'] = 0;
		$result_final['total_bulan'] = $total_data;

		return json_encode($result_final);
	}

	public function pasienPulangPaksa(Request $request)
	{
		$dates = $this->splitIntoMonthly($request->all());

		$result_data = [];
		$total = 0;
		$total_data = 0;
		$global_total_aps = 0;
		$global_total_krs = 0;
		foreach($dates as $month){

			$query = '
			SELECT total_keluar.total AS total_krs, total_aps.total AS total_aps
			FROM 	(
					SELECT COUNT(1) total FROM `'.config('app.db_name').'_kasus`.kasus
					WHERE krs_alasan IS NOT NULL
					AND kasus.krs_at > "'.$month->start.'"
					AND kasus.krs_at < "'.$month->end.'"
				) total_keluar,
				(
					SELECT COUNT(1) total FROM `'.config('app.db_name').'_kasus`.kasus
					WHERE (krs_alasan = "Pasien Melarikan Diri / Pulang Paksa"
					OR krs_alasan = "Melarikan Diri"
					OR krs_alasan = "APS") 
					AND kasus.krs_at > "'.$month->start.'"
					AND kasus.krs_at < "'.$month->end.'"
				) total_aps;

			';
			$data = DB::select($query);
			$data = $data[0];
			if(empty($data->total_krs) || $data->total_krs == 0 || $data->total_krs == null)
			{
				$total_krs = 0;
				$total_aps = 0;
			}
			else
			{
				$total_krs = $data->total_krs;
				$total_aps = $data->total_aps;
				$global_total_aps += $total_aps;
				$global_total_krs += $total_krs;
				$total_data+= 1;

			}
			
			$temp = new \stdClass();
			$temp->kategori = $month->start->format('M').'('.$total_krs.')';
			$temp->value = $total_aps;
			array_push($result_data, $temp);
		}

		

		$result_final['data'] = $result_data;
		$result_final['total_rata_rata'] = round($global_total_aps/$global_total_krs,5);
		$result_final['total_bulan'] = $total_data;

		return json_encode($result_final);
	}

	public function LOSPasienJiwa(Request $request)
	{
		$dates = $this->splitIntoMonthly($request->all());
		$result_data = [];
		$los_all = 0;
		$count_all = 0;
		$total_data = 0;

		foreach($dates as $month){

			$icd_10_jiwa = ICD10::where('code_icd','like','F%')->pluck('id')->toArray();
			$kasus_jiwa = Diagnosis::whereIn('icd_10',$icd_10_jiwa)->whereBetween('created_at',[$month->start,$month->end])->pluck('kasus_id')->toArray();
			$transaksi_inap_jiwa = TransaksiRawatInap::whereIn('kasus_id',$kasus_jiwa)->selectRaw('kasus_id, sum(los) as sumlos')->groupBy('kasus_id')->get();
			$los = 0;
			$count = 0;
			$add_bulan = 0;
			$value=0;
			foreach($transaksi_inap_jiwa as $item_jiwa)
			{
				$los += $item_jiwa->sumlos;
				$count++;
				$count_all++;
				$los_all += $item_jiwa->sumlos;
				$add_bulan = 1;
				$value = round($los/$count,2);
			}
			if($add_bulan) $total_data++;

			$temp = new \stdClass();
			$temp->kategori = $month->start->format('M').'('.$count.')';
			$temp->value = $value;
			array_push($result_data, $temp);
		}

		$result_final['data'] = $result_data;
		$result_final['total_rata_rata'] = round($los_all/$count_all,5);
		$result_final['total_bulan'] = $total_data;
		
		return json_encode($result_final);
		
	}

	public function PasienJiwaReAdmisi(Request $request)
	{
		$dates = $this->splitIntoMonthly($request->all());
		$result_data = [];
		$total_persen = 0;
		$count_all = 0;
		$total_data = 0;

		foreach($dates as $month){

			$icd_10_jiwa = ICD10::where('code_icd','like','F%')->pluck('id')->toArray();
			$kasus_jiwa_id = Diagnosis::whereIn('icd_10',$icd_10_jiwa)->pluck('kasus_id')->toArray();

			
			$pasien_id = Kasus::whereIn('id',$kasus_jiwa_id)->whereNotIn('kelas_id',[1,2])->whereBetween('krs_at',[$month->start,$month->end])->pluck('pasien_id')->toArray();
			$next_month_start = $month->start->copy()->addMonth();
			$next_month_end = $month->end->copy()->addMonth();
			$kasus = Kasus::whereIn('pasien_id',$pasien_id)->whereNotIn('kelas_id',[1,2])->whereBetween('created_at',[$next_month_start,$next_month_end])->get();
			
			$value = 0;
			if(count($kasus) > 0){
				$value = round(count($kasus)/count($pasien_id),2);
				$total_data++;
			} 

			$temp = new \stdClass();
			$temp->kategori = $month->start->format('M');
			$temp->value = $value;
			array_push($result_data, $temp);
			$total_persen += $value;
		}

		$result_final['data'] = $result_data;
		$result_final['total_bulan'] = $total_data;
		$result_final['total_rata_rata'] = round($total_persen/$total_data,5);
		
		return json_encode($result_final);
		
	}

	public function operasiMasaTunggu(Request $request)
	{
		$dates = $this->splitIntoMonthly($request->all());
		$result_data = [];
		$total_rata_rata_hari = 0;
		$count_all = 0;
		$total_data = 0;

		foreach($dates as $month){

			$query = '
				SELECT COUNT(1) as total, AVG(selisih) as rata_rata
				FROM (
					SELECT id, jadwal_operasi, masa_tunggu, created_at, updated_at, 
					TIMESTAMPDIFF(DAY,created_at, jadwal_operasi) AS selisih  FROM `'.config('app.db_name').'_kamar_operasi`.transaksi
					WHERE 
						jadwal_operasi IS NOT NULL
						AND created_at > "'.$month->start.'"
						AND created_at < "'.$month->end.'"
						AND ruangan_id NOT IN (9,10,11,12)
					ORDER BY created_at DESC
				) transaksi_ok
				WHERE selisih >= 0;
			';
			$data = DB::select($query);
			$data = $data[0];
			$total_transaksi_bulan_ini = 0;
			$rata_rata_bulan_ini = 0;

			if($data->total > 0){
				$total_transaksi_bulan_ini = $data->total;
				$rata_rata_bulan_ini = $data->rata_rata;
				$total_data++;
			}
			
			$temp = new \stdClass();
			$temp->kategori = $month->start->format('M').'('.$total_transaksi_bulan_ini.')';;
			$temp->value = $rata_rata_bulan_ini;
			array_push($result_data, $temp);
			$total_rata_rata_hari += $rata_rata_bulan_ini;
		}
		$result_final['data'] = $result_data;
		$result_final['total_bulan'] = $total_data;
		$result_final['total_rata_rata'] = round($total_rata_rata_hari/$total_data,5);
		
		return json_encode($result_final);
	}

	private function requestDateMutator($data)
	{
		$start = new Carbon('first day of '.$data['date']);
		$end = new Carbon('last day of'.$data['date']);
		$return['start'] = $start->startOfDay();
		$return['end'] = $end->endOfDay();
		return $return;
	}

	private function splitIntoMonthly($data)
	{
		$year = $data['year'];
		$date_result = [];
		for($i=1;$i<=12;$i++)
		{
			$temp = new \stdClass();
			$temp->start = Carbon::createFromDate($year, $i)->startOfMonth();
			$temp->end = Carbon::createFromDate($year, $i)->endOfMonth();
			array_push($date_result, $temp);
		}
		return $date_result;
	}

	private function splitDate($tanggal_awal,$tanggal_akhir,$tipe_waktu)
	{
		$date_result = [];
		if($tipe_waktu == 'm')
		{
			$tanggal_awal = $tanggal_awal->startOfMonth();
			$tanggal_akhir = $tanggal_akhir->endOfMonth();
			$current_awal = $tanggal_awal->copy();
			$current_akhir = $tanggal_awal->copy()->endOfMonth();

			$count = 1;
			$count_max = 24;
			while($current_akhir <= $tanggal_akhir)
			{
				$temp = new \stdClass();
				$temp->start = $current_awal->copy();
				$temp->end = $current_akhir->copy();
				$temp->format_kategori = $current_awal->copy()->format('M');
				array_push($date_result, $temp);

				$current_awal->addMonth()->startOfMonth();
				$current_akhir = $current_awal->copy()->endOfMonth();
				if($count_max == $count++) break;
			}
		}
		elseif($tipe_waktu == 'w')
		{
			$tanggal_awal = $tanggal_awal->startOfWeek();
			$tanggal_akhir = $tanggal_akhir->endOfWeek();
			$current_awal = $tanggal_awal->copy();
			$current_akhir = $tanggal_awal->copy()->endOfWeek();
			$count = 1;
			$count_max = 24;
			while($current_akhir <= $tanggal_akhir)
			{
				$temp = new \stdClass();
				$temp->start = $current_awal->copy();
				$temp->end = $current_akhir->copy();
				$temp->format_kategori = $current_awal->copy()->format('d-M');
				array_push($date_result, $temp);

				$current_awal->addWeek()->startOfWeek();
				$current_akhir = $current_awal->copy()->endOfWeek();
				if($count_max == $count++) break;
			}
		}
		elseif($tipe_waktu == 'd')
		{
			$current_awal = $tanggal_awal->copy();
			$current_akhir = $tanggal_awal->copy()->endOfDay();
			$count = 1;
			$count_max = 24;
			while($current_akhir <= $tanggal_akhir)
			{
				$temp = new \stdClass();
				$temp->start = $current_awal->copy();
				$temp->end = $current_akhir->copy();
				$temp->format_kategori = $current_awal->copy()->format('D d-M');
				array_push($date_result, $temp);

				$current_awal->addDay()->startOfDay();
				$current_akhir = $current_awal->copy()->endOfDay();
				if($count_max == $count++) break;
			}
		}
		return $date_result;

	}
}
