<?php

namespace App\Http\Controllers\ThirdParty\BPJS\VClaim\SEP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ThirdParty\BPJS\RequestController;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class EditController extends Controller
{
    public function __construct()
    {
        $this->requestController = new RequestController();
    }

    public function edit($data)
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
            $res = $client->request('PUT', $this->requestController->getUrl().'/SEP/1.1/update',
            	[
					 'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                    \GuzzleHttp\RequestOptions::JSON => $data,
				]
            	);
            $sep = $res->getBody()->getContents();
            if(config('app.bpjs_decrypt', false)){
                $sep_decoded = json_decode($sep);
                $sep_decoded->response = json_decode($this->requestController->stringDecrypt($timestamp, $sep_decoded->response));
                return(json_encode($sep_decoded));
            }else{
                return $sep;
            }
        } catch (\Exception $e) {
            if(config('app.debug')){
                dd($e);
            }
            
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e){
            if(config('app.debug')){
                dd($e);
            }
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
    }

    public function pulang($data)
    {
        try
        {   

            $header_array = $this->requestController->getHeader();
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
            $res = $client->request('PUT', $this->requestController->getUrl().'/Sep/updtglplg', [
                    'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                    \GuzzleHttp\RequestOptions::JSON => $data,
            ]);
            $update = $res->getBody()->getContents();
            
            if(config('app.bpjs_decrypt', false)){
                $update_decoded = json_decode($update);
                $update_decoded->response = json_decode($this->requestController->stringDecrypt($timestamp, $update_decoded->response));
                return(json_encode($update_decoded));
            }else{
                return $update;
            }
            // dd($update, (string)$container[0]['request']->getBody(), $data);
            return $update;
            
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


    public function editSep2($param)
    {
        try {
            $header_array = $this->requestController->getHeader();
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $url = $this->requestController->getUrl() . '/SEP/2.0/update';
            $res = $client->request('PUT', $url, [
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

    

    public function pulang2($data)
    {
        try
        {   

            $header_array = $this->requestController->getHeader();
            $container = [];
            $history = Middleware::history($container);

            $stack = HandlerStack::create();
            // Add the history middleware to the handler stack.
            $stack->push($history);

            $client = new Client([
                    'headers' => $header_array, 
                    'handler' => $stack
                ]);
            
            $param['request'] = [
                't_sep' => [
                    "noSep"=> $data['no_sep'],
                    "statusPulang"=> 1,
                    "noSuratMeninggal"=>"",
                    "tglMeninggal"=>"",
                    "tglPulang"=> Carbon::parse($data['tgl_pulang'])->toDateString(),
                    "noLPManual"=>"",
                    "user"=>$data['user']
                ]
            ];
                
            $timestamp = $header_array['X-timestamp'];
            $res = $client->request('PUT', $this->requestController->getUrl().'/SEP/2.0/updtglplg', [
                    'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                    \GuzzleHttp\RequestOptions::JSON => $param,
            ]);
            $update = $res->getBody()->getContents();
            
            if(config('app.bpjs_decrypt', false)){
                $update_decoded = json_decode($update);
                $update_decoded->response = json_decode($this->requestController->stringDecrypt($timestamp, $update_decoded->response));
                return(json_encode($update_decoded));
            }else{
                return $update;
            }
            // dd($update, (string)$container[0]['request']->getBody(), $data);
            return $update;
            
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
}
