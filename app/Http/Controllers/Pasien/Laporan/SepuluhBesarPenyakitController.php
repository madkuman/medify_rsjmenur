<?php

namespace App\Http\Controllers\Pasien\Laporan;

use App\Models\Hospital\MasterStatusPulang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Transaksi as IGDTransaksi;
use App\Models\RawatInap\Transaksi as RawatInapTransaksi;
use App\Models\RawatJalan\Transaksi as RawatJalanTransaksi;
use App\Models\RawatJalan\LaporanTransaksi as LaporanTransaksiRJ;
use App\Models\RawatInap\LaporanTransaksi as LaporanTransaksiRI;
use App\Models\RawatInap\LaporanTransaksiDiagnosis as LaporanTransaksiDiagnosisRI;
use App\Models\Kasus\DTD;
use App\Models\Kasus\Diagnosis;
use Carbon\Carbon;
use DB;

class SepuluhBesarPenyakitController extends Controller
{

    static protected $ranap = "ri";
    static protected $ralan = "rj";
    static protected $igd = "igd";



    private function getTimeParameter($layanan)
    {
        if($layanan == 'ri') return 'krs_at';
        elseif($layanan == 'rj') return 'waktu_pemeriksaan';
        elseif($layanan == 'igd') return 'waktu_masuk';
    }


    private function getLayananName($layanan)
    {
        if($layanan == 'ri') return 'Rawat Inap';
        elseif($layanan == 'rj') return 'Rawat Jalan';
        elseif($layanan == 'igd') return 'IGD';
    }

    private function getDBConnection($layanan)
    {
        if($layanan == 'ri') return 'rawatinap';
        elseif($layanan == 'rj') return 'rawatjalan';
        elseif($layanan == 'igd') return 'igd';
    }

