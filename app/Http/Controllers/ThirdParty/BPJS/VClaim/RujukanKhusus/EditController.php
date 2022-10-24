<?php

namespace App\Http\Controllers\ThirdParty\BPJS\VClaim\RujukanKhusus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class EditController extends Controller
{
    public function edit($data)
    {
    	$header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();

    	try 
    	{
            $timestamp = $header_array['X-timestamp'];
    		$client = new Client(['headers' => $header_array]);
    		$res = $client->request('PUT', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl().'/Rujukan/update', [
    			'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
    			\GuzzleHttp\RequestOptions::JSON => $data
    		]);
    		$rujukan = json_decode($res->getBody()->getContents());
            if(config('app.bpjs_decrypt', false)){
                $rujukan_decoded = ($rujukan);
                $rujukan_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $rujukan_decoded->response));
                return(json_encode($rujukan_decoded));
            }else{
                return $rujukan;
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
