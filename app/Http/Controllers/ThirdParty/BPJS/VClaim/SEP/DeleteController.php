<?php

namespace App\Http\Controllers\ThirdParty\BPJS\VClaim\SEP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ThirdParty\BPJS\RequestController;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class DeleteController extends Controller
{
    public function __construct()
    {
        $this->requestController = new RequestController();
    }
    public function delete($data)
    {
        $header_array = $this->requestController->getHeader();
        try
        {	
        	//$param = json_encode($data, JSON_FORCE_OBJECT);
            // dd($data, $secret, $cons_id);
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('DELETE', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl().'/SEP/Delete',
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
            // dd($sep);
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
        }
    }
    public function deleteSepV2($data)
    {
        $header_array = $this->requestController->getHeader();
        try
        {	
        	//$param = json_encode($data, JSON_FORCE_OBJECT);
            // dd($data, $secret, $cons_id);
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('DELETE', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl().'/SEP/2.0/delete',
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
            // dd($sep);
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
        }
    }
    public function deleteInternal($data)
    {
        $header_array = $this->requestController->getHeader();
        try
        {	
        	//$param = json_encode($data, JSON_FORCE_OBJECT);
            // dd($data, $secret, $cons_id);
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('DELETE', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl().'/SEP/Internal/delete',
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
            // dd($sep);
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
        }
    }
}
