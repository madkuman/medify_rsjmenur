<?php

namespace App\Http\Controllers\RawatInap\Statistik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\TempatTidur;
use App\Models\RawatInap\Statistik;
use App\Models\RawatInap\StatistikHariPerawatan;
use Carbon\Carbon;

class ReadController extends Controller
{
	public function getBed()
	{
		$bed_terisi = TempatTidur::whereNotNull('transaksi_id')
			->where('is_hitung_statistik',1)
			->count();
		$all_bed = TempatTidur::where('is_hitung_statistik',1)
			->get()->count();
		$bed_kosong = $all_bed - $bed_terisi;

		$data = [
			'semua' => $all_bed,
			'terisi' => $bed_terisi,
			'kosong' => $bed_kosong
		];

		return $data;
	}

	public function getStatistikRange($jenis_durasi,$end_date,$iteration,$jenis_statistik='all')
	{
			$current = $end_date->copy()->startOfDay();

			for($i=$iteration-1;$i>=0;$i--)
			{
				if($jenis_durasi == 'bulan') {
					$current->subMonth()->startOfMonth()->startOfDay();
					$date_name = indonesian_date($current->copy(),'M');
				}
				elseif($jenis_durasi == 'minggu') {
					$current->subWeek()->startOfWeek();
					$date_name = indonesian_date($current->copy(),'d-M');
				}
				elseif($jenis_durasi == 'hari') {
					$current->subDay()->startOfDay();
					$date_name = $current->copy()->format('Y-m-d');
				}


				if($jenis_statistik == 'all'){
					$data[$i] = Statistik::where('jenis_durasi',$jenis_durasi)->whereDate('start_date',$current)->get();
				}
				else{
					$data[$i] = Statistik::where('jenis_durasi',$jenis_durasi)->where('jenis_statistik',$jenis_statistik)->whereDate('start_date',$current)->first();
				}

			}


		return $data;
	}

	public function getTempatTidur($start, $end)
	{
		$kasur = StatistikHariPerawatan::whereBetween('tanggal',[$start,$end])->groupBy('bed_id')->get();
		return count($kasur);
	}


	public function getHariPerawatan($start,$end)
	{
		$hari = StatistikHariPerawatan::whereBetween('tanggal',[$start,$end])->groupBy('bed_id')->groupBy('tanggal')->get();
		return count($hari);
	}

	public function getLamaDirawat($start,$end)
	{
		$hari = StatistikHariPerawatan::whereBetween('tanggal',[$start,$end])->whereNotNull('transaksi_id')->groupBy('bed_id')->groupBy('tanggal')->get();
		return count($hari);
	}

}
