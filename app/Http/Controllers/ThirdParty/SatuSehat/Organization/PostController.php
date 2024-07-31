<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdPartySatuSehat\Organization;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PostController extends Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController());
    }

    public function getById(Request $request)
    {
        $id = config('medify.third-party.satusehat.organization_id');
        $org = Organization::where('satusehat_id', $id)->first();
        if (!empty($org)) {
            return $org->response;
        }

        $header_array = $this->request->getHeader();
        if (empty($header_array)) return $this->request->failedResponse();

        try {
            $url = $this->request->getBaseUrl() . '/Organization/' . $id;
            $send = $this->request->send('GET', $url);
            $send = json_decode($send);
            
            $org = new Organization();
            $org->satusehat_id = $id;
            $org->response = json_encode($send->response);
            $org->save();
            
            return $org->response;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return null;
        }
    }
}
