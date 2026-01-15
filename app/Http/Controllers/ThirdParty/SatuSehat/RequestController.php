<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class RequestController extends Controller
{
    public function getHeader()
    {
        $request = new Request();

        $_token = app(\App\Http\Controllers\ThirdParty\SatuSehat\Auth\PostController::class)->getToken($request);
        
        $limit_try = 3;
        while (empty($_token) && $limit_try > 0) {
            $_token = app(\App\Http\Controllers\ThirdParty\SatuSehat\Auth\PostController::class)->getToken($request);
            $limit_try--;
        }

        if (empty($_token)) return [];

        $header = [
            'Authorization' => "Bearer $_token",
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        return $header;
    }

    public function getAuthUrl()
    {
		return config('medify.third-party.satusehat.auth_url');
    }

    public function getBaseUrl()
    {
        return config('medify.third-party.satusehat.base_url');
    }

    public function getConsentUrl()
    {
        return config('medify.third-party.satusehat.consent_url');
    }

    public function send($method, $url, $param_type = null, $params = []) {
        try {
            $header_array = $this->getHeader();
            if (empty($header_array))
                $this->failedResponse('Gagal', ['error' => 'Header failed to set']);
    
            $send_params = [];
            if (!is_null($param_type)) {
                $send_params = [
                    $param_type => $params
                ];
            }

            $client = new Client(['headers' => $header_array]);
            $res = $client->request(
                $method,
                $url,
                $send_params
            );
            $response = json_decode($res->getBody()->getContents());

            return $this->successResponse('Berhasil', $response);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $error_body = json_decode($e->getResponse()->getBody()->getContents());
            (new \App\Http\Controllers\ThirdParty\SatuSehat\Log\CreateController())->error($url, $params, $error_body);
            
            return $this->failedResponse('Error', $error_body);
        }
    }

    public function successResponse($message = 'Berhasil', $data = [])
    {
        return json_encode([
            "code" => 200,
            "message" => $message,
            "response" => $data
        ]);
    }

    public function failedResponse($message = 'Tidak dapat menghubungkan dengan server SatuSehat', $data = [])
    {
        return json_encode([
            "code" => 500,
            "message" => $message,
            "response" => $data
        ]);
    }
}
