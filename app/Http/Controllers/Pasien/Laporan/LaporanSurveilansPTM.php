<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Transaksi;
use App\Models\RawatInap\LaporanTransaksi;
use App\Models\Kasus\Kasus;
use DB;

class LaporanSurveilansPTM extends Controller
{
	public function get($date_start,$date_end,$type)
	{
		$penyakit_array = $this->getPenyakitArray();
		$index_array_total = count($penyakit_array);
		$getAgeArray = $this->getAgeArray();

		$date_start->toDateTimeString();
		$date_end->toDateTimeString();
		$query = '';
		$gender = [1,2];
		$is_pasien_baru = [1,0];
		$min_usia_array = $getAgeArray['min'];
		$max_usia_array = $getAgeArray['max'];
		$merge_transaksi = [];
		/*INIT FOR TOTAL ARRAY*/
		for($i=0;$i<55;$i++)
		{
			$merge_transaksi[$index_array_total][$i] = 0;
		}

		foreach($penyakit_array as $key => $penyakit){
			foreach ($min_usia_array as $key_usia => $min_usia_item) {
				$min_usia = $min_usia_array[$key_usia];
				$max_usia = $max_usia_array[$key_usia];

				foreach($gender as $gender_item){
					foreach($is_pasien_baru as $baru_item){
						$code = $min_usia.'-'.$max_usia.'-'.$gender_item.'-'.$baru_item;
						if ($type == 1) {
							$query.= "

							SELECT '".$key."' AS penyakit, '".$code."' AS code, COUNT(1) AS total
							FROM 
								`laporan_transaksi` lt,
								`laporan_transaksi_diagnosis` ltd
							WHERE 
								lt.`kasus_id` = ltd.`kasus_id`
								AND jenis_kelamin = ".$gender_item."
								AND usia_masuk_hr <= ".$max_usia."
								AND usia_masuk_hr >= ".$min_usia."
								AND krs_at >= '".$date_start."'
								AND krs_at <= '".$date_end."'
								AND is_pasien_baru = ".$baru_item."
								AND ltd.`icd10_id` IN (".implode(",", $penyakit).")
							UNION";
						} else {
							$query.= "

							SELECT '".$key."' AS penyakit, '".$code."' AS code, COUNT(1) AS total
							FROM 
								`laporan_transaksi` lt,
								`laporan_transaksi_diagnosis` ltd
							WHERE 
								lt.`kasus_id` = ltd.`kasus_id`
								AND jenis_kelamin = ".$gender_item."
								AND usia_masuk_hr <= ".$max_usia."
								AND usia_masuk_hr >= ".$min_usia."
								AND waktu_pemeriksaan >= '".$date_start."'
								AND waktu_pemeriksaan <= '".$date_end."'
								AND is_pasien_baru = ".$baru_item."
								AND ltd.`icd10_id` IN (".implode(",", $penyakit).")
							UNION";
						}
					}
				}
			}
			if($key == 20)
			{
				$query = substr($query, 0, -5);
				$data = ($type == 1) ? DB::connection('rawatinap')->select($query) : DB::connection('rawatjalan')->select($query);
				$merge_transaksi = $this->processData($data,$merge_transaksi,$index_array_total);
				$query = '';
			}
		}

		$query = substr($query, 0, -5);
		$data = ($type == 1) ? DB::connection('rawatinap')->select($query) : DB::connection('rawatjalan')->select($query);
		$merge_transaksi = $this->processData($data,$merge_transaksi,$index_array_total);
		return $merge_transaksi;

	}

