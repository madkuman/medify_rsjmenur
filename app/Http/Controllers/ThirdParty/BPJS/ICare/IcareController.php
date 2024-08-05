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
		$header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();

		try {
			$client = new Client();
			$timestamp = $header_array['X-timestamp'];
			$param = $request->input('param');
			$kodedokter = $request->input('kodedokter');

			$response = $client->request('POST', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getIcareUrl(), $header_array, [
				'param' => $param,
				'kodedokter' => $kodedokter
			]);
			$results = ($response->getBody()->getContents());
			$results_decoded = json_decode($results);
			$results_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $results_decoded->response));
			return (json_encode($results_decoded));
		} catch (\Exception $e) {
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
