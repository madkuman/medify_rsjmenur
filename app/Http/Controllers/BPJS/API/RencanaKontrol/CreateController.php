<?php

namespace App\Http\Controllers\BPJS\API\RencanaKontrol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;

class CreateController extends Controller
{
    public function create($data)
    {
		$params = app('App\Http\Controllers\BPJS\RencanaKontrol\ReadController')->paramsInsertRencanaKontrol($data);
        try {
			$res = app('App\Http\Controllers\ThirdParty\BPJS\VClaim\RencanaKontrol\CreateController')->create($params);

			#example-response
			// $res = '{"metaData":{"code":"200","message":"Ok"},"response":{"noSuratKontrol":"0301R0110520K000013","tglRencanaKontrol":"2020-05-15","namaDokter":"Dr. John Wick","noKartu":"0001328186441","nama":"ARIS","kelamin":"Laki-laki","tglLahir":"1947-12-31","namaDiagnosa":"Cholera"}}';
			
			return $res;
		} catch (RequestException $e) {
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}catch (\Exception $e){
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
    }
}
