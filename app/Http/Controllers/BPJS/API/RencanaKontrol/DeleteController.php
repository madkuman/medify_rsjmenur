<?php

namespace App\Http\Controllers\BPJS\API\RencanaKontrol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;

class DeleteController extends Controller
{
    public function delete($data)
    {
        $params = app('App\Http\Controllers\BPJS\RencanaKontrol\ReadController')->paramsHapusRencanaKontrol($data);
        try {
            $res = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\RencanaKontrol\DeleteController')->delete($params);

            #example-response
            // $res = '{"metaData":{"code":"200","message":"Sukses"},"response":null}';

            return $res;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        } catch (\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
