<?php

namespace App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApplicareController extends Controller
{
    public function kelas()
   {
		$header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
		try
		{
            $timestamp = $header_array['X-timestamp'];
			$client = new Client(['headers' => $header_array]);
			$res = $client->request('GET', app(\App\Http\Controllers\ThirdParty\BPJS\RequestController::class)->getAplicareUrl().'/rest/ref/kelas', [
                    'headers' => ['Content-Type' => 'application/json'], 
                    'Accept' => 'application/json',
                    \GuzzleHttp\RequestOptions::JSON => [],
                ]);
			$kelas = ($res->getBody()->getContents());
            return $kelas;
            // if(config('app.bpjs_decrypt', false)){
            //     $kelas_decoded = json_decode($kelas);
            //     $kelas_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $kelas_decoded->response));
            //     return(json_encode($kelas_decoded));
            // }else{
            //     return $kelas;
            // }
		} catch (\Exception $e) {
			
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi Applicare. Apabila Applicare tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
		}catch (GuzzleException $e){
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi Applicare. Apabila Applicare tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
   }
}
