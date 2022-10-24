<?php

namespace App\Http\Controllers\Pasien\Laporan;

use App\Models\Hospital\MasterStatusPulang;
use App\Models\RawatJalan\Poliklinik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\ICD10;
use App\Models\Kasus\DTD;
use App\Models\Pasien\ListLaporan;
use App\Models\Kasus\PenunjangPermintaan;
use App\Models\Pasien\AlamatKecamatan;
use App\Models\Pasien\AlamatKota;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\AsalRujukan;
use App\Models\RawatJalan\PermintaanRujuk;
use App\Models\Hospital\TransaksiMasukDetail as TransaksiDetail;
use App\Models\Hospital\TransaksiMasuk as Transaksi;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use Carbon\Carbon;
use DB;
use stdClass;

class ReadController extends Controller
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
		$poli = Poliklinik::whereDoesntHave('unit_tindakan',function ($query) {
            $query->from(config('app.db_name').'_unit_tindakan.unit_tindakan');
        })->get()->pluck('id')->toArray();

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
		$results = DB::connection('rawatjalan')->select( DB::raw($query));
		$poli_count = 0;
		$time_end = microtime(true);

		$execution_time = $time_end - $time_start;
		$transaksi_merged = [];
		foreach($results as $item)
		{
			$transaksi_merged[$item->poliklinik_id][$item->count_num] = $item->total;
		}
		return $transaksi_merged;
	}

	private function singleQuery($count,$poli_id,$perusahaan_ids,$date_start,$date_end,$is_baru,$jenis_kelamin,$union)
	{
		$query = "
		SELECT poli.id as poliklinik_id, 'count-".$count."' as count_num,transaksi.total
		FROM 
		`".config('app.db_name')."_rawat_jalan`.`poliklinik` poli
		LEFT JOIN
		(

		SELECT
		poliklinik_id,
		COUNT(1) AS total
		FROM 
		laporan_transaksi
		WHERE 
		is_pasien_baru IN (".implode(",", $is_baru).")
		AND perusahaan_pembayaran_id IN (".implode(",", $perusahaan_ids).")
		AND waktu_pemeriksaan >= '".$date_start."'
		AND waktu_pemeriksaan <= '".$date_end."'
		AND jenis_kelamin IN (".implode(",", $jenis_kelamin).")
		GROUP BY poliklinik_id
		) transaksi
		ON
		poli.id = transaksi.`poliklinik_id`
		WHERE poli.deleted_at IS NULL
		".$union;
		return $query;
	}

	public function getmorbidrawatjalan($range1,$range2)
	{
       //$range1 = Carbon::createFromFormat('d m Y', $range1)->toDateTimeString();
              // dd($range1,$range2);
		$range1= Carbon::parse($range1)->format('Y-m-d');
		$range2= Carbon::parse($range2)->format('Y-m-d');
        //dd($range1,$range2);
		$countmorbiditas = array();
        //dd($range1,$range2);
        //$diagnosis1 = Diagnosis::whereBetween('created_at',[$range1,$range2])->get();
		$dtd = DTD::whereHas('icd10', function($icd) use($range1,$range2)
		{
			$icd->from(config('app.db_name').'_kasus.icd_10')->whereHas('diagnosis', function($dia) use($range1,$range2)
			{
				$dia->from(config('app.db_name').'_kasus.diagnosis')->whereHas('kasus', function($kas) use($range1,$range2)
				{
					$kas->from(config('app.db_name').'_kasus.kasus')->whereHas('TransaksiRawatJalan', function($trans) use($range1,$range2)
					{
						$trans->from(config('app.db_name').'_rawat_jalan.transaksi')->whereBetween('created_at',[$range1,$range2]);

					});

				});
			});
		})->get();
        //dd($dtd);
        //Diagnosis::whereBetween('created_at',[$range1,$range2])->get();
        //dd($diagnosis1);
       //dd($diagnosis1->icd10->long_desc->dtd);
		foreach($dtd as $data)
		{
			$count = array();
			for($i=0;$i<=29;$i++) array_push($count, 0);
          //$count[0]+=1;
          //dd($count);
          //$data->count[1] = $data->count[1]+$item;
                  //dd($data->count[1]);
				foreach ($data->icd10 as $icd) {
            //if($data->id == 5 && $i==10) dd($icd->diagnosis()->whereBetween('created_at',[$range1,$range2])->get());

					foreach($icd->diagnosis as $dia) {
						if($dia->kasus == NULL ) continue;
						$z = 0;

						foreach ($dia->kasus->TransaksiRawatJalan()->whereBetween('created_at',[$range1,$range2])->get() as $raw) {
							if($dia->kasus->TransaksiRawatJalan[$z]->is_pasien_baru ==1)
							{
								$count[25] += 1;
                              if($dia->kasus->pasien->age == 0) //1998-09-19
                              {
                              	$now = Carbon::now();
                              	$date = Carbon::parse($dia->kasus->pasien->date_of_birth);
                              	$day = $now->diffInDays($date);
                              	if($day >= 0 && $day <= 6)
                              	{
                              		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') 
                              		{
                              			$count[5] += 1;
                              			$count[23] += 1;
                              		}
                              		else
                              		{
                              			$count[6] += 1;  
                              			$count[24] += 1;

                              		} 
                              	}
                              	else if($day >= 7 && $day <= 28)
                              	{
                              		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') 
                              		{
                              			$count[7] += 1;
                              			$count[23] += 1;
                              		}
                              		else
                              		{
                              			$count[8] += 1;  
                              			$count[24] += 1;

                              		}  
                              	}
                              	else if($day >= 28)
                              	{
                              		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') 
                              		{
                              			$count[9] += 1;
                              			$count[23] += 1;
                              		}
                              		else
                              		{
                              			$count[10] += 1;  
                              			$count[24] += 1;

                              		} 
                              	}
                              }
                              else if($dia->kasus->pasien->age >= 1 && $dia->kasus->pasien->age <= 4)
                              {
                              	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') 
                              	{
                              		$count[11] += 1;
                              		$count[23] += 1;
                              	}
                              	else
                              	{
                              		$count[12] += 1;  
                              		$count[24] += 1;

                              	} 
                              }
                              else if($dia->kasus->pasien->age >= 5 && $dia->kasus->pasien->age <= 14)
                              {
                              	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') 
                              	{
                              		$count[13] += 1;
                              		$count[23] += 1;
                              	}
                              	else
                              	{
                              		$count[14] += 1;  
                              		$count[24] += 1;

                              	} 
                              }
                              else if($dia->kasus->pasien->age >= 15 && $dia->kasus->pasien->age <= 24)
                              {
                              	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') 
                              	{
                              		$count[15] += 1;
                              		$count[23] += 1;
                              	}
                              	else
                              	{
                              		$count[16] += 1;  
                              		$count[24] += 1;

                              	}                       }
                              	else if($dia->kasus->pasien->age >= 25 && $dia->kasus->pasien->age <= 44)
                              	{
                              		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') 
                              		{
                              			$count[17] += 1;
                              			$count[23] += 1;
                              		}
                              		else
                              		{
                              			$count[18] += 1;  
                              			$count[24] += 1;

                              		} 
                              	}
                              	else if($dia->kasus->pasien->age >= 45 && $dia->kasus->pasien->age <= 64)
                              	{
                              		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') 
                              		{
                              			$count[19] += 1;
                              			$count[23] += 1;
                              		}
                              		else
                              		{
                              			$count[20] += 1;  
                              			$count[24] += 1;

                              		} 
                              	}
                              	else if($dia->kasus->pasien->age >= 65)
                              	{
                              		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') 
                              		{
                              			$count[21] += 1;
                              			$count[23] += 1;
                              		}
                              		else
                              		{
                              			$count[22] += 1;  
                              			$count[24] += 1;

                              		} 

                              	}   
                              }
                              else
                              {

                              if($dia->kasus->pasien->age == 0) //1998-09-19
                              {
                              	$now = Carbon::now();
                              	$date = Carbon::parse($dia->kasus->pasien->date_of_birth);
                              	$day = $now->diffInDays($date);
                              	if($day >= 0 && $day <= 6)
                              	{
                              		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[5] += 1;
                              		else $count[6] += 1;   
                              	}
                              	else if($day >= 7 && $day <= 28)
                              	{
                              		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[7] += 1;
                              		else $count[8] += 1;   
                              	}
                              	else if($day >= 28)
                              	{
                              		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[9] += 1;
                              		else $count[10] += 1;   
                              	}
                              }
                              else if($dia->kasus->pasien->age >= 1 && $dia->kasus->pasien->age <= 4)
                              {
                              	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[11] += 1;
                              	else $count[12] += 1;
                              }
                              else if($dia->kasus->pasien->age >= 5 && $dia->kasus->pasien->age <= 14)
                              {
                              	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[13] += 1;
                              	else $count[14] += 1;
                              }
                              else if($dia->kasus->pasien->age >= 15 && $dia->kasus->pasien->age <= 24)
                              {
                              	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[15] += 1;
                              	else $count[16] += 1;
                              }
                              else if($dia->kasus->pasien->age >= 25 && $dia->kasus->pasien->age <= 44)
                              {
                              	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[17] += 1;
                              	else $count[18] += 1;
                              }
                              else if($dia->kasus->pasien->age >= 45 && $dia->kasus->pasien->age <= 64)
                              {
                              	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[19] += 1;
                              	else $count[20] += 1;
                              }
                              else if($dia->kasus->pasien->age >= 65)
                              {
                              	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[21] += 1;
                              	else $count[22] += 1;
                              }   

                          }
                          $z++;


                          $count[26]+=1;
                      }
                  }

            }  //dd($dia->kasus->TransaksiRawatInap);



        //dd($data1->icd10->dtd);
        /*$diagnosis = DTD::where('id',$data1->icd10->dtd)->get();
        dd($diagnosis);
        $array[$data1->icd10->dtd] = $diagnosis;*/
        $data->itung = $count[26];
        $data->count = $count;

    }
      //dd($dtd);
      //dd($array);
     //dd($dtd->sortByDesc('itung'));

    return $dtd;
}

