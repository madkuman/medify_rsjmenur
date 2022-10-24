<?php

namespace App\Http\Controllers\BPJS\Referensi\DPJP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class PostController extends Controller
{
    public function search(Request $request){
        try {

            $pelayanan = $request->pelayanan;
            $tgl       = $request->tgl;
            $spesialis = $request->spesialis;

            $header_array = $this->getInitThirdPartyBPJS()->getHeader();
            $timestamp    = $header_array['X-timestamp'];
            $client       = new Client(['headers' => $header_array]);
            $url          = $this->getInitThirdPartyBPJS()->getUrl() . '/referensi/dokter/pelayanan/' . $pelayanan . '/tglPelayanan/' . $tgl . '/Spesialis/' . $spesialis;
            $res = $client->request('GET', $url, [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Content-Encoding' => 'deflate',
                ],
                // \GuzzleHttp\RequestOptions::JSON => $param
            ]);
            $response = $res->getBody()->getContents();
            if (config('app.bpjs_decrypt', false)) {
                $response_decoded = json_decode($response);
                $response_decoded->response = json_decode(app(\App\Http\Controllers\ThirdParty\BPJS\RequestController::class)->stringDecrypt($timestamp, $response_decoded->response));
                return (json_encode($response_decoded));
            } else {
                return $response;
            }
        } catch (\Throwable $th) {
            return $this->bugsnagJson($th);
        }
    }
}
