<?php

namespace App\Http\Controllers\BPJS\API\Sep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class CreateController extends Controller
{
    public function create($data)
    {
		// dd($data);
    	try
		{
			$new_data = [];
			foreach($data as $key => $value)
			{
				$new_data[$key] =  "$value";
			}

			$client = new Client();
			$res = $client->request('POST', config('app.bpjs_app_url').'/sep/create', 
				[
                    'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
					\GuzzleHttp\RequestOptions::FORM_PARAMS => $data,
				]
			);
			$content = json_decode($res->getBody()->getContents());
			return $content;
		} catch (RequestException $e) {
			// echo Psr7\str($e->getRequest());
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}catch (\Exception $e){
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			// echo Psr7\str($e);
		}
    }
}
