<?php

namespace App\Http\Controllers\ThirdParty\SIRS\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;

class RequestController extends Controller
{
    private $base_url, $auth_pass, $auth_id;

    public function __construct()
    {
        $this->base_url = config('medify.third-party.sirs_v3.url');
        $this->auth_id = config('medify.third-party.sirs_v3.id');
        $this->auth_pass = config('medify.third-party.sirs_v3.password');
    }

    public function authV3($kode_rs = null, $password = null)
    {
        $data['kode_rs'] = empty($kode_rs) ? $this->auth_id : $kode_rs;
        $data['password'] = empty($password) ? $this->auth_pass : $password;
        
        $response = $this->requestAPI('rslogin', $data);
        $this->storeAuth($response['response']);
    }

    public function storeAuth($response)
    {
        $data = $response['data'];
        $access_token = $data['access_token'];
        $issued_at = Carbon::parse($data['issued_at']);
        $expired_at = Carbon::parse($data['expired_at']);
        $diff_in_minutes = $issued_at->diffInMinutes($expired_at);
        $diff_in_minutes -= 2;
        
        \Cache::forget('sirs_v3_bearer_token');
        \Cache::remember('sirs_v3_bearer_token', $diff_in_minutes, function () use ($access_token) {
            return $access_token;
        });
    }

    public function requestAPI($api_slug, $data)
    {
        $res_return['code'] = 404;
        $res_return['response']['status'] = false;
        try {
            $api = app(\App\Http\Controllers\ThirdParty\SIRS\API\ReadController::class)->getAPIBySlug($api_slug);
            if (empty($api)) return $res_return;

            $headers['Content-Type'] = 'application/json';
            if (\Cache::has('sirs_v3_bearer_token')) {
                $bearer_token = \Cache::get('sirs_v3_bearer_token');
                $headers['Authorization'] = 'Bearer ' . $bearer_token;
            }

            $explode_url = explode('{', $api->url);
            if (count($explode_url) > 1) {
                $param = str_replace('}', '', $explode_url[1]);
                if (isset($data[$param])) {
                    $api->url = $explode_url[0].$data[$param];
                    unset($data[$param]);
                }
            }
            if ($api->method == 'GET') {
                $api->url = $api->url.'?'.http_build_query($data);
            }

            $client = new Client();
            $res = $client->request(
                $api->method,
                $this->base_url . $api->url,
                [
                    'headers' => $headers,
                    'http_errors' => false,
                    \GuzzleHttp\RequestOptions::JSON => $data,
                ]
            );
            $res_body = $res->getBody()->getContents();
            $res_body = json_decode($res_body, true);
            $res_status = $res->getStatusCode();

            $res_return['code'] = $res_status;
            $res_return['response'] = $res_body;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            app(\App\Http\Controllers\Error\Handler::class)->bugsnag($e);
            $res_status = $res->getStatusCode();
            $res_return['code'] = $res_status;
        } catch (\Exception $e) {
            app(\App\Http\Controllers\Error\Handler::class)->bugsnag($e);
            $res_return['code'] = 500;
        }
        return $res_return;
    }
}
