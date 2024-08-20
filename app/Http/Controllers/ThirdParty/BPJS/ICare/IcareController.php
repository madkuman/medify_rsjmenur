<?php

namespace App\Http\Controllers\ThirdParty\BPJS\ICare;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class IcareController extends Controller
{
	public function getIcare(Request $request)
	{
		$header_array = app('App\Http\Controllers\ThirdParty\BPJS\ICare\RequestController')->getHeader();
		// dd($header_array);
		try {
			$timestamp = $header_array['X-timestamp'];
			$client = new Client([
				'headers' => $header_array,
			]);
			$param = $request->input('param');
			$kodedokter = (int) $request->input('kodedokter');

			if (strlen($param) != 13) {
				return json_encode([
					"metaData" => [
						"code" => "500",
						"message" => "Jumlah digit nomor kartu harus 13 digit."
					],
					"response" => []
				]);
			}

			$response = $client->request('POST', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getIcareUrl(), [
				'Accept' => 'application/json',
				'headers' => ['Content-Type' => 'application/json'],
				'json' => ['param' => $param, 'kodedokter' => $kodedokter]
			]);
			$results = ($response->getBody()->getContents());
			$results_decoded = json_decode($results);
			$results_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $results_decoded->response));
			return (json_encode($results_decoded));
			// $hasil = [
			// 	'response' => [
			// 		'url' => "https://www.youtube.com"
			// 	],
			// 	'metaData' => [
			// 		'code' => 200,
			// 		'message' => "Berhasil coba"
			// 	]
			// ];
			// return (json_encode($hasil));
		} catch (\Exception $e) {
			// dd($e);
			return json_encode([
				"metaData" => [
					"code" => "500",
					"message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi."
				],
				"response" => []
			]);
		} catch (GuzzleException $e) {
			return json_encode([
				"metaData" => [
					"code" => "500",
					"message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi."
				],
				"response" => []
			]);
		}
	}
}
