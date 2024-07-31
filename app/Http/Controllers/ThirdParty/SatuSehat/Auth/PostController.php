<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\LogSatuSehatAuth;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PostController extends Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = app(\App\Http\Controllers\ThirdParty\SatuSehat\RequestController::class);
    }

    public function getToken(Request $request)
    {
        $client_id = config('medify.third-party.satusehat.client_id');
        $client_secret = config('medify.third-party.satusehat.client_secret');

        # cek exist token subminute
        $get_last_expire = LogSatuSehatAuth::orderBy('id', 'desc')->first();
        if (!empty($get_last_expire)) {
            $expired_min = Carbon::now()->subSeconds($get_last_expire->expires_in);
            $auth_log = LogSatuSehatAuth::where('created_at', '>=', $expired_min->toDateTimeString())->orderBy('id', 'desc')->first();
            if (!empty($auth_log)) return $auth_log->access_token;
        }

        $params = new Request([
            'client_id' => $client_id,
            'client_secret' => $client_secret
        ]);

        try {
            $client = new Client();
            $res = $client->request(
                'POST',
                $this->request->getAuthUrl() . '/accesstoken?grant_type=client_credentials',
                [
                    'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
					\GuzzleHttp\RequestOptions::FORM_PARAMS => $params->all(),
                ]
            );
            $content = json_decode($res->getBody()->getContents());

            $auth_log = LogSatuSehatAuth::insert([
                'access_token' => $content->access_token ?? null,
                'expires_in' => $content->expires_in ?? null,
                'status' => $content->status ?? "failed",
                'response' => json_encode($content),
                'created_by' => auth()->user()->id
            ]);
            
            return $content->access_token ?? null;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server SatuSehat."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server SatuSehat."
                ],
                "response" => []
            ]);
        }
    }
}
