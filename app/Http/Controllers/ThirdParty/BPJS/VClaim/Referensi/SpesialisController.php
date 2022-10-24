<?php

namespace App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SpesialisController extends Controller
{
    public function getSpesialis()
    {
    	$header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();

    	try 
    	{
            $timestamp = $header_array['X-timestamp'];
    		$client = new Client(['headers' => $header_array]);
    		$res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl().'/referensi/spesialistik');
    		$spesialis = $res->getBody()->getContents();
            if(config('app.bpjs_decrypt', false)){
                $spesialis_decoded = json_decode($spesialis);
                $spesialis_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $spesialis_decoded->response));
                return(json_encode($spesialis_decoded));
            }else{
                return $spesialis;
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
