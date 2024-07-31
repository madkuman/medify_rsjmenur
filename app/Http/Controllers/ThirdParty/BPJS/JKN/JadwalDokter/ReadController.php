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
            $res = $client->request('GET', $this->request->getUrl().'jadwaldokter/kodepoli/'.$kodepoli.'/tanggal/'.$tanggal,
            [
                'headers' => ['Content-Type' => 'application/json'], 
                'Accept' => 'application/json',
                \GuzzleHttp\RequestOptions::JSON => []
            ]);

            $content = $res->getBody()->getContents();

            if (config('medify.third-party.jkn_online.on')) {
                $content = json_decode($content);
                $metadata = isset($content->metadata) ? $content->metadata : $content->metaData;
                if (($metadata->code ?? $metadata->Code) == 200) {
                    $content->response = json_decode($this->request->stringDecrypt($timestamp, $content->response));
                }

                $content = json_encode($content);
            }

            return $content;

        } catch (\Exception $e) {
            return $this->request->defaultException($e);
        } catch (GuzzleException $e){
            return $this->request->defaultException($e);
        }
    }
}
