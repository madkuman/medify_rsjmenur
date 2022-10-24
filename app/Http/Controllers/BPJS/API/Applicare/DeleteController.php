<?php

namespace App\Http\Controllers\BPJS\API\Applicare;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class DeleteController extends Controller
{
    public function deleteRuangan($param)
    {
    	if(!is_object($param))
    		$param = (object) $param;
    	$data['medify_cons_id'] = config('app.applicare_cons_id');
    	$data['medify_secret'] = config('app.applicare_secret');
    	$data['kelas'] = $param->kelas_applicare;
    	$data['kode_ruang'] = $param->kode_ruang;
    	$ppk = config('app.applicare_ppk');

    	try
		{
			$client = new Client();
			$res = $client->request('POST', config('app.bpjs_app_url').'/applicare/ruangan/'.$ppk.'/delete', 
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

	public function deleteRuanganBatch($param)
    {
    	try
		{
			$response = app('App\Http\Controllers\ThirdParty\BPJS\Applicare\DeleteController')->deleteRuanganBatch($param);
			return $response;
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
