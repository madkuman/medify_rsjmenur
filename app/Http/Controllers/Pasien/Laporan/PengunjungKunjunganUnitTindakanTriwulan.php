<?php

namespace App\Http\Controllers\Pasien\Laporan;

use App\Models\UnitTindakan\UnitTindakan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;

class PengunjungKunjunganUnitTindakanTriwulan extends Controller
{
    public function laporan_kunjungan($triwulan,$tahun)
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
        $poli = UnitTindakan::all()->pluck('id')->toArray();

        $count = 0;
        $poli_result = [];
        $poli_count = 0;
        $query = '';

        foreach($bulan_start as $bulan_index => $bulan_item){

            $date_start = Carbon::createFromDate($tahun, $bulan_item, 1)->startOfDay()->toDateTimeString();
            $date_end = Carbon::createFromDate($tahun, $bulan_end[$bulan_index], 1)->endOfMonth()->endOfDay()->toDateTimeString();

            foreach ($grup as $grup_item) {
                foreach($lama_baru as $lama_baru_item)
                {
                    $lama_baru_item_array = array($lama_baru_item);
                    $query.= $this->singleQuery($count,$poli,$grup_item,$date_start,$date_end,$lama_baru_item_array,$jenis_kelamin,'UNION');
                    $count++;
                }
            }

            foreach($lama_baru as $lama_baru_item)
            {
                $lama_baru_item_array = array($lama_baru_item);
                $query.= $this->singleQuery($count,$poli,$grup_all,$date_start,$date_end,$lama_baru_item_array,$jenis_kelamin,'UNION');
                $count++;
            }

            foreach($jenis_kelamin as $jenis_kelamin_item)
            {
                $jenis_kelamin_item_array = array($jenis_kelamin_item);
                $query.= $this->singleQuery($count,$poli,$grup_all,$date_start,$date_end,$lama_baru,$jenis_kelamin_item_array,'UNION');
                $count++;
            }

            $query.= $this->singleQuery($count,$poli,$grup_all,$date_start,$date_end,$lama_baru,$jenis_kelamin,'UNION');
            $count++;
        }
        $poli_count++;
        $query = substr($query, 0, -5);
        $results = DB::connection('unit_tindakan')->select( DB::raw($query));
        $poli_count = 0;
        $time_end = microtime(true);

        $execution_time = $time_end - $time_start;
        $transaksi_merged = [];
        foreach($results as $item)
        {
            $transaksi_merged[$item->unit_tindakan_id][$item->count_num] = $item->total;
        }
        return $transaksi_merged;
    }

    private function singleQuery($count,$poli_id,$perusahaan_ids,$date_start,$date_end,$is_baru,$jenis_kelamin,$union)
    {
        if(count($is_baru) == 2)
        {
            $is_baru = '';
        }elseif (count($is_baru) == 1 && $is_baru[0] == 1){
            $is_baru = 'AND kasus.is_baru IN ('.implode(",",$is_baru).')';
        }else{
            $is_baru = 'AND kasus.is_baru IS NULL';
        }


        $query = "
		SELECT unit.id as unit_tindakan_id, 'count-".$count."' as count_num,transaksi.total
		FROM 
		`".config('app.db_name')."_unit_tindakan`.`unit_tindakan` unit
		LEFT JOIN
		(

		SELECT
		unit_tindakan_id,
		COUNT(transaksi.id) AS total
		FROM 
		`".config('app.db_name')."_unit_tindakan`.`transaksi` transaksi
		JOIN `".config('app.db_name')."_kasus`.`kasus` as kasus on transaksi.kasus_id = kasus.id
		JOIN  `".config('app.db_name')."_patients`.`pasien` as pasien on kasus.pasien_id = pasien.id
		JOIN  `".config('app.db_name')."_patients`.`pasien_pembayaran` as pasien_pembayaran on kasus.pasien_pembayaran_id = pasien_pembayaran.id
		WHERE pasien_pembayaran.perusahaan_id IN (".implode(",", $perusahaan_ids).")
		AND transaksi.created_at >= '".$date_start."'
		AND transaksi.created_at <= '".$date_end."'
		AND pasien.gender IN (".implode(",", $jenis_kelamin).")
		".$is_baru."
		GROUP BY unit_tindakan_id
		) transaksi
		ON
		unit.id = transaksi.`unit_tindakan_id`
		WHERE unit.deleted_at IS NULL
		".$union;
        return $query;
    }
}
