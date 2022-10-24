<?php

namespace App\Http\Controllers\BPJS\API\Peserta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use Carbon\Carbon;

class ReadController extends Controller
{
	public function getByKartu($no_kartu, $tanggal)
	{
		$cons_id = config('app.bpjs_cons_id');
		$secret = config('app.bpjs_secret');
		$tanggal = array_reverse(explode("-", $tanggal));
		$tanggal = implode("-", $tanggal);
		$data = [
			'medify_cons_id'		=> $cons_id,
			'bpjs_stage'		=> config('app.bpjs_stage'),
			'medify_secret' 		=> $secret
		];
		try
		{
			if (config('medify.third-party.vclaim.on_v2')) {
				$response = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\Peserta\ReadController')->getByKartu($no_kartu, $tanggal);
				return $response;
			} else {
				$client = new Client();
				$url = config('app.bpjs_app_url').'/peserta/nokartu/'.$no_kartu.'/'.$tanggal;
				$res = $client->request('POST', $url, 
					[
						'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
						\GuzzleHttp\RequestOptions::FORM_PARAMS => $data,
					]
				);
				$content = $res->getBody()->getContents();
				return $content;
			}
		} catch (GuzzleException $e) {
			// echo Psr7\str($e->getRequest());
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}catch (\Exception $e){
			// echo Psr7\str($e);
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}
	
	public function getByNIK(Request $request, $nik, $tanggal)
	{
		$cons_id = config('app.bpjs_cons_id');
		$secret = config('app.bpjs_secret');
		$tanggal = array_reverse(explode("-", $tanggal));
		$tanggal = implode("-", $tanggal);
		$data = [
			'medify_cons_id'		=> $cons_id,
			'bpjs_stage'		=> config('app.bpjs_stage'),
			'medify_secret' 		=> $secret
		];
		try
		{
			$client = new Client();
			$url = config('app.bpjs_app_url').'/peserta/nik/'.$nik.'/'.$tanggal;
			$res = $client->request('POST', $url, 
				[
					'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
					\GuzzleHttp\RequestOptions::FORM_PARAMS => $data,
				]
			);
			$content = $res->getBody()->getContents();
			return $content;
		} catch (GuzzleException $e) {
			// echo Psr7\str($e->getRequest());
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}catch (\Exception $e){
			// echo Psr7\str($e);
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}
}
