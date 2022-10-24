<?php

namespace App\Http\Controllers\ThirdParty\BPJS\Applicare;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ReadController extends Controller
{
    public function getData($data)
    {
        $header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
        $kode_ppk = config('app.bpjs_ppk');
        $start = $data['start'];
        $limit = $data['limit'];
        try
        {
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getAplicareUrl().'/rest/bed/read/'.$kode_ppk.'/'.$start.'/'.$limit, [
                    'headers' => ['Content-Type' => 'application/json'], 
                    'Accept' => 'application/json',
                    \GuzzleHttp\RequestOptions::JSON => [],
                ]);
            $kamar = ($res->getBody()->getContents());
            return ($kamar);
        } catch (Exception $e) {
            
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