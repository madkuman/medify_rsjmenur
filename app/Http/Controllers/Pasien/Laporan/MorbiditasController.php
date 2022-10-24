<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Transaksi as IGDTransaksi;
use App\Models\RawatInap\Transaksi as RawatInapTransaksi;
use App\Models\RawatJalan\LaporanTransaksi as LaporanTransaksiRJ;
use App\Models\RawatInap\LaporanTransaksi as LaporanTransaksiRI;
use App\Models\IGD\LaporanTransaksi as LaporanTransaksiIGD;
use App\Models\RawatJalan\Transaksi as RawatJalanTransaksi;
use App\Models\Kasus\DTD;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use DB;

class MorbiditasController extends Controller
{
    static protected $ranap = "ri";
    static protected $ralan = "rj";
    static protected $igd = "igd";

    public function get($layanan, $format, $start, $end)
	{
		$date_start = Carbon::parse($start)->startOfDay();
        $date_end = Carbon::parse($end)->endOfDay();


        if($layanan == 'rj'){
            $dtd_ids = LaporanTransaksiRJ::whereBetween('waktu_pemeriksaan',[$date_start,$date_end])->pluck('dtd_id')->toArray();
        }
        elseif($layanan == 'ri'){
            $dtd_ids = LaporanTransaksiRI::whereBetween('krs_at',[$date_start,$date_end])->pluck('dtd_id')->toArray();
        }
        elseif($layanan == 'igd'){
            $dtd_ids = LaporanTransaksiIGD::whereBetween('waktu_masuk',[$date_start,$date_end])->pluck('dtd_id')->toArray();
        }


		if ($format == 'rj') {
            $data = $this->getLaporanRawatJalan($layanan,$date_start,$date_end,$dtd_ids);
		}
		else{
            $data = $this->getLaporanRawatInap($layanan,$date_start,$date_end, $dtd_ids);
		}

        $data['layanan'] = $this->getLayananName($layanan);

		return $data;
	}

    private function getTimeParameter($layanan)
    {
        if($layanan == 'ri') return 'krs_at';
        elseif($layanan == 'rj') return 'waktu_pemeriksaan';
        elseif($layanan == 'igd') return 'waktu_masuk';
    }


    private function getLayananName($layanan)
    {
        if($layanan == 'ri') return 'RAWAT INAP';
        elseif($layanan == 'rj') return 'RAWAT JALAN';
        elseif($layanan == 'igd') return 'IGD';
    }

    private function getDBConnection($layanan)
    {
        if($layanan == 'ri') return 'rawatinap';
        elseif($layanan == 'rj') return 'rawatjalan';
        elseif($layanan == 'igd') return 'igd';
    }

    public function getLaporanRawatJalan($layanan,$date_start,$date_end,$dtd_ids)
    {
        $time_parameter = $this->getTimeParameter($layanan);


        $dtd_ids_text = '';
        foreach($dtd_ids as $dtd_id)
        {
            $dtd_ids_text.= $dtd_id;
        }
        $dtd_ids = explode('-', $dtd_ids_text);
        $array_dtd = array_unique($dtd_ids);

        $date_start->toDateTimeString();
        $date_end->toDateTimeString();
        $dtds = DTD::whereIn('id',$array_dtd)->get();
        $query = '';
        $gender = [1,2];
        $min_usia_array = [0,7,29,365,1825,5475,9125,16425,23725];
        $max_usia_array = [6,28,364,1824,5474,9124,16424,23724,99999];
        $merge_transaksi = [];

        foreach ($min_usia_array as $key_usia => $min_usia_item) {
            $min_usia = $min_usia_array[$key_usia];
            $max_usia = $max_usia_array[$key_usia];

            foreach($gender as $gender_item){
                $code = $min_usia.'-'.$max_usia.'-'.$gender_item;
                $query.= "
                    SELECT ltd.`dtd_id`, COUNT(1) AS total, '".$code."' AS code
                    FROM 
                    `laporan_transaksi` lt,
                    `laporan_transaksi_diagnosis` ltd
                    WHERE 
                    lt.`kasus_id` = ltd.`kasus_id`
                    AND jenis_kelamin IN (".$gender_item.")
                    AND usia_masuk_hr <= ".$max_usia."
                    AND usia_masuk_hr >= ".$min_usia."
                    AND ".$time_parameter." >= '".$date_start."'
                    AND ".$time_parameter." <= '".$date_end."'
                    GROUP BY ltd.`dtd_id`
                    UNION
                     ";
            }
        }

        $query.= "
            SELECT ltd.`dtd_id`, COUNT(1) AS total, 'all-baru-1' AS code
            FROM 
            `laporan_transaksi` lt,
            `laporan_transaksi_diagnosis` ltd
            WHERE 
            lt.`kasus_id` = ltd.`kasus_id`
            AND jenis_kelamin IN (1)
            AND ".$time_parameter." >= '".$date_start."'
            AND ".$time_parameter." <= '".$date_end."'
            AND is_pasien_baru = 1
            GROUP BY ltd.`dtd_id`
            UNION";
        $query.= "
            SELECT ltd.`dtd_id`, COUNT(1) AS total, 'all-baru-2' AS code
            FROM 
            `laporan_transaksi` lt,
            `laporan_transaksi_diagnosis` ltd
            WHERE 
            lt.`kasus_id` = ltd.`kasus_id`
            AND jenis_kelamin IN (2)
            AND ".$time_parameter." >= '".$date_start."'
            AND ".$time_parameter." <= '".$date_end."'
            AND is_pasien_baru = 1
            GROUP BY ltd.`dtd_id`
            ";


        $db = $this->getDBConnection($layanan);
        $data = DB::connection($db)->select($query);
        foreach($data as $item)
        {
            $merge_transaksi[$item->dtd_id][$item->code] = $item->total;
        }
        $dtds = DTD::all();
        $return['transaksi'] = $merge_transaksi;
        $return['dtds'] = $dtds;
        return $return;
    }




