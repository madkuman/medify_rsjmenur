<?php

namespace App\Http\Controllers\ThirdParty\BPJS\JKN\JadwalDokter;

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

    public function getReferensiJadwalDokter($kodepoli, $tanggal)
    {
        $header_array = $this->request->getHeader();
        try {
            $client = new Client(['headers' => $header_array]);
            $timestamp = $header_array['X-timestamp'];
            $res = $client->request('GET', $this->request->getUrl().'/jadwaldokter/kodepoli/'.$kodepoli.'/tanggal/'.$tanggal,
            [
                'headers' => ['Content-Type' => 'application/json'], 
                'Accept' => 'application/json',
                \GuzzleHttp\RequestOptions::JSON => [],
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
