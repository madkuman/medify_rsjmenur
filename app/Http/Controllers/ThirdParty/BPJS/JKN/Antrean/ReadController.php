<?php

namespace App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReadController extends Controller
{
    protected $request;
    public function __construct()
    {
        $this->request = app('App\Http\Controllers\ThirdParty\BPJS\JKN\RequestController');
    }

    public function getListTask(Request $params)
    {
        try {
            $header = $this->request->getHeader();
            $timestamp = $header['X-timestamp'];
            $client = new Client(['headers' => $header]);
            $res = $client->request('POST', $this->request->getUrl().'/antrean/getlisttask', [
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                \GuzzleHttp\RequestOptions::JSON => $params->all(),
            ]);

            $content = $res->getBody()->getContents();
            
            if (config('medify.third-party.jkn_online.on')) {
                $content = json_decode($content);
                if ($content->metadata->code == 200) {
                    $content->response = json_decode($this->request->stringDecrypt($timestamp, $content->response));
                }

                $content = json_encode($content);
            }

            return $content;
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