	public function getRJ($layanan, $start, $end)
	{
		$date_start = Carbon::parse($start)->startOfDay();
		$date_end = Carbon::parse($end)->endOfDay();
        $time_parameter = $this->getTimeParameter($layanan);
		/*GET TOP DTD*/
		$query= "
				SELECT *
				FROM (
				SELECT ltd.`dtd_id`, COUNT(1) AS total
				FROM 
					`laporan_transaksi` lt,
					`laporan_transaksi_diagnosis` ltd
				WHERE 
					lt.`kasus_id` = ltd.`kasus_id`
					AND lt.jenis_kelamin IN (1,2)
					AND lt.".$time_parameter." >= '".$date_start."'
					AND lt.".$time_parameter." <= '".$date_end."'
					AND ltd.dtd_id != 0
				GROUP BY ltd.`dtd_id`) transaksi_count
				ORDER BY total DESC
				LIMIT 10
			";
        $db = $this->getDBConnection($layanan);
        $dtds = DB::connection($db)->select($query);

        if(count($dtds) == 0) {
        	$data['dtds'] = [];
        	return $data;
        }
        
		/*COUNT TRANSAKSI*/
		$date_start->toDateTimeString();
		$date_end->toDateTimeString();
		$query = '';
		$gender = [1,2];
		$merge_transaksi = [];
		foreach($dtds as $key_dtd => $dtd){
			foreach($gender as $gender_item){
				$code = 'baru-'.$gender_item;
				$query.= "
				SELECT '".$dtd->dtd_id."' as dtd_id,'".$code."' as code, COUNT(1) AS total
				FROM 
					`laporan_transaksi` lt,
					`laporan_transaksi_diagnosis` ltd
				WHERE 
					lt.`kasus_id` = ltd.`kasus_id`
					AND ltd.dtd_id = ".$dtd->dtd_id."
					AND jenis_kelamin IN (".$gender_item.")
					AND ".$time_parameter." >= '".$date_start."'
					AND ".$time_parameter." <= '".$date_end."'
					AND is_pasien_baru = 1
				GROUP BY ltd.`dtd_id`
				UNION";
			}
			$query.= "


			SELECT '".$dtd->dtd_id."' as dtd_id,'baru' as code, COUNT(1) AS total
			FROM 
				`laporan_transaksi` lt,
				`laporan_transaksi_diagnosis` ltd
			WHERE 
				lt.`kasus_id` = ltd.`kasus_id`
				AND ltd.dtd_id = ".$dtd->dtd_id."
				AND jenis_kelamin IN (1,2)
				AND ".$time_parameter." >= '".$date_start."'
				AND ".$time_parameter." <= '".$date_end."'
				AND is_pasien_baru = 1
			GROUP BY ltd.`dtd_id`


			UNION";
			$query.= "
			SELECT '".$dtd->dtd_id."' as dtd_id,'all' as code, COUNT(1) AS total
			FROM 
				`laporan_transaksi` lt,
				`laporan_transaksi_diagnosis` ltd
			WHERE 
				lt.`kasus_id` = ltd.`kasus_id`
				AND ltd.dtd_id = ".$dtd->dtd_id."
				AND jenis_kelamin IN (1,2)
				AND ".$time_parameter." >= '".$date_start."'
				AND ".$time_parameter." <= '".$date_end."'
			GROUP BY ltd.`dtd_id`
			UNION";
		} /*END OF FOREACH DTD*/

		$query = substr($query, 0, -5);
        
        $db = $this->getDBConnection($layanan);
        $data = DB::connection($db)->select($query);

		foreach($data as $item)
		{
			$merge_transaksi[$item->dtd_id][$item->code] = $item->total;
		}
		$dtds = [];
		foreach ($merge_transaksi as $key => $value) {
			$dtd_item = DTD::find($key);
			$dtd_item->transaksi = $value;
			$dtds[] = $dtd_item;
		}
		
		$return['dtds'] = $dtds;

		return $return;
	}
	public function getRI($layanan,$start, $end)
	{
		$date_start = Carbon::parse($start)->startOfDay();
		$date_end = Carbon::parse($end)->endOfDay();
		
        $time_parameter = $this->getTimeParameter($layanan);
		$query= "
				SELECT *
				FROM (
				SELECT ltd.`dtd_id`, COUNT(1) AS total
				FROM 
					`laporan_transaksi` lt,
					`laporan_transaksi_diagnosis` ltd
				WHERE 
					lt.`kasus_id` = ltd.`kasus_id`
					AND lt.jenis_kelamin IN (1,2)
					AND lt.krs_at >= '".$date_start."'
					AND lt.krs_at <= '".$date_end."'
					AND ltd.dtd_id != 0
				GROUP BY ltd.`dtd_id`) transaksi_count
				ORDER BY total DESC
				LIMIT 10
			";
        $db = $this->getDBConnection($layanan);
        $dtds = DB::connection($db)->select($query);

		if(!empty($dtds)) {
            $date_start->toDateTimeString();
            $date_end->toDateTimeString();
            $query = '';
            $gender = [1, 2];
            $merge_transaksi = [];
            foreach ($dtds as $dtd) {
                foreach ($gender as $gender_item) {
                    $code = 'all-' . $gender_item;
                    $query .= "		
				SELECT '" . $dtd->dtd_id . "' as dtd_id,'" . $code . "' as code, COUNT(1) AS total
				FROM 
					`laporan_transaksi` lt,
					`laporan_transaksi_diagnosis` ltd
				WHERE 
					lt.`kasus_id` = ltd.`kasus_id`
					AND ltd.dtd_id = " . $dtd->dtd_id . "
					AND lt.jenis_kelamin IN (" . $gender_item . ")
					AND lt.krs_at >= '" . $date_start . "'
					AND lt.krs_at <= '" . $date_end . "'
				GROUP BY ltd.`dtd_id`
				UNION";
                };
                $query .= "
				SELECT '" . $dtd->dtd_id . "' as dtd_id,'all-meninggal' as code, COUNT(1) AS total
				FROM 
					`laporan_transaksi` lt,
					`laporan_transaksi_diagnosis` ltd
				WHERE 
					lt.`kasus_id` = ltd.`kasus_id`
					AND ltd.dtd_id = " . $dtd->dtd_id . "
					AND lt.jenis_kelamin IN (1,2)
					AND lt.krs_at >= '" . $date_start . "'
					AND lt.krs_at <= '" . $date_end . "'
					AND lt.krs_status = 'Meninggal'
				GROUP BY ltd.`dtd_id`
			UNION";
            } /*END OF FOREACH DTD*/

            $query = substr($query, 0, -5);
            $db = $this->getDBConnection($layanan);
            $data = DB::connection($db)->select($query);

            foreach ($data as $item) {
                $merge_transaksi[$item->dtd_id][$item->code] = $item->total;
            }
            $dtds = [];
            foreach ($merge_transaksi as $key => $value) {
                $dtd_item = DTD::find($key);
                $dtd_item->transaksi = $value;
                $dtds[] = $dtd_item;
            }
        }
		
		$return['dtds'] = $dtds;


		return $return;
	}

