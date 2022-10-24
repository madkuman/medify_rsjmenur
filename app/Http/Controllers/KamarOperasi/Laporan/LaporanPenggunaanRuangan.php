<?php

namespace App\Http\Controllers\KamarOperasi\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Pasca;
use App\Models\KamarOperasi\Ruangan;
use App\Models\KamarOperasi\Transaksi;
use Carbon\Carbon;

class LaporanPenggunaanRuangan extends Controller
{
	public function getData($tanggal_min,$tanggal_max)
	{
		$ruang_ids = Ruangan::all();
		$now_date = $tanggal_min;
		$tanggal = [];
		$transaksi_waktu = [];
		$transaksi_persen = [];
		$iteration = 0;
		$global_total = 0;

		while($now_date < $tanggal_max)
		{
			if($now_date->isWeekday())
			{
				$now_date->startOfDay();
				$now_date_end = $now_date->copy()->endOfDay();
				$tanggal[] = $now_date->copy();

				foreach($ruang_ids as $ruang)
				{
					$transaksi = Transaksi::whereBetween('jadwal_operasi',[$now_date,$now_date_end])->where('ruangan_id',$ruang->id)->whereNotNull('hasil_id')->get();
					
					$sisa = 0;
					foreach($transaksi as $item)
					{
						$sisa += $this->getPenggunaanWaktu($item->hasil_id);
					}
					$sisa = $this->divideFloat($sisa,3600,2);
					$global_total+= $sisa;

					$transaksi_waktu[$iteration][$ruang->id] = $sisa;
					$transaksi_persen[$iteration][$ruang->id] = round($sisa/8*100, 2);
				}
				$iteration++;
			}
			$now_date->addDay();
		}

		$array_total_per_ruang = [];
		$array_total_per_tgl = [];

		foreach ($tanggal as $key => $tgl) {
			$total_per_ruang = 0;
			$i = 0;
			foreach($ruang_ids as $ruang)
			{
				$waktu = $transaksi_waktu[$key][$ruang->id];
				
				if(empty($array_total_per_ruang[$ruang->id]))
					$array_total_per_ruang[$ruang->id] = $waktu;
				else
					$array_total_per_ruang[$ruang->id] += $waktu;

				if($i==0)
					$array_total_per_tgl[$key] = $waktu;
				else
					$array_total_per_tgl[$key]+= $waktu;

				$i++;
			}
		}

		$array_persen_per_ruang = [];
		$total_time = 0;

		foreach($array_total_per_ruang as $key => $waktu)
		{
			$total_time = 8*(count($tanggal));
			$persen = round($waktu/$total_time*100,2);
			$array_persen_per_ruang[$key] = $persen;
		}

		$array_persen_per_tgl = [];

		foreach($array_total_per_tgl as $key => $waktu)
		{
			$total_time = 8*(count($ruang_ids));
			$persen = round($waktu/$total_time*100,2);
			$array_persen_per_tgl[$key] = $persen;
		}

		$total_time = 8*(count($ruang_ids))*(count($tanggal));
		$global_persen = 0;
		if($total_time > 0)
			$global_persen = round($global_total/$total_time*100,2);

		$data['ruangan'] = $ruang_ids;
		$data['tanggal'] = $tanggal;
		$data['transaksi_waktu'] = $transaksi_waktu;
		$data['transaksi_persen'] = $transaksi_persen;
		$data['count_date'] = count($tanggal);
		$data['total_per_ruang'] = $array_total_per_ruang;
		$data['total_per_tgl'] = $array_total_per_tgl;
		$data['persen_per_ruang'] = $array_persen_per_ruang;
		$data['persen_per_tgl'] = $array_persen_per_tgl;
		$data['global_persen'] = $global_persen;
		$data['global_total'] = $global_total;
		return $data;
	}

	private function convertToHoursMins($seconds) {
		if ($seconds < 1) {
			return;
		}
		$hours = floor($seconds / 3600);
		$minutes = ($seconds - ($hours*3600));
		$minutes = $this->divideFloat($minutes,60,2);
		return $hours+$minutes;
	}

	public function divideFloat($a, $b, $precision=3) {
		$a*=pow(10, $precision);
		$result=(int)($a / $b);
		if (strlen($result)==$precision) return '0.' . $result;
		else return preg_replace('/(\d{' . $precision . '})$/', '.\1', $result);
	}

	private function getPenggunaanWaktu($pasca_id)
	{

		$pasca = Pasca::find($pasca_id);
		$waktu_mulai = $pasca->waktu_mulai;
		$start_time_explode = explode(':', $waktu_mulai);
		$jam_mulai = $start_time_explode[0];
		$menit_mulai = $start_time_explode[1];
		$detik_mulai = $start_time_explode[2];
		$tz = 'Asia/Jakarta';

		$start = Carbon::createFromTime($jam_mulai, $menit_mulai, $detik_mulai, $tz);

		$waktu_selesai = $pasca->waktu_selesai;
		$waktu_selesai_explode = explode(':', $waktu_selesai);
		$jam_selesai = $waktu_selesai_explode[0];
		$menit_selesai = $waktu_selesai_explode[1];
		$detik_selesai = $waktu_selesai_explode[2];

		$end = Carbon::createFromTime($jam_selesai, $menit_selesai, $detik_selesai, $tz);

		$sisa = $start->diffInRealSeconds($end);

		return $sisa;
	}
}
