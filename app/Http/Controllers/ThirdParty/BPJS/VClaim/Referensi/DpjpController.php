<?php

namespace App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class DpjpController extends Controller
{
    public function getDpjp($jp, $tgl, $spesialis)
    {
    	$header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();

    	try 
    	{
            $timestamp = $header_array['X-timestamp'];
    		$client = new Client(['headers' => $header_array]);
    		$res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl().'/referensi/dokter/pelayanan/'.$jp.'/tglPelayanan/'.$tgl.'/Spesialis/'.$spesialis);
    		$dpjp = ($res->getBody()->getContents());
            if(config('app.bpjs_decrypt', false)){
                $dpjp_decoded = json_decode($dpjp);
                $dpjp_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $dpjp_decoded->response));
                return(json_encode($dpjp_decoded));
            }else{
                return $dpjp;
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
