<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Lokasi;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\ICD10;
use App\Models\Kasus\Kolaborator;
use App\Models\RawatInap\LaporanTransaksi;
use App\Models\RawatInap\Transaksi;
use App\Models\Pasien\Pasien;
use Carbon\Carbon;


class RincianPasienRawatInapController extends Controller
{
	public function get($date_start,$date_end)
	{
		$mrs = $this->getMrs($date_start,$date_end);
		$pindahan = $this->getPindahan($date_start,$date_end);
		$krs = $this->getKrs($date_start,$date_end);

		return [
			'mrs' => $mrs,
			'pindahan' => $pindahan,
			'krs' => $krs
		];
	}

	private function getMrs($date_start,$date_end)
	{
		return Kasus::whereBetween('mrs_at', [$date_start,$date_end])->with('pasien', 'identitas', 'diagnosisUtama', 'kelas','lokasi.lokasi.ruangan.bangsal')->get();
	}

	private function getPindahan($date_start,$date_end)
	{
		$trans = Transaksi::whereBetween("created_at", [$date_start,$date_end])->where('is_pindah',1)->with('kasus')->get();
		$kasus_id = $trans->pluck('kasus_id');

		
		$kasus = Kasus::whereIn('id', $kasus_id)->with('rawat_inap_transaksi', 'kelas', 'pasien', 'rawat_inap_transaksi.tempat_tidur','rawat_inap_transaksi.tempat_tidur.ruangan.bangsal')->get();

		$kasus = $kasus->filter(function($item){
			return count($item->rawat_inap_transaksi) > 1;
		});

		$result = [];
		foreach($kasus as $k)
		{
			foreach($k->rawat_inap_transaksi as $index => $r)
			{
				if($index == 0)
					continue;
				if($r->created_at->toDateString() > $date_start && $r->created_at->toDateString() < $date_end)
				{
					$ruangan = $k->rawat_inap_transaksi[$index-1]->tempat_tidur->ruangan->nama ?? '-';
					$bangsal = $k->rawat_inap_transaksi[$index-1]->tempat_tidur->ruangan->bangsal->nama ?? '-';

					$ruangan_akhir = $r->tempat_tidur->ruangan->nama ?? '-';
					$bangsal_akhir = $r->tempat_tidur->ruangan->bangsal->nama ?? '-';

					array_push($result, (object)[
						'no_rm' => $k->pasien->no_rm ?? '-',
						'nama' => $k->pasien->name ?? '-',
						'ruangan_awal' => $bangsal.' '.$ruangan,
						'ruangan_akhir' => $bangsal_akhir.' '.$ruangan,
						'tgl_masuk' => $r->created_at->format('d/m/Y'),
						'kelas' => $k->kelas->nama
					]);
				}
			}
		}
		return $result;
	}

	private function getKrs($date_start,$date_end)
	{
		return Kasus::whereBetween('krs_at', [$date_start,$date_end])->with('pasien', 'identitas', 'diagnosisUtama', 'kelas','lokasi.lokasi.ruangan.bangsal')->get();
	}

}