<?php

namespace App\Http\Controllers\ThirdParty\BPJS\VClaim\Peserta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ReadController extends Controller
{
    public function getByKartu($nokartu, $tanggal)
    {
		$header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
		try
		{
			$client = new Client(['headers' => $header_array]);
            $timestamp = $header_array['X-timestamp'];
			$res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl().'/Peserta/nokartu/'.$nokartu.'/tglSEP/'.$tanggal);
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
	
	public function getByNIK($nik, $tgl_sep)
    {
    	$header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();

    	try {
            $timestamp = $header_array['X-timestamp'];
    		$client = new Client(['headers' => $header_array]);
    		$res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl().'/Peserta/nik/'.$nik.'/tglSEP/'.$tgl_sep);
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
