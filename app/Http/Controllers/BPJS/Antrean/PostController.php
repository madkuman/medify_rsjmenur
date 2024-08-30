<?php

namespace App\Http\Controllers\BPJS\Antrean;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


class PostController extends Controller
{
    public function getAntreanPerTanggal()
    {
        $header_array = app('App\Http\Controllers\ThirdParty\BPJS\ICare\RequestController')->getHeader();
        try {
            $tanggal = Carbon::today()->format('Y-m-d');
            $timestamp = $header_array['X-timestamp'];
            $client = new Client([
                'headers' => $header_array,
            ]);
            $response = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrlAntrean() . '/antrean/pendaftaran/tanggal/' . $tanggal, [
                'headers' => ['Content-Type' => 'application/json']
            ]);
            $results = ($response->getBody()->getContents());
            $results_decoded = json_decode($results);
            $results_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $results_decoded->response));
            return view('bpjs.antrean.index', [
                "data" => $results_decoded->response
            ]);
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