public function getmorbidrawatinap($range1,$range2)
{
       //$range1 = Carbon::createFromFormat('d m Y', $range1)->toDateTimeString();
              // dd($range1,$range2);
	$range1= Carbon::parse($range1)->format('Y-m-d');
	$range2= Carbon::parse($range2)->format('Y-m-d');
    $meninggal = MasterStatusPulang::where('slug','meninggal')->first()->id;
        //dd($range1,$range2);
	$countmorbiditas = array();
        //dd($range1,$range2);
        //$diagnosis1 = Diagnosis::whereBetween('created_at',[$range1,$range2])->get();
	$dtd = DTD::whereHas('icd10', function($icd) use($range1,$range2)
	{
		$icd->whereHas('diagnosis', function($dia) use($range1,$range2)
		{
			$dia->whereHas('kasus', function($kas) use($range1,$range2)
			{
				$kas->from(config('app.db_name').'_kasus.kasus')->whereNotNull('krs_status')->whereHas('TransaksiRawatInap', function($trans) use($range1,$range2)
				{
					$trans->from(config('app.db_name').'_rawat_inap.transaksi')->whereBetween('created_at',[$range1,$range2])->whereNotNull('waktu_keluar');

				});

			});
		});
	})->get();
       //dd($dtd);
        //Diagnosis::whereBetween('created_at',[$range1,$range2])->get();
        //dd($diagnosis1);
       //dd($diagnosis1->icd10->long_desc->dtd);
	foreach($dtd as $data)
	{
		$count = array();
		for($i=0;$i<=29;$i++) array_push($count, 0);
          //$count[0]+=1;
          //dd($count);
          //$data->count[1] = $data->count[1]+$item;
                  //dd($data->count[1]);
			foreach ($data->icd10 as $icd) {
            //if($data->id == 5 && $i==10) dd($icd->diagnosis()->whereBetween('created_at',[$range1,$range2])->get());
				foreach($icd->diagnosis()->whereBetween('created_at',[$range1,$range2])->get() as $dia) {

              //dd($dia->kasus->TransaksiRawatInap);
             // if(!$dia->kasus->TransaksiRawatJalan->isEmpty()) continue;

					if($dia->kasus == NULL || $dia->kasus->krs_status == NULL) continue;
					foreach ($dia->kasus->TransaksiRawatInap()->whereBetween('created_at',[$range1,$range2])->get() as $raw) {

						if($dia->kasus->krs_status == $meninggal)
						{
                      if($dia->kasus->pasien->age == 0) //1998-09-19
                      {
                      	$now = Carbon::now();
                      	$date = Carbon::parse($dia->kasus->pasien->date_of_birth);
                      	$day = $now->diffInDays($date);
                      	if($day >= 0 && $day <= 6)
                      	{
                      		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[5] += 1;
                      		else $count[6] += 1;   
                      	}
                      	else if($day >= 7 && $day <= 28)
                      	{
                      		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[7] += 1;
                      		else $count[8] += 1;   
                      	}
                      	else if($day >= 28)
                      	{
                      		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[9] += 1;
                      		else $count[10] += 1;   
                      	}
                      }
                      else if($dia->kasus->pasien->age >= 1 && $dia->kasus->pasien->age <= 4)
                      {
                      	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[11] += 1;
                      	else $count[12] += 1;
                      }
                      else if($dia->kasus->pasien->age >= 5 && $dia->kasus->pasien->age <= 14)
                      {
                      	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[13] += 1;
                      	else $count[14] += 1;
                      }
                      else if($dia->kasus->pasien->age >= 15 && $dia->kasus->pasien->age <= 24)
                      {
                      	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[15] += 1;
                      	else $count[16] += 1;
                      }
                      else if($dia->kasus->pasien->age >= 25 && $dia->kasus->pasien->age <= 44)
                      {
                      	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[17] += 1;
                      	else $count[18] += 1;
                      }
                      else if($dia->kasus->pasien->age >= 45 && $dia->kasus->pasien->age <= 64)
                      {
                      	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[19] += 1;
                      	else $count[20] += 1;
                      }
                      else if($dia->kasus->pasien->age >= 65)
                      {
                      	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[21] += 1;
                      	else $count[22] += 1;
                      }
                      $count[26]+=1;
                  }
                  else
                  {
                      if($dia->kasus->pasien->age == 0) //1998-09-19
                      {
                      	$now = Carbon::now();
                      	$date = Carbon::parse($dia->kasus->pasien->date_of_birth);
                      	$day = $now->diffInDays($date);
                      	if($day >= 0 && $day <= 6)
                      	{
                      		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[5] += 1;
                      		else $count[6] += 1;   
                      	}
                      	else if($day >= 7 && $day <= 28)
                      	{
                      		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[7] += 1;
                      		else $count[8] += 1;   
                      	}
                      	else if($day >= 28)
                      	{
                      		if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[9] += 1;
                      		else $count[10] += 1;   
                      	}
                      }
                      else if($dia->kasus->pasien->age >= 1 && $dia->kasus->pasien->age <= 4)
                      {
                      	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[11] += 1;
                      	else $count[12] += 1;
                      }
                      else if($dia->kasus->pasien->age >= 5 && $dia->kasus->pasien->age <= 14)
                      {
                      	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[13] += 1;
                      	else $count[14] += 1;
                      }
                      else if($dia->kasus->pasien->age >= 15 && $dia->kasus->pasien->age <= 24)
                      {
                      	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[15] += 1;
                      	else $count[16] += 1;
                      }
                      else if($dia->kasus->pasien->age >= 25 && $dia->kasus->pasien->age <= 44)
                      {
                      	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[17] += 1;
                      	else $count[18] += 1;
                      }
                      else if($dia->kasus->pasien->age >= 45 && $dia->kasus->pasien->age <= 64)
                      {
                      	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[19] += 1;
                      	else $count[20] += 1;
                      }
                      else if($dia->kasus->pasien->age >= 65)
                      {
                      	if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[21] += 1;
                      	else $count[22] += 1;
                      }
                      $count[25]+=1;

                  }
                  $count[24] = $count[22] + $count[20] + $count[18] + $count[16] + $count[14] + $count[12] + $count[10] + $count[8] + $count[6];
                  $count[23] = $count[21] + $count[19] + $count[17] + $count[15] + $count[13] + $count[11] + $count[9] + $count[7] + $count[5];
              }
          }
      }

        //dd($data1->icd10->dtd);
        /*$diagnosis = DTD::where('id',$data1->icd10->dtd)->get();
        dd($diagnosis);
        $array[$data1->icd10->dtd] = $diagnosis;*/

        $data->count = $count;
    }
      //dd($dtd);
      //dd($array);


    return $dtd;
}

