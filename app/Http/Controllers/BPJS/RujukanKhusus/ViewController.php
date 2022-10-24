<?php

namespace App\Http\Controllers\BPJS\RujukanKhusus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ViewController extends Controller
{
    public function index(){
        return view('bpjs.rujukan-khusus.search.index');
   
    }

    public function create()
    {
        return view('bpjs.rujukan-khusus.search.create');
    }

    public function listBulanTahun(Request $request){
        try {
            $header_array = $this->getInitThirdPartyBPJS()->getHeader();
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            // $url = $this->getInitThirdPartyBPJS()->getUrl() . '/Rujukan/ListSarana/PPKRujukan/'.config('app.bpjs_ppk');
            $url = $this->getInitThirdPartyBPJS()->getUrl() . '/Rujukan/Khusus/List/Bulan/'.$request->bulan.'/Tahun/'.$request->tahun;

            $res = $client->request('GET', $url, [
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                \GuzzleHttp\RequestOptions::JSON => []
            ]);
            $rujukan = $res->getBody()->getContents();

            if (config('app.bpjs_decrypt', false)) {
                $rujukan_decoded = json_decode($rujukan);
                $rujukan_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $rujukan_decoded->response));
                return (json_encode($rujukan_decoded));
            } else {
                return $rujukan;
            }

        } catch (\Throwable $th) {
            return $this->bugsnag($th);
        }
    }
}
