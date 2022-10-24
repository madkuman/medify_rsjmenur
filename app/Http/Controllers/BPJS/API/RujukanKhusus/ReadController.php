<?php

namespace App\Http\Controllers\BPJS\API\RujukanKhusus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;

class ReadController extends Controller
{
    public function get(Request $request)
    {
        try {
			$data_rujukan_khusus = app(\App\Http\Controllers\BPJS\RujukanKhusus\ViewController::class)->listBulanTahun($request);

			return $data_rujukan_khusus;
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
