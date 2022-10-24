<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkToAbort($data)
    {
    	if(is_null($data))	abort(404);
    }

    public function saveEloquent($eloquent, $fields){
        foreach ($fields as $key => $value) {
            $eloquent->$key = $value ?? null;
        }

        $eloquent->save();

        return $eloquent;
    }

    public function bugsnag($th, $is_json = 0, $response = []){
        app(\App\Http\Controllers\Error\Handler::class)->bugsnag($th);
        if($is_json)
            return json_encode($response);
        return $response;
    }

    public function bugsnagJson($th){
        return $this->bugsnag($th, 1, $this->resErrorJsonWeb());
    }

    public function resSuccessJsonWeb($message = 'Berhasil', $url = 0, $response = [])
    {        
        $response['status']  = 1;
        $response['title']   = 'Berhasil';
        $response['message'] = $message;
        $response['url']     = $url;

        return json_encode($response);
    }

    public function resErrorJsonWeb($message = 'Terjadi Kesalahan Server', $url = 0, $response = [])
    {
        $response['status']  = -1;
        $response['title']   = 'Gagal';
        $response['message'] = $message;
        $response['url']     = $url;
        
        return json_encode($response);
    }

    public function getInitThirdPartyBPJS()
    {
        // app('debugbar')->disable();
        return app(\App\Http\Controllers\ThirdParty\BPJS\RequestController::class);
    }

    public function dynamicResponse($request, $return)
    {
        if ($request->ajax()) {
            return response()->json($return);
        } else {
            return $return;
        }
    }

}