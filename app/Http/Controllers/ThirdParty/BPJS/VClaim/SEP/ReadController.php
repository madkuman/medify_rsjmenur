<?php

namespace App\Http\Controllers\ThirdParty\BPJS\VClaim\SEP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;

class ReadController extends Controller
{
    public function get($param)
    {
        $header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
		try
		{
            $timestamp = $header_array['X-timestamp'];
			$client = new Client(['headers' => $header_array]);
			$res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl().'/SEP/'.$param);
			$resp = $res->getBody()->getContents();
            if(config('app.bpjs_decrypt', false)){
                $resp_decoded = json_decode($resp);
                $resp_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $resp_decoded->response));
                return(json_encode($resp_decoded));
            }else{
                return $resp;
            }
		} catch (\Exception $e) {
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }catch (GuzzleException $e){
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
    }

    public function getHistori($nomor_peserta,$tanggal_start,$tanggal_end)
	{
        $header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
		$url = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl();
		$data =[];
		try
		{	
            $timestamp = $header_array['X-timestamp'];

			$url = $url.'/monitoring/HistoriPelayanan/NoKartu/'.$nomor_peserta.'/tglAwal/'.$tanggal_start.'/tglAkhir/'.$tanggal_end;
			$client = new Client(['headers' => $header_array]);
			$res = $client->request('GET', $url, [
				'headers' => ['Content-Type' => 'application/json'], 
				'Accept' => 'application/json',
				\GuzzleHttp\RequestOptions::JSON => [],
			]);
			$resp = $res->getBody()->getContents();
            if(config('app.bpjs_decrypt', false)){
                $resp_decoded = json_decode($resp);
                $resp_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $resp_decoded->response));
                return(json_encode($resp_decoded));
            }else{
                return $resp;
            }
		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			return json_encode([
				"metaData" => [
					"code" => "500",
					"message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
				],
				"response" => []
			]);
		} catch (GuzzleException $e){
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			return json_encode([
				"metaData" => [
					"code" => "500",
					"message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
				],
				"response" => []
			]);
		} catch (BadResponseException $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$response = $e->getResponse();
			$jsonBody = (string) $response->getBody();
		}
	}

	public function getInternal($param)
	{
		$header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
		try {
			$timestamp = $header_array['X-timestamp'];
			// dd(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl() . '/SEP/Internal/' . $param);
			$client = new Client(['headers' => $header_array]);
			$res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl() . '/SEP/Internal/' . $param);
			$resp = $res->getBody()->getContents();
			if (config('app.bpjs_decrypt', false)) {
				$resp_decoded = json_decode($resp);
				$resp_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $resp_decoded->response));
				return (json_encode($resp_decoded));
			} else {
				return $resp;
			}
		} catch (\Exception $e) {
			return json_encode([
				"metaData" => [
					"code" => "500",
					"message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
				],
				"response" => []
			]);
		} catch (GuzzleException $e) {
			return json_encode([
				"metaData" => [
					"code" => "500",
					"message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
				],
				"response" => []
			]);
		}
	}
}
