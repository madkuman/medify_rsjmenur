<?php

namespace App\Http\Controllers\BPJS\RujukanKhusus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function setCreateRujukanKhusus(Request $request){
		// "noRujukan"=> "0301U0331019P003283",
		// "diagnosa"=> [
		// 		["kode"=> "P;N18"],
		// 		["kode"=> "S;N18.1"]
		// ],
		// "procedure"=>  [
		// 		["kode"=> "39.95"]
		// ],
		// "user"=> "Coba Ws"

		// $diagnosa = [
		// 		["kode"=> "P;N18"],
		// 		["kode"=> "S;N18.1"]
		// ];
		// $procedure =
		// [
		// 		["kode"=> "39.95"]
		// ];
		$diagnosa  = $request->diagnosa;
		$procedure = $request->procedure;
		$set_data = [
			"noRujukan" => $request->no_rujukan,
			"diagnosa"  => $diagnosa, #array icd 10
			"procedure" => $procedure, #array icd 9
			"user"      => auth()->user()->name ?? "Coba ws",
		];
		return $set_data;
	}

	public function setCreateData(Request $request)
	{
		$diagnosa_data = [];
		foreach ($request->diagnosa as $key => $value) {
			$diagnosa_data[$key] = ["kode" => $value["tipe"].";".$value["kode_diagnosa"]];
		}

		$prosedur_data = [];
		foreach ($request->prosedur as $key => $value) {
			$prosedur_data[$key] = ["kode" => $value["kode_prosedur"]];
		}

		$data = [
			"no_rujukan" => $request->nomor_rujukan,
			"diagnosa" => $diagnosa_data,
			"procedure" => $prosedur_data,
		];

		return $data;
	}
}
