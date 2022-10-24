<?php

namespace App\Http\Controllers\BPJS\API\RujukBalik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;

class DeleteController extends Controller
{
    public function delete($param)
	{
		try {
			$content = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\RujukBalik\DeleteController::class)->delete($param);

			#example-response
			// $content = '{"metaData": {"code": "200","message": "OK"	},"response": "941111924"}';
       
			return $content;
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
