<?php

namespace App\Http\Controllers\BPJS\Monitoring\DataKlaimJasaRaharja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ViewController extends Controller
{
	public function index()
	{
		$data['date_start'] = Carbon::now()->subMonth()->startOfMonth()->format('d-m-Y');
		$data['date_end'] = Carbon::now()->subMonth()->endOfMonth()->format('d-m-Y');
		return view('bpjs.monitoring.data-klaim-jasa-raharja.index',$data);
	}

	public function getData(Request $request)
	{
		$tanggal_start = Carbon::createFromFormat('d-m-Y', $request->tanggal_start)->format('Y-m-d');
		$tanggal_end = Carbon::createFromFormat('d-m-Y', $request->tanggal_end)->format('Y-m-d');

		//$data = app('App\Http\Controllers\BPJS\Monitoring\DataKlaimJasaRaharja\ReadController')->getData($tanggal_start,$tanggal_end);

		$data = $this->getJsonSample();
		$data = json_decode($data);

		$data_temp = $data->response->jaminan ?? [];

		$klaim_data = $data_temp;

		return json_encode($klaim_data);
	}

	private function getJsonSample()
	{
		$data = '{
			"metaData": {
				"code": "200",
				"message": "Sukses"
				},
				"response": {
					"jaminan": [
					{
						"sep": 
						{
							"noSEP":"0301R0110818V100085",
							"tglSEP":"2018-08-09",
							"tglPlgSEP":"2018-08-09",
							"noMr":"AA-01-11",
							"jnsPelayanan":"2",
							"poli":"INT",
							"diagnosa":"A00.1",
							"peserta":
							{
								"noKartu":"0001161271256",
								"nama":"JASA RAHARJA",
								"noMR":"AA-01-11"
							}
							},
							"jasaRaharja":
							{
								"tglKejadian":"2018-08-09",
								"noRegister":"AA-JR-0801",
								"ketStatusDijamin":"Dijamin",
								"ketStatusDikirim":"Sukses",
								"biayaDijamin":"100000",
								"plafon":"20000000",
								"jmlDibayar":"10000",
								"resultsJasaRaharja":"Sukses"
							}
							},
							{
								"sep": 
								{
									"noSEP":"0301R0110818V100185",
									"tglSEP":"2018-08-09",
									"tglPlgSEP":"2018-08-09",
									"noMr":"AA-01-11",
									"jnsPelayanan":"2",
									"poli":"INT",
									"diagnosa":"A00.1",
									"peserta":
									{
										"noKartu":"0003361271256",
										"nama":"JASA RAHARJA",
										"noMR":"AA-01-11"
									}
									},
									"jasaRaharja":
									{
										"tglKejadian":"2018-08-09",
										"noRegister":"AA-JR-0801",
										"ketStatusDijamin":"Dijamin",
										"ketStatusDikirim":"Sukses",
										"biayaDijamin":"100000",
										"plafon":"20000000",
										"jmlDibayar":"10000",
										"resultsJasaRaharja":"Sukses"
									}
								}
								]
							}
						}';
		return $data;
	}
}
