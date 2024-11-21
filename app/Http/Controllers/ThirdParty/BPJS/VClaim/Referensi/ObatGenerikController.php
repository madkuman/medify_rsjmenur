<?php

namespace App\Http\Controllers\ThirdParty\BPJS\VClaim\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ObatGenerikController extends Controller
{
    public function getObatGenerik($param)
    {
        if (is_array($param)) $param = (object) $param;

        $header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
        $url = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl() . '/referensi/obatprb/' . $param->nama_obat;
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

            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
    }
}
