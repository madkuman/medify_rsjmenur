<?php

namespace App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function updateWaktuAntrean($url, $header, $params)
    {
        try {
            $client = new Client(['headers' => $header]);
            $res = $client->request('POST', $url, [
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                \GuzzleHttp\RequestOptions::JSON => $params->all(),
            ]);
            return $res->getBody()->getContents();
        } catch (\Exception $e) {
            return $this->failedResponse();
        } catch (GuzzleException $e) {
            return $this->failedResponse();
        }
    }

    private function failedResponse()
    {
        return json_encode([
            "metaData" => [
                "code" => "500",
                "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
            ],
            "response" => [],
        ]);
    }
}
