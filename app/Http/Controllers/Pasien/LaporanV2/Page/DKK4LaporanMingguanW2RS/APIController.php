<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DKK4LaporanMingguanW2RS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;

class APIController extends Controller
{
	private $icd10_list = array(
		'Diare Akut' => [10412], //A09.0
		'Malaria Konfirmasi' => [723], //B54
		'Suspek Dengue' => [425], //A90
		'Pneumonia' => [3934], //J18.9
		'Diare Berdarah/ Disentri' => [44], //A06.0
		'Suspek Demam Tifoid' => [6], //A01.0
		'Sindrom Jaundice Akut' => [7267], //R17
		'Suspek Chikungunya' => [428], //A92.0
		'Suspek Flu Burung Pada Manusia' => [3904], //J11.1
		'Suspek Campak' => [494], //B05.9
		'Suspek Difteri' => [191], //A36.1
		'Pertussis' => [200], //A37.9
		'Acute Flacid Paralysis (AFP)' => [3057], //G81.0
		'Gigitan Hewan Penular Rabies' => [390], //A82.0
		'Suspek Antrax' => [133], //A22.9
		'Suspek Leptospirosis' => [159], //A27.9
		'Suspek Kolera' => [4], //A00.9
		'Kluster Penyakit yang tidak lazim' => [2911], //G44.0
		'Suspek Meningitis/Encephalitis' => [2802], //G03.9
		'Suspek Tetanus Neonatorum' => [186], //A33
		'Suspek Tetanus' => [188], //A35
		'ILI (Penyakit Serupa Influenza)' => [3904], //J11.1
		'Suspek HFMD' => [6148, 505] //O74.3, B08.4
	);

    public function getTotalData(Request $request)
    {
		return json_encode([
			'status' => 200,
			'data' => count($this->icd10_list)
		]);
    }

    public function getData(Request $request)
    {
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();
		$data_fetched = $request->datafetched;
		$limit = $request->limit;
		$total_rajal = 0;
    	$total_ranap = 0;
    	$total = 0;

		$all_penyakit = array_slice($this->icd10_list, $data_fetched, $limit);
		
		foreach ($all_penyakit as $key => $value) {
    		$kasus_rajal = Kasus::select('kasus.*')
			    			->join('diagnosis', 'kasus.id', '=', 'diagnosis.kasus_id')
			    			->whereBetween('kasus.created_at',[$start,$end])
			    			->where(function($q){
			    				$q->where('kasus.tipe_rj', 1)->orWhere('kasus.tipe_igd', 1);
			    			})
			    			->where('kasus.tipe_ri', 0)
			    			->whereIn('diagnosis.icd_10', $value)
			    			->groupBy('kasus.id')
			    			->get();
			$kasus_ranap = Kasus::select('kasus.*')
			    			->join('diagnosis', 'kasus.id', '=', 'diagnosis.kasus_id')
			    			->whereBetween('kasus.mrs_at',[$start,$end])
			    			->where('kasus.tipe_ri', 1)
			    			->whereIn('diagnosis.icd_10', $value)
			    			->groupBy('kasus.id')
			    			->get();

			$result[$key] = [count($kasus_rajal), count($kasus_ranap)];
			$total_rajal += count($kasus_rajal);
			$total_ranap += count($kasus_ranap);
			$total += count($kasus_rajal)+count($kasus_ranap);
    	}

		$array_data = [];
		$i =0;
		foreach($all_penyakit as $index => $penyakit)
		{
			$new_item = new \StdClass();
			$new_item->no = $data_fetched + $i + 1;
			$new_item->jenis_pelayanan = $index;
			$new_item->rajal = $total_rajal;
			$new_item->ranap = $total_ranap;
			$new_item->total = $total;
			
			$array_data[] = $new_item;
			$i++;
		}


		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}
