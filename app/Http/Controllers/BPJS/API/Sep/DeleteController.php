<?php

namespace App\Http\Controllers\BPJS\API\Sep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class DeleteController extends Controller
{
    public function delete($data)
    {
    	try
		{
			if (config('medify.third-party.vclaim.on_v2')) {
				$res = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\SEP\DeleteController::class)->deleteSepV2($data);
			}else{
				$res = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\SEP\DeleteController::class)->delete($data);
			}
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

	public function deleteInternal(Request $request, $no_sep){
		try {
			$set_request = 
				[
					"request" => [
						"t_sep" => [
							"noSep"              => $no_sep, //"0301R0110421V000385",
							"noSurat"            => $request->no_surat, //"0301R0110421N000088",
							"tglRujukanInternal" => $request->tgl_rujukan_internal,//"2021-04-11",
							"kdPoliTuj"          => $request->kode_poli_tujuan, //"PAR" ,
							"user"               => auth()->user()->name ?? 'SuperAdmin',
						],
					]
				];
			$res = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\SEP\DeleteController::class)->deleteInternal($set_request);
			$res = json_decode($res);

			if($res->metaData->code == '500'){
				$status = -1;
				$title = 'Gagal !';
			}else{
				$status = 1;
				$title = 'Berhasil';

			}

			return back()
					->with('message', $res->metaData->message)
					->with('status', $status)
					->with('title', $title)
					->with('no_sep', $no_sep);

		} catch (RequestException $e) {
			// echo Psr7\str($e->getRequest());
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		} catch (\Throwable $th) {
			$this->bugsnag($th);
		}
	}
}