	private function processData($data,$merge_transaksi,$index_array_total)
	{
		$count = 0;
		$sequence = 0;
		$total_lk_baru = 0;
		$total_pr_baru = 0;
		$total_lk_lama = 0;
		$total_pr_lama = 0;
		$last_item_penyakit = 0;
		foreach($data as $item)
		{
			if($last_item_penyakit != $item->penyakit) {
				$last_item_penyakit = $item->penyakit;
				$count = 0;
				$total_lk_baru = 0;
				$total_pr_baru = 0;
				$total_lk_lama = 0;
				$total_pr_lama = 0;
			}
		  	if($sequence == 4){
		  		$sequence = 0;
		  	}

		  	$merge_transaksi[$item->penyakit][$count] = $item->total;
		  	$merge_transaksi[$index_array_total][$count] += $item->total;

		  	if($sequence == 0) $total_lk_baru+= $item->total;
		  	else if($sequence == 1) $total_lk_lama+= $item->total;
		  	else if($sequence == 2) $total_pr_baru+= $item->total;
		  	else if($sequence == 3) $total_pr_lama+= $item->total;

		  	if($count == 47)
		  	{
		  		$merge_transaksi[$item->penyakit][48] = $total_lk_baru;
		  		$merge_transaksi[$item->penyakit][49] = $total_lk_lama;
		  		$merge_transaksi[$item->penyakit][50] = $total_pr_baru;
		  		$merge_transaksi[$item->penyakit][51] = $total_pr_lama;
		  		$merge_transaksi[$item->penyakit][52] = $total_lk_baru + $total_lk_lama;
		  		$merge_transaksi[$item->penyakit][53] = $total_pr_baru + $total_pr_lama;
		  		$merge_transaksi[$item->penyakit][54] = $total_lk_baru + $total_lk_lama + $total_pr_baru + $total_pr_lama;
				
				$merge_transaksi[$index_array_total][48] += $total_lk_baru;
		  		$merge_transaksi[$index_array_total][49] += $total_lk_lama;
		  		$merge_transaksi[$index_array_total][50] += $total_pr_baru;
		  		$merge_transaksi[$index_array_total][51] += $total_pr_lama;
		  		$merge_transaksi[$index_array_total][52] += $total_lk_baru + $total_lk_lama;
		  		$merge_transaksi[$index_array_total][53] += $total_pr_baru + $total_pr_lama;
		  		$merge_transaksi[$index_array_total][54] += $total_lk_baru + $total_lk_lama + $total_pr_baru + $total_pr_lama;
		  	}
		  	$count++;
		  	$sequence++;
		}

		return $merge_transaksi;
	}

	private function getData($transaksi_ids,$penyakit,$usia,$gender,$is_baru)
	{
		$kasus_ids = Transaksi::whereIn('id',$transaksi_ids)->whereBetween('usia_masuk',[$usia->min,$usia->max])->pluck('kasus_id')->toArray();
		
		$kasus = Kasus::whereIn('id',$kasus_ids);
		if($is_baru == 1) $kasus = $kasus->where('is_baru',1);
		elseif($is_baru == 0) $kasus = $kasus->whereNull('is_baru');

		$kasus = $kasus->whereHas('diagnosis' ,function($q) use ($penyakit){
			$q->whereIn('icd_10',$penyakit);
		})->whereHas('identitas',function($q2) use ($gender){
			$q2->whereIn('jenis_kelamin',$gender);
		})->count();

		return $kasus;
	}