public function getsepuluhbesarrawatjalan($range1,$range2)
{
      //$range1 = Carbon::createFromFormat('d m Y', $range1)->toDateTimeString();
              // dd($range1,$range2);
	$range1= Carbon::parse($range1)->format('Y-m-d');
	$range2= Carbon::parse($range2)->format('Y-m-d');
        //dd($range1,$range2);
	$countmorbiditas = array();
        //dd($range1,$range2);
        //$diagnosis1 = Diagnosis::whereBetween('created_at',[$range1,$range2])->get();
	$dtd = DTD::whereHas('icd10', function($icd) use($range1,$range2)
	{
		$icd->from(config('app.db_name').'_kasus.icd_10')->whereHas('diagnosis', function($dia) use($range1,$range2)
		{
			$dia->from(config('app.db_name').'_kasus.diagnosis')->whereHas('kasus', function($kas) use($range1,$range2)
			{
				$kas->from(config('app.db_name').'_kasus.kasus')->whereHas('TransaksiRawatJalan', function($trans) use($range1,$range2)
				{
					$trans->from(config('app.db_name').'_rawat_jalan.transaksi')->whereBetween('created_at',[$range1,$range2]);

				});

			});
		});
	})->get();
        //dd($dtd);
        //Diagnosis::whereBetween('created_at',[$range1,$range2])->get();
        //dd($diagnosis1);
       //dd($diagnosis1->icd10->long_desc->dtd);
	foreach($dtd as $data)
	{
		$count = array();
		for($i=0;$i<=29;$i++) array_push($count, 0);
          //$count[0]+=1;
          //dd($count);
          //$data->count[1] = $data->count[1]+$item;
                  //dd($data->count[1]);
			foreach ($data->icd10 as $icd) {
            //if($data->id == 5 && $i==10) dd($icd->diagnosis()->whereBetween('created_at',[$range1,$range2])->get());

				foreach($icd->diagnosis as $dia) {
					if($dia->kasus == NULL ) continue;
					$z = 0;
					foreach ($dia->kasus->TransaksiRawatJalan()->whereBetween('created_at',[$range1,$range2])->get() as $raw) {
                  // dd($dia->kasus->TransaksiRawatJalan[0]->waktu_pemeriksaan);
						if($dia->kasus->TransaksiRawatJalan[$z]->is_pasien_baru ==1)
						{

							$count[7] +=1;
							if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[5] += 1;
							else $count[6] += 1;   
						}
						else
						{

                       // $count[8]+=1
						}
						$z++;


						$count[8]+=1;
					}
				}

            }  //dd($dia->kasus->TransaksiRawatInap);



        //dd($data1->icd10->dtd);
        /*$diagnosis = DTD::where('id',$data1->icd10->dtd)->get();
        dd($diagnosis);
        $array[$data1->icd10->dtd] = $diagnosis;*/
        $data->itung = $count[8];
        $data->count = $count;

    }
      //dd($dtd);
        //dd($array);
//dd($dtd->sortByDesc('itung'));

    return $dtd;
}
public function getsepuluhbesarrawatinap($range1,$range2)
{
          // dd($range1,$range2);
	$range1= Carbon::parse($range1)->format('Y-m-d');
	$range2= Carbon::parse($range2)->format('Y-m-d');
    $meninggal = MasterStatusPulang::where('slug','meninggal')->first()->id;
        //dd($range1,$range2);
	$countmorbiditas = array();
        //dd($range1,$range2);
        //$diagnosis1 = Diagnosis::whereBetween('created_at',[$range1,$range2])->get();
	$dtd = DTD::whereHas('icd10', function($icd) use($range1,$range2)
	{
		$icd->whereHas('diagnosis', function($dia) use($range1,$range2)
		{
			$dia->whereHas('kasus', function($kas) use($range1,$range2)
			{
				$kas->from(config('app.db_name').'_kasus.kasus')->whereNotNull('krs_status')->whereHas('TransaksiRawatInap', function($trans) use($range1,$range2)
				{
					$trans->from(config('app.db_name').'_rawat_inap.transaksi')->whereBetween('created_at',[$range1,$range2])->whereNotNull('waktu_keluar');

				});

			});
		});
	})->get();
       //dd($dtd);
        //Diagnosis::whereBetween('created_at',[$range1,$range2])->get();
        //dd($diagnosis1);
       //dd($diagnosis1->icd10->long_desc->dtd);
	foreach($dtd as $data)
	{
		$count = array();
		for($i=0;$i<=29;$i++) array_push($count, 0);
          //$count[0]+=1;
          //dd($count);
          //$data->count[1] = $data->count[1]+$item;
                  //dd($data->count[1]);
			foreach ($data->icd10 as $icd) {
            //if($data->id == 5 && $i==10) dd($icd->diagnosis()->whereBetween('created_at',[$range1,$range2])->get());
				foreach($icd->diagnosis()->whereBetween('created_at',[$range1,$range2])->get() as $dia) {

              //dd($dia->kasus->TransaksiRawatInap);
             // if(!$dia->kasus->TransaksiRawatJalan->isEmpty()) continue;

					if($dia->kasus == NULL || $dia->kasus->krs_status == NULL) continue;
					foreach ($dia->kasus->TransaksiRawatInap()->whereBetween('created_at',[$range1,$range2])->get() as $raw) {

						if($dia->kasus->krs_status == $meninggal)
						{

							$count[8]+=1;
							if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[5] += 1;
							else $count[6] += 1;   
						}
						else
						{
							$count[7]+=1;
							if($dia->kasus->pasien->jenis_kelamin == 'Laki laki') $count[5] += 1;
							else $count[6] += 1;   

						}

					}
				}
			}

        //dd($data1->icd10->dtd);
        /*$diagnosis = DTD::where('id',$data1->icd10->dtd)->get();
        dd($diagnosis);
        $array[$data1->icd10->dtd] = $diagnosis;*/

        $data->count = $count;
    }
      //dd($dtd);
      //dd($array);


    return $dtd;
}
}