<?php

namespace App\Http\Controllers\BPJS\API\Applicare;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class ReadController extends Controller
{
    public function getRuanganAll()
    {
    	$data['medify_cons_id'] = config('app.applicare_cons_id');
    	$data['medify_secret'] = config('app.applicare_secret');
    	$ppk = config('app.applicare_ppk');

    	try
		{
			$client = new Client();
			$res = $client->request('POST', config('app.bpjs_app_url').'/applicare/ruangan/'.$ppk.'/get/1/999', 
				[
                    'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
					\GuzzleHttp\RequestOptions::FORM_PARAMS => $data,
				]
			);
			$content = json_decode($res->getBody()->getContents());
			// dd($content, $data);
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
