<?php

namespace App\Http\Controllers\BPJS\API\Applicare;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class EditController extends Controller
{
    public function editRuangan($param)
    {
    	if(!is_object($param))
    		$param = (object) $param;
    	$data['medify_cons_id'] = config('app.applicare_cons_id');
    	$data['medify_secret'] = config('app.applicare_secret');
    	$data['kelas'] = $param->kelas_applicare;
    	$data['kode_ruang'] = $param->kode_ruang;
    	$data['nama_ruang'] = $param->nama_ruang;
    	$data['kapasitas'] = $param->kapasitas;
    	$data['tersedia'] = $param->tersedia;
    	$data['tersedia_pria'] = 0;
    	$data['tersedia_wanita'] = 0;
    	$data['tersedia_pria_wanita'] = 0;
    	$ppk = config('app.applicare_ppk');

    	try
		{
			$client = new Client();
			$res = $client->request('POST', config('app.bpjs_app_url').'/applicare/ruangan/'.$ppk.'/update', 
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

    public function batchUpdate($data_ruang)
    {
    	$data['data_ruang'] = $data_ruang;
    	// dd($data);
		$payload = json_encode($data);
		 
		try
		{
			$kamar = app('App\Http\Controllers\ThirdParty\BPJS\Applicare\EditController')->batchUpdate($data);
			// dd($content, $data);
			return $kamar;
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
		// $ch = curl_init(config('app.bpjs_app_url').'/applicare/ruangan/'.$ppk.'/batch-update');
		// curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		// curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		//     'Content-Type: application/json',
		//     'Content-Length: ' . strlen($payload))
		// );
		// $result = curl_exec($ch);
		 
		// curl_close($ch);
    }
}
