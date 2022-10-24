<?php

namespace App\Http\Controllers\ThirdParty\SIRSCovid19\RawatInap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use Carbon\Carbon;

class ReadController extends Controller
{
	public function get()
	{
		$headers['X-rs-id'] = config('app.sirs_id');
		$headers['X-pass'] = config('app.sirs_pass');
		$headers['X-Timestamp'] = Carbon::now()->timestamp;
		$headers['Accept'] ='application/json';
		$url = config('app.sirs_url').'/fo/index.php/Fasyankes';

		try
		{
			$client = new Client();
			$res = $client->get($url, 
				[
					'headers' => $headers
				]
			);
			$content = json_decode($res->getBody()->getContents());
			$data_sirs = $content->fasyankes;
			return json_encode($data_sirs);
		} catch (RequestException $e) {
			$response = Psr7\str($e->getResponse());
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}catch (\Exception $e){
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}
}
