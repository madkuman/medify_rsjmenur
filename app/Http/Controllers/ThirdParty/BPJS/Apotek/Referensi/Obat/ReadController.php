<?php

namespace App\Http\Controllers\ThirdParty\BPJS\Apotek\Referensi\Obat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


class ReadController extends Controller
{
    public function getReferensiObat($param, $tglresep, $filter)
    {
        if (is_array($param)) $param = (object) $param;
        $header_array = app('App\Http\Controllers\ThirdParty\BPJS\ICare\RequestController')->getHeader();
        $url = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrlApotek() . '/referensi/obat/' . $param->nama_obat . '/' . $tglresep . '/' . $filter;
        try {
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('GET', $url);
            $content = ($res->getBody()->getContents());

            if (config('app.bpjs_decrypt', false)) {
                $content_decoded = json_decode($content);
                $content_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $content_decoded->response));
                return (json_encode($content_decoded));
            } else {
                return $content;
            }
        } catch (\Exception $e) {
            // dd($e);
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi."
                ],
                "response" => []
            ]);
        }
    }
}
