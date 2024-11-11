<?php

namespace App\Http\Controllers\ThirdParty\BPJS\JKN\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ReadController extends Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\RequestController::class);
    }

    public function getReferensi($url)
    {
        $header_array = $this->request->getHeader();
        $key = $this->request->getKey();
        try {
            $client = new Client(['headers' => $header_array]);
            $res = $client->request(
                'GET',
                $this->request->getUrl() . '/ref/' . $url,
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    'Accept' => 'application/json',
                    \GuzzleHttp\RequestOptions::JSON => [],
                ]
            );

            $content = $res->getBody()->getContents();

            $content = $this->request->stringDecrypt($key, $content);

            return $content;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi Applicare. Apabila Applicare tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
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
