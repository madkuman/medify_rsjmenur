<?php

namespace App\Http\Controllers\ThirdParty\BPJS\JKN\JadwalDokter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class EditController extends Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\RequestController::class);
    }

    public function updateJadwalDokter(Request $params)
    {
        $header_array = $this->request->getHeader();
        try {
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('POST', $this->request->getUrl().'/jadwaldokter/updatejadwaldokter',
            [
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                \GuzzleHttp\RequestOptions::JSON => $params->all(),
            ]);

            $content = $res->getBody()->getContents();

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
        } catch (GuzzleException $e){
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
