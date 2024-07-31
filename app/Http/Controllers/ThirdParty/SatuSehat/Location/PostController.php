<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController());
    }

    public function create(Request $request)
    {
        $hospital_lokasi_id = $request->id;

        $lokasi = app(\App\Http\Controllers\Hospital\Lokasi\ReadController::class)->getSingleLokasi($hospital_lokasi_id, ['departemen']);
        if (empty($lokasi)) return null;

        $identifier_value = strtoupper(Str::slug($lokasi->departemen->slug.'-'.$lokasi->nama));
        $request_param = new Request([
            'name' => $lokasi->nama,
            'description' => $lokasi->nama.' - '.($lokasi->departemen->nama ?? ""),
            'identifier_value' => $identifier_value
        ]);
        $get_params = app(\App\Http\Controllers\ThirdParty\SatuSehat\Location\CreateController::class)->getCreateParam($request_param);
        $params = new Request($get_params);

        try {
            $url = $this->request->getBaseUrl().'/Location';
            $send = $this->request->send('POST', $url, \GuzzleHttp\RequestOptions::JSON, $params->all());
            $send = json_decode($send);
            
            if ($send->code == 200) {
                $response = $send->response ?? [];
                $location_data = app(\App\Http\Controllers\ThirdParty\SatuSehat\Location\CreateController::class)->save($lokasi, $response);
                return $location_data;
            }

            return null;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return null;
        }
    }
}
