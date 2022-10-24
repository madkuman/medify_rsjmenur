<?php

namespace App\Http\Controllers\ThirdParty\BPJS\Applicare;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class DeleteController extends Controller
{
    public function deleteRuanganBatch($param)
    {
    	$header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
    	$kode_ppk = config('app.applicare_ppk');

    	try
    	{
    	    $container = [];
    	    $history = Middleware::history($container);

    	    $stack = HandlerStack::create();
    	    // Add the history middleware to the handler stack.
    	    $stack->push($history);

    	    $client = new Client([
    	            'headers' => $header_array, 
    	            'handler' => $stack
    	        ]);
    	    $res = $client->request('POST', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getAplicareUrl().'/rest/bed/delete/'.$kode_ppk, [
    	            'headers' => ['Content-Type' => 'application/json'],
    	            'Accept' => 'application/json',
    	            \GuzzleHttp\RequestOptions::JSON => $param,
    	        ]);
    	    $response = ($res->getBody()->getContents());
    	    return ($response);
    	} catch (\Exception $e) {
    	    return json_encode([
    	        "metaData" => [
    	            "code" => "500",
    	            "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi Applicare. Apabila Applicare tidak dapat dibuka, hubungi petugas BPJS yang ada."
    	        ],
    	        "response" => []
    	    ]);
    	} catch (GuzzleException $e){
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
