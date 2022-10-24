<?php

namespace App\Http\Controllers\ThirdParty\BPJS\VClaim\SEP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ThirdParty\BPJS\RequestController;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class CreateController extends Controller
{
    public function __construct()
    {
        $this->requestController = new RequestController();
    }

    public function create($data)
    {
        $header_array = $this->requestController->getHeader();
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
            $timestamp = $header_array['X-timestamp'];
            $res = $client->request('POST', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl().'/SEP/1.1/insert',
            	[
                    'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
					\GuzzleHttp\RequestOptions::JSON => $data,
				]
        	);
            $sep = $res->getBody()->getContents();
            
            if(config('app.bpjs_decrypt', false)){
                $sep_decoded = json_decode($sep);
                $sep_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $sep_decoded->response));
                return(json_encode($sep_decoded));
            }else{
                return $sep;
            }
            // return array("sep" => $sep, "param" => (string)$container[0]['request']->getBody(),"param-raw" => $data);
            return $sep;
        } catch (\Exception $e) {
            
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e){
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (BadResponseException $ex) {
            $response = $ex->getResponse();
            $jsonBody = (string) $response->getBody();
            echo $jsonBody;
            // do something with json string...
        }
    }

    public function pengajuan($data)
    {
        $header_array = $this->requestController->getHeader();
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
            $timestamp = $header_array['X-timestamp'];
            $res = $client->request('POST', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl().'/Sep/pengajuanSEP',
                [
                    'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                    \GuzzleHttp\RequestOptions::JSON => $data,
                ]
            );
            $sep = $res->getBody()->getContents();
            
            if(config('app.bpjs_decrypt', false)){
                $sep_decoded = json_decode($sep);
                $sep_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $sep_decoded->response));
                return(json_encode($sep_decoded));
            }else{
                return $sep;
            }
            // dd($sep, (string)$container[0]['request']->getBody(), $data);
            return $sep;
        } catch (\Exception $e) {
            
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e){
            dd($e);
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (BadResponseException $ex) {
            $response = $ex->getResponse();
            $jsonBody = (string) $response->getBody();
            echo $jsonBody;
        }
    }

    public function approval($data)
    {
        $header_array = $this->requestController->getHeader();
        try
        {   
            $client = new Client([
                    'headers' => $header_array, 
                ]);
            $timestamp = $header_array['X-timestamp'];

            $res = $client->request('POST', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl().'/Sep/aprovalSEP',
                [
                    'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                    \GuzzleHttp\RequestOptions::JSON => $data,
                ]
            );
            $sep = $res->getBody()->getContents();
            
            if(config('app.bpjs_decrypt', false)){
                $sep_decoded = json_decode($sep);
                $sep_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $sep_decoded->response));
                return(json_encode($sep_decoded));
            }else{
                return $sep;
            }
            // dd($sep, (string)$container[0]['request']->getBody(), $data);
            return $sep;
        } catch (\Exception $e) {
            
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e){
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (BadResponseException $ex) {
            $response = $ex->getResponse();
            $jsonBody = (string) $response->getBody();
            echo $jsonBody;
        }
    }

    public function createSep2(Request $request){
        try {
            $header_array = $this->requestController->getHeader();
            $param = app(\App\Http\Controllers\BPJS\SEP\CreateController::class)->setVclaimSep2($request);
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $url = $this->requestController->getUrl() . '/SEP/2.0/insert';
            $res = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Content-Encoding' => 'deflate',
                ],
                \GuzzleHttp\RequestOptions::JSON => $param
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

    public function createSep2VersiAPI(Request $request){
        try {
            $header_array = $this->requestController->getHeader();
            $param = app(\App\Http\Controllers\BPJS\SEP\CreateController::class)->setVclaimSep2VersiAPI($request);
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $url = $this->requestController->getUrl() . '/SEP/2.0/insert';
            $res = $client->request('POST', $url, [
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded',
                        'Content-Encoding' => 'deflate',
                    ],
                    \GuzzleHttp\RequestOptions::JSON => $param
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
