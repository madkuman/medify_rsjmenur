<?php

namespace App\Http\Controllers\BPJS\Monitoring\Kunjungan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

class ReadController extends Controller
{
	public function getData($tanggal,$pelayanan)
	{

		/*
			Parameter 1 : Tanggal Pulang format: yyyy-mm-dd
			Parameter 2 : Jenis Pelayanan (1. Inap 2. Jalan)
		*/
		$header = app('App\Http\Controllers\BPJS\API\Request\RequestController')->getHeader('vclaim');
		$url = app('App\Http\Controllers\BPJS\API\Request\RequestController')->getUrl();
		$data =[];

		try
        {	

            $url = $url.'/Monitoring/Kunjungan/Tanggal/'.$tanggal.'/JnsPelayanan/'.$pelayanan;

        	$client = new Client(['headers' => $header]);
			$res = $client->request('GET', $url, [
                    'headers' => ['Content-Type' => 'application/json'], 
                    'Accept' => 'application/json',
                    \GuzzleHttp\RequestOptions::JSON => [],
                ]);

            $data = $res->getBody()->getContents();
            return $data;
        } catch (Exception $e) {
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
        } catch (BadResponseException $ex) {
    		app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $response = $ex->getResponse();
            $jsonBody = (string) $response->getBody();
        }
	}
}
