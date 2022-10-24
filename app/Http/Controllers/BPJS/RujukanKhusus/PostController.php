<?php

namespace App\Http\Controllers\BPJS\RujukanKhusus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function setCreate(Request $request)
	{
		try {
			$data = app(\App\Http\Controllers\BPJS\RujukanKhusus\CreateController::class)->setCreateData($request);

			$data = new Request($data);
			
			$return_data = $this->create($data);

			return $return_data;
		} catch (\Exception $e) {
			$data["metaData"] = [
				"code" => "500",
				"message" => "error sistem",
			];

			$data["response"] = null;
			return $data;
		}
	}
	
    public function create(Request $request)
    {
		app('debugbar')->disable();
    	try {
			$header_array = $this->getInitThirdPartyBPJS()->getHeader();
			$set_rujukan_khusus = app(\App\Http\Controllers\BPJS\RujukanKhusus\CreateController::class)->setCreateRujukanKhusus($request);
			$timestamp = $header_array['X-timestamp'];
			$client = new Client(['headers' => $header_array]);
			$url = $this->getInitThirdPartyBPJS()->getUrl().'/Rujukan/Khusus/insert';
			// dd($url);
			$res = $client->request('POST', $url, [
				'headers' => [
					'Content-Type' => 'application/x-www-form-urlencoded',
					'Content-Encoding' => 'deflate',
				],
				\GuzzleHttp\RequestOptions::JSON => $set_rujukan_khusus
			]);
			$rujukan = $res->getBody()->getContents();
			if (config('app.bpjs_decrypt', false)){
				$rujukan_decoded = json_decode($rujukan);
				$rujukan_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $rujukan_decoded->response));
				return (json_encode($rujukan_decoded));
			} else {
				return $rujukan;
			}

    	} catch (\Exception $e) {
    		DB::connection('kasus')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    	}
    }

    public function delete(Request $request)
    {
    	try {
			$header_array = $this->getInitThirdPartyBPJS()->getHeader();
			$header_array['Content-Encoding'] = 'deflate';
			
			$set_rujukan_khusus_delete =  [
				"request"=> [
						"t_rujukan"=> [
								"idRujukan" => $request->id_rujukan,//"98865",
								"noRujukan" => $request->no_rujukan,//"0301U0331019P003283",
								"user"      => auth()->user()->name ?? "SuperAdmin",//"Coba Ws"
						]
					]
				];

			$timestamp = $header_array['X-timestamp'];
			$client = new Client(['headers' => $header_array]);
			$url = $this->getInitThirdPartyBPJS()->getUrl() . '/Rujukan/Khusus/delete';
			// dd($url);
			$res = $client->request('POST', $url, [
					'headers' => [
						'Content-Type' => 'application/x-www-form-urlencoded',
						'Content-Encoding' => 'deflate',
					],
					\GuzzleHttp\RequestOptions::JSON => $set_rujukan_khusus_delete
				]);
			$rujukan = $res->getBody()->getContents();
			if (config('app.bpjs_decrypt', false)) {
				$rujukan_decoded = json_decode($rujukan);
				$rujukan_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $rujukan_decoded->response));
				return (json_encode($rujukan_decoded));
			} else {
				return $rujukan;
			}

    	} catch (\Exception $e) {
            return $this->bugsnag($e);
    	}
    }
}