	private function getPenyakitArray()
	{
		$array = [];
		$array[] = [3528];
		$array[] = [3564];
		$array[] = [3684];
		$array[] = [4006,4007,4008,4009];
		$array[] = [3731];
		$array[] = [2002,2003,2004,2005,2006,2007,2008,2009,2010,2011,2012];
		$array[] = [2013,2014,2015,2016,2017,2018,2019,2020,2021,2022,2023];
		$array[] = [5950,5951,5952,5953,5954,5955];
		$array[] = [111111111111111111]; //DM-TB
		$array[] = [2223,2224,2225,2226,2227,2228];
		$array[] = [1954,1955,1956,1957,1958];
		$array[] = [1965,1966,1967,1968,1969,1970,1971,1972,1973];
		$array[] = [1980,1981,1982,1983,1984,1985,1986,1987,1988];
		$array[] = [5599];
		$array[] = [4010,4013];
		$array[] = [5043];
		$array[] = [1793];
		$array[] = [5275,5276,5277,5278,5279,5280,5281,5282,5283];
		$array[] = [5401,5402,5403,5404,5405,5406,5407,5408,5409,5410,5411,5412,5413,5414,5415,5416,5417,5418,5419,5420,5421,5422,5423,5424,5425,5426,5427,5428,5429,5430,5431,5432,5433,5434,5435,5436,5437,5438,5439,5440,5441,5442,5443,5444,5445,5446,5447,5448,5449,5450,5451,5452,5453,5454,5455,5456,5457,5458,5459,5460,5461,5462,5463,5464,5465,5466,5467,5468,5469,5470,5471,5472,5473,5474,5475,5476,5477,5478,5479,5480,5481,5482,5483,5484,5485,5486,5487,5488,5489,5490,5491,5492,5493,5494,5495,5496,5497,5498,5499,5500,5501,5502,5503,5504,5505,5506,5507,5508,5509,5510,5511,5512,5513,5514,5515,5516,5517,5518,5519,5520,5521,5522,5523,5524,5525,5526,5527,5528];
		$array[] = [4885];
		$array[] = [1385,1386,1387,1388,1389,1390,1391,1392,1393,1394,1395,1396,1397,1398,1399,1400,1401,1402,1403,1404,1405,1406,1407,1408,1409,1410,1411,1412,1413,1414,1415,1416,1417,1418,1419,1420,1421,1422];
		$array[] = [1190];
		$array[] = [1173,1174,1175,1176,1177,1178,1179,1180,1181,1182]; //tumor payudara
		$array[] = [1173,1174,1175,1176,1177,1178,1179,1180,1181,1182]; //kanker payudara
		$array[] = [1511];
		$array[] = [9150,9151,9152,9153,9154,9155,9156,9157,9158,9159,9160,9161,9162,9163,9164,9165,9166,9167,9168];
		$array[] = [9122,9123,9124,9125,9126,9127,9128,9129];
		$array[] = [9189,9190,9191,9192,9193,9194,9195,9196,9197,9198];
		$array[] = [9169,9170,9171,9172,9173,9174,9175,9176,9177,9178];
		$array[] = [8773,8774,8775,8776,8777,8778,8779,8780,8781,8782,8783,8784,8785,8786,8787,8788,8789,8790,8791,8792,8793,8794,8795,8796,8797,8798,8799,8800,8801,8802,8803,8804,8805,8806,8807,8808,8809,8810,8811,8812,8813,8814,8815,8816,8817,8818,8819,8820,8821,8822,8823,8824,8825,8826,8827,8828,8829,8830,8831,8832,8833,8834,8835,8836,8837,8838,8839,8840,8841,8842,8843,8844,8845,8846,8847,8848,8849,8850,8851,8852,8853,8854,8855,8856,8857,8858,8859,8860,8861,8862,8863,8864,8865,8866,8867,8868,8869,8870,8871,8872,8873,8874,8875,8876,8877,8878,8879,8880,8881,8882,8883,8884,8885,8886,8887,8888,8889,8890,8891,8892,8893,8894,8895,8896,8897,8898,8899,8900,8901,8902,8903,8904,8905,8906,8907,8908,8909,8910,8911,8912,8913,8914,8915,8916,8917,8918,8919,8920,8921,8922,8923,8924,8925,8926,8927,8928,8929,8930,8931,8932,8933,8934,8935,8936,8937,8938,8939,8940,8941,8942,8943,8944,8945,8946,8947,8948,8949,8950,8951,8952,8953,8954,8955,8956,8957,8958,8959,8960,8961,8962,8963,8964,8965,8966,8967,8968,8969,8970,8971,8972,8973,8974,8975,8976,8977,8978,8979,8980,8981,8982,8983,8984,8985,8986,8987,8988,8989,8990,8991,8992,8993,8994,8995,8996,8997,8998,8999,9000,9001,9002,9003,9004,9005,9006,9007,9008,9009,9010,9011,9012,9013,9014,9015,9016,9017,9018,9019,9020,9021,9022,9023,9024,9025,9026,9027,9028,9029,9030,9031,9032,9033,9034,9035,9036,9037,9038,9039,9040,9041,9042,9043,9044,9045,9046,9047,9048,9049,9050,9051,9052,9053,9054,9055,9056,9057,9058,9059,9060,9061,9062];
		$array[] = [9207,9208,9209,9210,9211,9212,9213,9214,9215,9216,9217,9218,9219,9220,9221,9222,9223,9224,9225,9226,9227,9228,9229,9230,9231,9232,9233,9234,9235,9236,9237,9238,9239,9240,9241,9242,9243,9244,9245,9246,9247,9248,9249,9250,9251,9252,9253,9254,9255,9256,9257,9258,9259,9260,9261,9262,9263,9264,9265,9266,9267];
		$array[] = [9063,9064,9065,9066,9067,9068,9069,9070,9071,9072,9073,9074,9075,9076,9077,9078,9079,9080,9081,9082,9083,9084,9085,9086,9087,9088,9089,9090,9091,9092,9093,9094,9095,9096,9097,9098,9099,9100,9101,9102,9103,9104,9105,9106,9107,9108,9109,9110,9111,9112,9113,9114,9115,9116,9117,9118,9119,9120,9121,9122,9123,9124,9125,9126,9127,9128,9129,9130,9131,9132,9133,9134,9135,9136,9137,9138,9139,9140,9141,9142,9143,9144,9145,9146,9147,9148,9149,9150,9151,9152,9153,9154,9155,9156,9157,9158,9159,9160,9161,9162,9163,9164,9165,9166,9167,9168,9169,9170,9171,9172,9173,9174,9175,9176,9177,9178,9179,9180,9181,9182,9183,9184,9185,9186,9187,9188,9189,9190,9191,9192,9193,9194,9195,9196,9197,9198,9199,9200,9201,9202,9203,9204,9205,9206];
		$array[] = [4629];
		$array[] = [1251,1252,1253,1254,1255,1256,1257,1258,1259,1260];
		$array[] = [3282,3283,3284,3285,3286,3287,3288,3289,3290,3291,3292];
		$array[] = [3407,3408,3409,3410,3411,3412];
		$array[] = [3345,3346,3347,3348,3349,3350,3351,3352];
		$array[] = [3391];
		$array[] = [3225,3226,3228,3229];
		$array[] = [3227];
		$array[] = [3474];
		$array[] = [3482,3483,3484,3485,3486,3487];
		$array[] = [4175,4176,4177,4178,4179,4180,4181,4182,4183,4184,4185,4186,4187,4188,4189,4190,4191,4192,4193,4194,4195,4196,4197,4198,4199,4200,4201,4202,4203,4204,4205,4206,4207,4208,4209,4210,4211,4212,4213,4214,4215];
		$array[] = [4121,4122,4123,4124,4125,4126,4127];
		$array[] = [4138,4139,4140,4141,4142,4143,4144,4145,4146,4147];
		$array[] = [4148,4149,4150,4151,4152,4153,4154,4155,4156,4157,4158,4159];

		/*
		NGE COMBINE SEMUA ARRAY JADI SATU ARRAY UNTUK ROW TOTAL
		$temp = [];
		foreach($array as $item)
		{
			$temp = array_merge($temp, $item);
		}
		$array[] = $temp;*/
		return $array;


	}

