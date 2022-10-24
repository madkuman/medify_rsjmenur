<?php

namespace App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class KabupatenController extends Controller
{
    public function getKabupaten($propinsi)
	{
		$header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
		try
		{
            $timestamp = $header_array['X-timestamp'];
			$client = new Client(['headers' => $header_array]);
			$res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl().'/referensi/kabupaten/propinsi/'.$propinsi);
			$kabupaten = ($res->getBody()->getContents());
            if(config('app.bpjs_decrypt', false)){
                $kabupaten_decoded = json_decode($kabupaten);
                $kabupaten_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $kabupaten_decoded->response));
                return(json_encode($kabupaten_decoded));
            }else{
                return $kabupaten;
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
}