    public function getLaporanRawatInap($layanan,$date_start,$date_end,$dtd_ids)
    {
        $time_parameter = $this->getTimeParameter($layanan);
        $db = $this->getDBConnection($layanan);
        if($layanan == 'rj') {
            $query_krs = '';
            $total_mati_default = 0;
        }
        else {
            $query_krs = "AND krs_status != 'Meninggal'";
            $total_mati_default = "COUNT(1)";
        }
        $query_krs_meninggal = "AND krs_status = 'Meninggal'";

        $date_start->toDateTimeString();
        $date_end->toDateTimeString();
        $query = '';
        $gender = [1,2];
        $min_usia_array = [0,7,29,365,1825,5475,9125,16425,23725];
        $max_usia_array = [6,28,364,1824,5474,9124,16424,23724,99999];
        $merge_transaksi = [];
        $count = 0;

        foreach ($min_usia_array as $key_usia => $min_usia_item) {
            $min_usia = $min_usia_array[$key_usia];
            $max_usia = $max_usia_array[$key_usia];

            foreach($gender as $gender_item){
                $code = $min_usia.'-'.$max_usia.'-'.$gender_item;
                $query.= "
                    
                    SELECT ltd.`dtd_id`, COUNT(1) AS total, '".$code."' AS code
                    FROM 
                        `laporan_transaksi` lt,
                        `laporan_transaksi_diagnosis` ltd
                    WHERE 
                        lt.`kasus_id` = ltd.`kasus_id`
                        AND jenis_kelamin IN (".$gender_item.")
                        AND usia_masuk_hr <= ".$max_usia."
                        AND usia_masuk_hr >= ".$min_usia."
                        AND ".$time_parameter." >= '".$date_start."'
                        AND ".$time_parameter." <= '".$date_end."'
                    GROUP BY ltd.`dtd_id`
                    UNION
                    ";
            }
        }

        $query.= "
            SELECT ltd.`dtd_id`, COUNT(1) AS total, 'total-1' AS code
            FROM 
                `laporan_transaksi` lt,
                `laporan_transaksi_diagnosis` ltd
            WHERE 
                lt.`kasus_id` = ltd.`kasus_id`
                AND jenis_kelamin IN (1)
                AND ".$time_parameter." >= '".$date_start."'
                AND ".$time_parameter." <= '".$date_end."'
            GROUP BY ltd.`dtd_id`
            UNION
            ";
        $query.= "
            SELECT ltd.`dtd_id`, COUNT(1) AS total, 'total-2' AS code
            FROM 
                `laporan_transaksi` lt,
                `laporan_transaksi_diagnosis` ltd
            WHERE 
                lt.`kasus_id` = ltd.`kasus_id`
                AND jenis_kelamin IN (2)
                AND ".$time_parameter." >= '".$date_start."'
                AND ".$time_parameter." <= '".$date_end."'
            GROUP BY ltd.`dtd_id`
            UNION
            ";
        $query.= "
            SELECT ltd.`dtd_id`, COUNT(1) AS total, 'total-hidup' AS code
            FROM 
                `laporan_transaksi` lt,
                `laporan_transaksi_diagnosis` ltd
            WHERE 
                lt.`kasus_id` = ltd.`kasus_id`
                AND jenis_kelamin IN (1,2)
                AND ".$time_parameter." >= '".$date_start."'
                AND ".$time_parameter." <= '".$date_end."'
                ".$query_krs."
            GROUP BY ltd.`dtd_id`
            UNION
            ";
        $query.= "
            SELECT ltd.`dtd_id`, ".$total_mati_default." AS total, 'total-meninggal' AS code
            FROM 
                `laporan_transaksi` lt,
                `laporan_transaksi_diagnosis` ltd
            WHERE 
                lt.`kasus_id` = ltd.`kasus_id`
                AND jenis_kelamin IN (1,2)
                AND ".$time_parameter." >= '".$date_start."'
                AND ".$time_parameter." <= '".$date_end."'
                ".$query_krs_meninggal."
            GROUP BY ltd.`dtd_id`
            
            ";
        $data = DB::connection($db)->select($query);
        foreach($data as $item)
        {
            $merge_transaksi[$item->dtd_id][$item->code] = $item->total;
        }
        $dtds = DTD::all();
        $return['transaksi'] = $merge_transaksi;
        $return['dtds'] = $dtds;
        return $return;
    }
}