	private function getAgeArray()
	{	
		$array = [];
		$temp = $this->getObjectAge('0 - 7 Hari',0,7);
		$array[] = $temp;
		$temp = $this->getObjectAge('8 - 28 Hari',8,28);
		$array[] = $temp;
		$temp = $this->getObjectAge('29 - < 1 Tahun',29,364);
		$array[] = $temp;
		$temp = $this->getObjectAge('1 - 4 Tahun',365*1,(365*5-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('5 - 9 Tahun',365*5,(365*10-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('10 - 14 Tahun',365*10,(365*15-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('15 - 19 Tahun',365*15,(365*20-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('20 - 44 Tahun',365*20,(365*45-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('45 - 54 Tahun',365*45,(365*55-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('55 - 59 Tahun',365*55,(365*60-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('60 - 69 Tahun',365*60,(365*70-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('70+ Tahun',365*70,(365*1000-1));
		$array[] = $temp;
		// $temp = $this->getObjectAge('Total',0,(365*1000-1));
		// $array[] = $temp;

		$min_usia_array = [];
		$max_usia_array = [];
		foreach ($array as $index => $item) {
			$min_usia_array[] = $item->min;
			$max_usia_array[] = $item->max;
		}
		$data['min'] = $min_usia_array;
		$data['max'] = $max_usia_array;

		return $data;
	}

	private function getObjectAge($name,$min,$max)
	{
		$temp = new \StdClass();
		$temp->name = $name;
		$temp->min = $min;
		$temp->max = $max;
		return $temp;
	}
}
