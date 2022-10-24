<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;

class PengunjungKunjunganIGDTriwulan extends Controller
{
    public function getPengunjung($triwulan,$tahun)
	{
		$time_start = microtime(true); 
		if ($triwulan==1) {
			$bulan_start = [1,2,3,1];
			$bulan_end = [1,2,3,3];
		}
		elseif ($triwulan==2) {
			$bulan_start = [4,5,6,4];
			$bulan_end = [4,5,6,6];
		}
		elseif ($triwulan==3) {
			$bulan_start = [7,8,9,7];
			$bulan_end = [7,8,9,9];
		}
		elseif ($triwulan==4) {
			$bulan_start = [10,11,12,10];
			$bulan_end = [10,11,12,12];
		}

		$lama_baru = [1,0];
		$jenis_kelamin = [1,2];


		$grup = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getPerusahaanArray();
		$grup_all = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getGroupLaporanMerge();
		$ruangan = app('App\Http\Controllers\IGD\Ruangan\ReadController')->allRuanganPrint()->pluck('id')->toArray();

		$count = 0;
		$ruangan_count = 0;
		$query = '';

		foreach($bulan_start as $bulan_index => $bulan_item){

			$date_start = Carbon::createFromDate($tahun, $bulan_item, 1)->startOfDay()->toDateTimeString();
			$date_end = Carbon::createFromDate($tahun, $bulan_end[$bulan_index], 1)->endOfMonth()->endOfDay()->toDateTimeString();

			foreach ($grup as $grup_item) {
				foreach($lama_baru as $lama_baru_item)
				{
					$lama_baru_item_array = array($lama_baru_item);
					$query.= $this->singleQuery($count,$ruangan,$grup_item,$date_start,$date_end,$lama_baru_item_array,$jenis_kelamin,'UNION','DISTINCT pasien_id');
					$count++;
				} 
			}

			foreach($lama_baru as $lama_baru_item)
			{
				$lama_baru_item_array = array($lama_baru_item);
				$query.= $this->singleQuery($count,$ruangan,$grup_all,$date_start,$date_end,$lama_baru_item_array,$jenis_kelamin,'UNION','DISTINCT pasien_id');
				$count++;  
			} 

			foreach($jenis_kelamin as $jenis_kelamin_item)
			{
				$jenis_kelamin_item_array = array($jenis_kelamin_item);
				$query.= $this->singleQuery($count,$ruangan,$grup_all,$date_start,$date_end,$lama_baru,$jenis_kelamin_item_array,'UNION','DISTINCT pasien_id');
				$count++;  
			}  

			$query.= $this->singleQuery($count,$ruangan,$grup_all,$date_start,$date_end,$lama_baru,$jenis_kelamin,'UNION','DISTINCT pasien_id');
			$count++;  
		}
		$ruangan_count++;
		$query = substr($query, 0, -5);
		$results = DB::connection('igd')->select( DB::raw($query));
		$ruangan_count = 0;

		$time_end = microtime(true);

		$execution_time = $time_end - $time_start;
		$transaksi_merged = [];
		foreach($results as $item)
		{
			$transaksi_merged[$item->id][$item->count_num] = $item->total;
		}
		return $transaksi_merged;
	}

	public function getKunjungan($triwulan,$tahun)
    {
        $time_start = microtime(true); 
        if ($triwulan==1) {
            $bulan_start = [1,2,3,1];
            $bulan_end = [1,2,3,3];
        }
        elseif ($triwulan==2) {
            $bulan_start = [4,5,6,4];
            $bulan_end = [4,5,6,6];
        }
        elseif ($triwulan==3) {
            $bulan_start = [7,8,9,7];
            $bulan_end = [7,8,9,9];
        }
        elseif ($triwulan==4) {
            $bulan_start = [10,11,12,10];
            $bulan_end = [10,11,12,12];
        }

        $lama_baru = [1,0];
        $jenis_kelamin = [1,2];


        $grup = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getPerusahaanArray();
        $grup_all = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getGroupLaporanMerge();
		$ruangan = app('App\Http\Controllers\IGD\Ruangan\ReadController')->allRuanganPrint()->pluck('id')->toArray();

        $count = 0;
        $ruangan_count = 0;
        $query = '';

        foreach($bulan_start as $bulan_index => $bulan_item){

            $date_start = Carbon::createFromDate($tahun, $bulan_item, 1)->startOfDay()->toDateTimeString();
            $date_end = Carbon::createFromDate($tahun, $bulan_end[$bulan_index], 1)->endOfMonth()->endOfDay()->toDateTimeString();

            foreach ($grup as $grup_item) {
                foreach($lama_baru as $lama_baru_item)
                {
                    $lama_baru_item_array = array($lama_baru_item);
                    $query.= $this->singleQuery($count,$ruangan,$grup_item,$date_start,$date_end,$lama_baru_item_array,$jenis_kelamin,'UNION','1');
                    $count++;
                } 
            }

            foreach($lama_baru as $lama_baru_item)
            {
                $lama_baru_item_array = array($lama_baru_item);
                $query.= $this->singleQuery($count,$ruangan,$grup_all,$date_start,$date_end,$lama_baru_item_array,$jenis_kelamin,'UNION','1');
                $count++;  
            } 

            foreach($jenis_kelamin as $jenis_kelamin_item)
            {
                $jenis_kelamin_item_array = array($jenis_kelamin_item);
                $query.= $this->singleQuery($count,$ruangan,$grup_all,$date_start,$date_end,$lama_baru,$jenis_kelamin_item_array,'UNION','1');
                $count++;  
            }  

            $query.= $this->singleQuery($count,$ruangan,$grup_all,$date_start,$date_end,$lama_baru,$jenis_kelamin,'UNION','1');
            $count++;  
        }
        $ruangan_count++;

        $query = substr($query, 0, -5);
        $results = DB::connection('igd')->select( DB::raw($query));
        $ruangan_count = 0;

        $time_end = microtime(true);

        $execution_time = $time_end - $time_start;
        $transaksi_merged = [];
        foreach($results as $item)
        {
          $transaksi_merged[$item->id][$item->count_num] = $item->total;
        }
        return $transaksi_merged;
    }

	private function singleQuery($count,$ruangan_id,$perusahaan_ids,$date_start,$date_end,$is_baru,$jenis_kelamin,$union,$count_type)
	{
		$query = "
		SELECT ruangan.id, 'count-".$count."' as count_num, transaksi.total
		FROM 
		`".config('app.db_name')."_igd`.`ruangan` ruangan
		LEFT JOIN
		(
			SELECT
				ruangan_id, 
				COUNT(".$count_type.") as total
			FROM 
				laporan_transaksi
			WHERE 
				is_pasien_baru IN (".implode(",", $is_baru).")
				AND perusahaan_pembayaran_id IN (".implode(",", $perusahaan_ids).")
				AND waktu_masuk >= '".$date_start."'
				AND waktu_masuk <= '".$date_end."'
				AND jenis_kelamin IN (".implode(",", $jenis_kelamin).")
			GROUP BY ruangan_id
		) transaksi
		ON
		ruangan.id = transaksi.`ruangan_id`
		WHERE ruangan.deleted_at IS NULL
		".$union;
		return $query;
	}
}
