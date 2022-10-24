<?php

namespace App\Http\Controllers\BPJS\API\Applicare;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleReq;
use GuzzleHttp\Psr7;

class CreateController extends Controller
{
    public function createRuangan($param)
    {
    	if(!is_object($param))
    		$param = (object) $param;

    	$kode_ppk = config('app.applicare_ppk');
    	$param = [
    		'kodekelas' => $param->kelas,
    		'koderuang' => $param->kode_ruang,
    		'namaruang' => $param->nama_ruang,
    		'kapasitas' => $param->kapasitas,
    		'tersedia' => $param->tersedia,
    		'tersediapria' => 0,
    		'tersediawanita' => 0,
    		'tersediapriawanita' => 0,
    	];

    	try
		{
			$res = app('App\Http\Controllers\ThirdParty\BPJS\Applicare\CreateController')->createRuangan($kode_ppk, $param);
			return $res;
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
