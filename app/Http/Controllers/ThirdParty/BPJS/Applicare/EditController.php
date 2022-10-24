<?php

namespace App\Http\Controllers\ThirdParty\BPJS\Applicare;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class EditController extends Controller
{
    public function editRuangan($kode_ppk, $param)
    {
        $header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
     
        try
        {
            $container = [];
            $client = new Client([
                    'headers' => $header_array, 
            ]);
            $res = $client->request('POST', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getAplicareUrl().'/rest/bed/update/'.$kode_ppk, [
                    'headers' => ['Content-Type' => 'application/json'],
                    'Accept' => 'application/json',
                    \GuzzleHttp\RequestOptions::JSON => $param,
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

    public function batchUpdate($data)
    {
        $header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
     
        try
        {
            $client = new Client([
                    'headers' => $header_array
            ]);
            $kode_ppk = config('app.bpjs_ppk');
            $is_batch = 0; 
            if($is_batch){ #kodingan lama
                echo "total : ".count($data['data_ruang'])."\n";
                try{
                    $res = $client->request('POST', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getAplicareUrl().'/rest/bed/updateBatch/'.$kode_ppk, [
                        'headers' => ['Content-Type' => 'application/json'],
                        'Accept' => 'application/json',
                        \GuzzleHttp\RequestOptions::JSON => $data,
                    ]);
                    echo "true";
                } catch (GuzzleException $e){
                    echo "false";
                }
            }else{ #kodingan foreach update tiap kamar
                echo "total : ".count($data['data_ruang'])."\n";
                foreach($data['data_ruang'] as $key => $item){
                    echo "updating : ".$item['koderuang']." - ";
                    try{
                        $res = $client->request('POST', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getAplicareUrl().'/rest/bed/update/'.$kode_ppk, [
                            'headers' => ['Content-Type' => 'application/json'],
                            'Accept' => 'application/json',
                            \GuzzleHttp\RequestOptions::JSON => $item,
                        ]);
                        echo "true";
                    } catch (GuzzleException $e){
                        echo "false";
                    }
                    echo "\n";
                }
            }
            
            return true;
        } catch (\Exception $e) {
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
