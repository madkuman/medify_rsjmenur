<?php

namespace App\Http\Controllers\BPJS\API\Sep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class EditController extends Controller
{
    public function update($data)
    {
		// dd($data);
    	try
		{
			$client = new Client();
			$res = $client->request('POST', config('app.bpjs_app_url').'/sep/edit', 
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

    public function pulang($data)
    {
    	try
		{
			if (config('medify.third-party.vclaim.on_v2')) {
				$res = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\SEP\EditController')->pulang2($data);
				return $res;
			} else {
				$client = new Client();
				$res = $client->request('POST', config('app.bpjs_app_url').'/sep/pulang', 
					[
						'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
						\GuzzleHttp\RequestOptions::FORM_PARAMS => $data,
					]
				);
				$content = json_decode($res->getBody()->getContents());
				return $content;
			}
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
