<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PembayaranPerusahaanType;
use App\Models\LabPK\TransaksiDetail;
use App\Models\Urikkes\Paket;
use App\Models\Hospital\Kelas;
use DB;

class ReadLaporanDataStatusRajalController extends Controller
{
	public function get($start,$end)
	{
		$labpk = config('const.lab-pk');

		$data = [];

		$asuransi_list = $this->getAsuransi();
		$kelas = Kelas::where('rawat_jalan',1)->orWhere('igd',1)->get();


        $lokasi_igd = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['igd']);
        $data['igd'] = $this->getData($start,$end,$lokasi_igd,$asuransi_list,$kelas);

		$lokasi_rawat_jalan = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-jalan']);
        $data['rawat_jalan'] = $this->getData($start,$end,$lokasi_rawat_jalan,$asuransi_list,$kelas);

        $data['medical_checkup'] = $this->getDataMedicalCheckup($start,$end,$asuransi_list,$kelas);


		$all_asuransi = [];
		foreach($asuransi_list as $asuransi_item)
		{
			$all_asuransi = array_merge($all_asuransi,$asuransi_item);
		}

		
		$result['data'] = $data;
		$result['asuransi'] = PembayaranPerusahaan::whereIn('id',$all_asuransi)->get();
		$result['kelas'] = $kelas;
		return $result;
	}

	private function getData($start,$end,$lokasi_list,$asuransi_list,$kelas)
	{
		$kelas_ids = $kelas->pluck('id')->toArray();
		$kelas_ids_implode = implode(",", $kelas_ids);
		foreach($lokasi_list as $lokasi)
		{
			$lokasi_ids = $lokasi->id;

			$temp = [];
			$temp['lokasi'] = $lokasi->nama;

			foreach ($asuransi_list as $asuransi_slug => $asuransi_ids) 
			{
				$asuransi_ids_implode = implode(",", $asuransi_ids);


				if($asuransi_slug == 'asuransi_tunai')
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

		return $data;
	}

	
	private function getDataMedicalCheckup($start,$end,$asuransi_list,$kelas)
	{
		$temp_start_of_month = $start->startOfMonth()->format('Y-m-d');
		$temp_end_of_month = $end->endOfMonth()->format('Y-m-d');
		$db_name = config('app.db_name');

		$query = "SELECT p.id,p.nama, COUNT(1) as total FROM 
		`".$db_name."_kasus`.kasus k,
		`".$db_name."_urikkes`.transaksi t,
		`".$db_name."_urikkes`.transaksi_detail td,
		`".$db_name."_urikkes`.paket p,
		`".$db_name."_lab_pk`.transaksi t_labpk
		WHERE t.kasus_id = k.id
		AND t.id = td.transaksi_id
		AND td.paket_id = p.id
		AND t_labpk.kasus_id = k.id
		AND t_labpk.verified_at BETWEEN CAST('$temp_start_of_month' AS DATE) 
		AND CAST('$temp_end_of_month' AS DATE)
		GROUP BY p.id;";

		$result = DB::connection('lab_pk')->select($query);
		
		$data = [];
		$exclude_ids = [];

		foreach($result as $item)
		{
			$temp = [];
			$temp['lokasi'] = $item->nama;
			foreach($asuransi_list as $asuransi_slug => $asuransi_ids )
			{

				if($asuransi_slug == 'asuransi_sk_direktur') $total = $item->total;
				else $total = 0;

				if($asuransi_slug == 'asuransi_tunai')
				{
					foreach($kelas as $kelas_item)
					{
						$kelas_ids = $kelas_item->id;
						$temp[$asuransi_slug][$kelas_item->id] = $total;
					}
				}
				else
				{
					$temp[$asuransi_slug][0] = $total;
				}
			}
			$data[] = $temp;
			$exclude_ids[] = $item->id;
		}

		$paket_not_include = Paket::whereNotIn('id',$exclude_ids)->get();

		foreach($paket_not_include as $item)
		{
			$temp = [];
			$temp['lokasi'] = $item->nama;
			$total = 0;

			foreach($asuransi_list as $asuransi_slug => $asuransi_ids )
			{
				if($asuransi_slug == 'asuransi_tunai')
				{
					foreach($kelas as $kelas_item)
					{
						$kelas_ids = $kelas_item->id;
						$temp[$asuransi_slug][$kelas_item->id] = $total;
					}
				}
				else
				{
					$temp[$asuransi_slug][0] = $total;
				}
			}
			$data[] = $temp;
		}

		return $data;
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
		$data['asuransi_sk_direktur'] = config('const.asuransi_sk_direktur');

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