	public function getMeninggal($date_start, $date_end)
	{
        $meninggal = MasterStatusPulang::where('slug','meninggal')->first()->id;
		
		$query= "
				SELECT * FROM (
					SELECT * FROM (
						SELECT dtd.id AS dtd_id, COUNT(1) AS total FROM diagnosis, icd_10, dtd, kasus, identitas
						WHERE diagnosis.`icd_10` = icd_10.`id`
						AND dtd.`id` = icd_10.`dtd_id`
						AND diagnosis.`kasus_id` = kasus.`id`
						AND kasus.krs_at >= '".$date_start."'
						AND kasus.krs_at <= '".$date_end."'
						AND kasus.id = identitas.kasus_id
						AND identitas.jenis_kelamin IN ('P','L')
						AND kasus.`krs_status` = $meninggal
						AND diagnosis.deleted_at IS NULL
						GROUP BY dtd.id) transaksi
					ORDER BY total DESC
				) transaksi_ordered
				LIMIT 10
				;
			";
		$dtds = DB::connection('kasus')->select($query);
		/*COUNT TRANSAKSI*/
		$date_start->toDateTimeString();
		$date_end->toDateTimeString();
		$query = '';
		$gender = ['L','P'];
		$merge_transaksi = [];
		foreach($dtds as $dtd){
			foreach($gender as $gender_item){
				$code = 'all-'.$gender_item;
				$query.= "		
				SELECT dtd.id AS dtd_id, COUNT(1) AS total, '".$code."' as code
				FROM diagnosis, icd_10, dtd, kasus, identitas
				WHERE diagnosis.`icd_10` = icd_10.`id`
				AND dtd.`id` = icd_10.`dtd_id`
				AND diagnosis.`kasus_id` = kasus.`id`
				AND kasus.krs_at >= '".$date_start."'
				AND kasus.krs_at <= '".$date_end."'
				AND dtd.id = ".$dtd->dtd_id."
				AND kasus.id = identitas.kasus_id
				AND identitas.jenis_kelamin IN ('".$gender_item."')
				AND kasus.`krs_status` = $meninggal
				AND diagnosis.deleted_at IS NULL
				GROUP BY dtd.id
				UNION";
			};
			$query.= "		
				SELECT dtd.id AS dtd_id, COUNT(1) AS total, 'total' as code
				FROM diagnosis, icd_10, dtd, kasus, identitas
				WHERE diagnosis.`icd_10` = icd_10.`id`
				AND dtd.`id` = icd_10.`dtd_id`
				AND diagnosis.`kasus_id` = kasus.`id`
				AND kasus.krs_at >= '".$date_start."'
				AND kasus.krs_at <= '".$date_end."'
				AND dtd.id = ".$dtd->dtd_id."
				AND kasus.id = identitas.kasus_id
				AND identitas.jenis_kelamin IN ('L','P')
				AND kasus.`krs_status` = $meninggal
				AND diagnosis.deleted_at IS NULL
				GROUP BY dtd.id
			UNION";
		} /*END OF FOREACH DTD*/

		$query = substr($query, 0, -5);
		$data = DB::connection('kasus')->select($query);
		foreach($data as $item)
		{
			$merge_transaksi[$item->dtd_id][$item->code] = $item->total;
		}
		$dtds = [];
		foreach ($merge_transaksi as $key => $value) {
			$dtd_item = DTD::find($key);
			$dtd_item->transaksi = $value;
			$dtds[] = $dtd_item;
		}
		
		$return['dtds'] = $dtds;

		return $return;
	}
}
