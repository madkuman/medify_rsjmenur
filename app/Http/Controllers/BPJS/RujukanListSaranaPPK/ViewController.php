<?php

namespace App\Http\Controllers\BPJS\RujukanListSaranaPPK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;

class ViewController extends Controller
{
    public function index(){
        return view('bpjs.rujukan-listsarana-ppkr.index.index');
   
    }

    public function listSarana(){
        try {
            $header_array = $this->getInitThirdPartyBPJS()->getHeader();
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $url = $this->getInitThirdPartyBPJS()->getUrl() . '/Rujukan/ListSarana/PPKRujukan/'.config('app.bpjs_ppk');

            $res = $client->request('GET', $url, [
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                \GuzzleHttp\RequestOptions::JSON => []
            ]);
            $rujukan = $res->getBody()->getContents();

            if (config('app.bpjs_decrypt', false)) {
                $rujukan_decoded = json_decode($rujukan);
                $rujukan_decoded->response = json_decode(app(\App\Http\Controllers\ThirdParty\BPJS\RequestController::class)->stringDecrypt($timestamp, $rujukan_decoded->response));
                return (json_encode($rujukan_decoded));
            } else {
                return $rujukan;
            }
        } catch (\Throwable $th) {
            return $this->bugsnag($th);
        }
    }

    public function listSpesialistikPpkRujukan(Request $request){
        try {
            $header_array = $this->getInitThirdPartyBPJS()->getHeader();
            $tanggal = Carbon::parse($request->tanggal)->format('Y-m-d');
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $url = $this->getInitThirdPartyBPJS()->getUrl() . '/Rujukan/ListSpesialistik/PPKRujukan/'.config('app.bpjs_ppk').'/TglRujukan/'.$tanggal;

            $res = $client->request('GET', $url, [
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                \GuzzleHttp\RequestOptions::JSON => []
            ]);
            $rujukan = $res->getBody()->getContents();

            if (config('app.bpjs_decrypt', false)) {
                $rujukan_decoded = json_decode($rujukan);
                $rujukan_decoded->response = json_decode(app(\App\Http\Controllers\ThirdParty\BPJS\RequestController::class)->stringDecrypt($timestamp, $rujukan_decoded->response));
                return (json_encode($rujukan_decoded));
            } else {
                return $rujukan;
            }
        } catch (\Throwable $th) {
            return $this->bugsnag($th);
        }
    }
}
