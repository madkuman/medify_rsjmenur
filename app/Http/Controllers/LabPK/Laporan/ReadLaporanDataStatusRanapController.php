<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PembayaranPerusahaanType;
use App\Models\LabPK\TransaksiDetail;
use App\Models\Hospital\Kelas;
use DB;

class ReadLaporanDataStatusRanapController extends Controller
{
	public function get($start,$end)
	{
		$labpk = config('const.lab-pk');

		$data = [];

		$lokasi_list = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap']);
		$asuransi_list = $this->getAsuransi();
		$kelas = Kelas::where('rawat_inap',1)->get();
		$kelas_ids = $kelas->pluck('id')->toArray();
		$kelas_ids_implode = implode(",", $kelas_ids);
		$all_asuransi = [];

		foreach($lokasi_list as $lokasi)
		{
			$lokasi_ids = $lokasi->id;

			$temp = [];
			$temp['lokasi'] = $lokasi->nama;

			foreach ($asuransi_list as $asuransi_slug => $asuransi_ids) 
			{
				$all_asuransi = array_merge($all_asuransi,$asuransi_ids);
				$asuransi_ids_implode = implode(",", $asuransi_ids);


				if($asuransi_slug == 'asuransi_tunai' || $asuransi_slug=='asuransi_bpjs_non_pbi')
				{
					foreach($kelas as $kelas_item)
					{
						$kelas_ids = $kelas_item->id;
						$temp[$asuransi_slug][$kelas_item->id] = $this->query($asuransi_ids_implode,$lokasi_ids,$kelas_ids,$start,$end);
					}
				}
				else
				{
					$temp[$asuransi_slug][0] = $this->query($asuransi_ids_implode,$lokasi_ids,$kelas_ids_implode,$start,$end);
				}
			}
			$data[] = $temp;
		}
		$result['data'] = $data;
		$result['asuransi'] = PembayaranPerusahaan::whereIn('id',$all_asuransi)->get();
		$result['kelas'] = $kelas;
		$result['lokasi'] = $lokasi_list;
		return $result;
	}

	private function getAsuransi()
	{
		$data['asuransi_tunai'] = config('const.asuransi_tunai');
		$data['asuransi_bpjs_non_pbi'] = config('const.asuransi_bpjs_non_pbi');
		$data['asuransi_bpjs_pbi'] = config('const.asuransi_bpjs_pbi');	
		$data['asuransi_jamkesda_p100'] = config('const.asuransi_jamkesda_p100');
		$data['asuransi_jamkesda_p50'] = config('const.asuransi_jamkesda_p50');
		$data['asuransi_jamkesda_sby'] = config('const.asuransi_jamkesda_sby');
		$data['asuransi_spm'] = config('const.asuransi_spm');
		$data['asuransi_kartu_sehati'] = config('const.asuransi_kartu_sehati');
		$data['asuransi_kemenkes_covid'] = config('const.asuransi_kemenkes_covid');

		return $data;
	}

	private function query($asuransi_ids_implode,$lokasi_ids,$kelas_ids,$start,$end)
	{

		$temp_start_of_month = $start->format('Y-m-d');
		$temp_end_of_month = $end->format('Y-m-d');


		$db_name = config('app.db_name');
		$query = "
		SELECT COUNT(1) as total FROM 
		`".$db_name."_kasus`.kasus k,
		`".$db_name."_lab_pk`.transaksi t,
		`".$db_name."_patients`.pasien_pembayaran pp
		WHERE t.kasus_id = k.id
		AND k.pasien_pembayaran_id = pp.id
		AND t.lokasi_id in ($lokasi_ids)
		AND pp.perusahaan_id in ($asuransi_ids_implode)
		AND k.kelas_id in ($kelas_ids)
		AND t.verified_at BETWEEN CAST('$temp_start_of_month' AS DATE) 
		AND CAST('$temp_end_of_month' AS DATE);
		";
		$query_result = DB::select($query);

		return $query_result[0]->total;
	}
}
