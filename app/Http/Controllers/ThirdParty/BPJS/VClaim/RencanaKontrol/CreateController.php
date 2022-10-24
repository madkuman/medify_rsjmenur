<?php

namespace App\Http\Controllers\ThirdParty\BPJS\VClaim\RencanaKontrol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class CreateController extends Controller
{
    public function create($params)
    {
        try {	
            $container = [];
            $history = Middleware::history($container);
            $stack = HandlerStack::create();
            $stack->push($history);
            
            $client_array = [
                'headers' => app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader(), 
                'handler' => $stack 
            ];
            $timestamp = $client_array['headers']['X-timestamp'];
            $client = new Client($client_array);

            $api_base_url = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl();
            $url = $api_base_url.'/RencanaKontrol/insert';
            if(isset($params['request']['noKartu'])){
                $url = $api_base_url.'/RencanaKontrol/InsertSPRI';
            }
            $res = $client->request('POST', $url, [
                        'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
					    \GuzzleHttp\RequestOptions::JSON => $params 
                    ]);

            $resp = $res->getBody()->getContents();
            
            if(config('app.bpjs_decrypt', false)){
                $resp_decoded = json_decode($resp);
                $resp_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $resp_decoded->response));
                return(json_encode($resp_decoded));
            }else{
                return $resp;
            }
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
}
