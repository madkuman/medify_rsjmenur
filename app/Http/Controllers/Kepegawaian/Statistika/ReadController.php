<?php

namespace App\Http\Controllers\Kepegawaian\Statistika;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kepegawaian\Pegawai;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;


class ReadController extends Controller{

    function __construct(){
		$this->user = \Auth::user();

        $this->time = Carbon::now();
	}

    // Ajax 
    function ajaxIndexJenisPegawai(){
        return self::jenisPegawai();
    }
    function ajaxIndexStatusPegawai(){
        return self::statusPegawai();
    }
    function ajaxIndexGender(){
        return self::genderPegawai();
    }
    function ajaxIndexUmur(){
        return self::usiaPegawai();
    }
    function ajaxIndexPegawaiAktif(){
        return self::pegawaiAktif();
    }
    function ajaxIndexPegawaiKeluar(){
        return self::pegawaiKeluar();
    }


    // Haighlight Kotak
    function totalPegawai(){

        $items = Pegawai::count();
        return $items;
    }

    function totalStatusPegawai(){

        $items = DB::connection('kepegawaian')->select('SELECT count(a.status_pegawai_id) as jumlah, b.status FROM pegawai AS a RIGHT JOIN master_status_pegawai as b ON a.status_pegawai_id=b.id WHERE a.deleted_at IS NULL GROUP BY b.id');
       
        return $items;

    }

    function totalJenisPegawai(){

        $items = DB::connection('kepegawaian')->select('SELECT count(a.jenis_pegawai_id) as jumlah, b.nama FROM pegawai AS a RIGHT JOIN master_jenis_pegawai as b ON a.jenis_pegawai_id=b.id WHERE a.deleted_at IS NULL GROUP BY b.id');
        
        return $items;

    }

    // Line Chart
    function pegawaiAktif(){

        $date = self::getDateRange();
        $data = [];
        for ($i=0; $i < sizeof($date); $i++) { 
          $dmy = $date[$i];
          $current_date = Carbon::createFromFormat('Y-m-d', $dmy['year'].'-'.$dmy['month'].'-01');
          $start = $current_date->copy()->startOfMonth();
          $end = $current_date->copy()->endOfMonth();
          $data[$i]['active'] = Pegawai::where('tmt_out','<',$start)->orWhereNull('tmt_out')->count();
          $data[$i]['tanggal'] = Carbon::parse($this->time->format('d').'-'.$date[$i]['month'].'-'.$date[$i]['year'])->format('Y-m-d');
        }
        return $data;

    }

    function pegawaiKeluar(){

        $date = self::getDateRange();
    
        $data = [];
        for ($i=0; $i < sizeof($date); $i++) { 
          $dmy = $date[$i];
          $current_date = Carbon::createFromFormat('Y-m-d', $dmy['year'].'-'.$dmy['month'].'-01');
          $start = $current_date->copy()->startOfMonth();
          $end = $current_date->copy()->endOfMonth();
          $data[$i]['out'] = Pegawai::whereBetween('tmt_out',[$start,$end])->count();
          $data[$i]['tanggal'] = Carbon::parse($this->time->format('d').'-'.$date[$i]['month'].'-'.$date[$i]['year'])->format('Y-m-d');
        }
    
        return $data;

    }

    // Pie Chart
    function usiaPegawai(){
        $age = DB::connection('kepegawaian')->select('SELECT name, TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS umur FROM pegawai WHERE deleted_at IS NULL ');
        
        $counts = [];
        $counts[] = ["values"=> [0, 24], "records" => []];
        $counts[] = ["values"=> [25, 39], "records" => []];
        $counts[] = ["values"=> [40, 54], "records" => []];
        $counts[] = ["values"=> [55, 150], "records" => []];

        foreach ($age as $number) {
            foreach ($counts as $key => &$value) {
                if ($number->umur >= $value["values"][0] && $number->umur <= $value["values"][1]) {
                    $value["records"][] = $number->umur;
                }
            }
        }
        foreach ($counts as $count){
            if ($count["values"][0] == 0){
                $cat = " < 24 ";
            } else if ($count["values"][0] == 25){
                $cat = " 25 - 39 ";
            } else if ($count["values"][0] == 40){
                $cat = " 40 - 54 ";
            } else {
                $cat = " 55 > ";
            }
            $data[] = [
                "category" => $cat,
                "jumlah" => count($count["records"]),
            ];
        }
        return json_encode($data);
    }

    function genderPegawai(){

        $items = DB::connection('kepegawaian')->select('SELECT count(id) as jumlah, gender FROM pegawai WHERE deleted_at IS NULL GROUP BY gender');
        $data = [];
        foreach($items as $row){
         if ($row->gender == 'L'){
             $cat = "Laki-laki";
         } else if($row->gender == 'P'){
            $cat = "Perempuan";
         } else {
            $cat = "Unidentified";
         }
            $data[] = [
                "category" => $cat,
                "jumlah" => $row->jumlah,
            ];
        }
        return json_encode($data);
    }

    function jenisPegawai(){

        $jenis = self::totalJenisPegawai();
        $data = [];
        foreach($jenis as $row){
         
            $data[] = [
                "category" => $row->nama,
                "jumlah" => $row->jumlah,
            ];
        }

        return json_encode($data);
    }

    function statusPegawai(){

        $status = self::totalStatusPegawai();
        $data = [];
        foreach($status as $row){
         
            $data[] = [
                "category" => $row->status,
                "jumlah" => $row->jumlah,
            ];
        }

        return json_encode($data);
    }

    public function getDateRange(){
        $data = [];
        $temp = $this->time->format('m');
        $tmp_year = $this->time->format('Y');
    
        for ($i=0; $i < 6; $i++) { 
          if($temp == 0)
            $temp = 12;
          if($temp == 12)
            $tmp_year--;
    
          $data[$i]['month'] = $temp;
          $data[$i]['year'] = $tmp_year;
          $temp--;
        }
    
      return $data;
    }
    
}