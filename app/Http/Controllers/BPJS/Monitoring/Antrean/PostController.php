<?php

namespace App\Http\Controllers\BPJS\Monitoring\Antrean;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class PostController extends Controller
{
    public function searchByKodeBooking(Request $request)
    {
        try {

            $kodebooking = $request->kodebooking;
            $header_array = $this->getInitThirdPartyBPJS()->getHeader();
            $timestamp    = $header_array['X-timestamp'];
            $client       = new Client(['headers' => $header_array]);
            $url          = $this->getInitThirdPartyBPJS()->getUrl() . '/antrean/pendaftaran/kodebooking/' . $kodebooking;
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
