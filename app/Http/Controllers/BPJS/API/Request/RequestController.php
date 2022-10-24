<?php

namespace App\Http\Controllers\BPJS\API\Request;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
	public function getHeader($type)
	{
		if($type == 'vclaim')
		{
			$cons_id = config('app.bpjs_cons_id');
			$secret = config('app.bpjs_secret');
		}
		elseif($type == 'aplicares')
		{
			$cons_id = config('app.applicare_cons_id');
			$secret = config('app.applicare_secret');
		}

		$timestamp = strval(Carbon::now()->setTimezone('UTC')->timestamp);
		date_default_timezone_set('Asia/Jakarta');

		$signature = hash_hmac('sha256', $cons_id."&".$timestamp, $secret, true);

		$encodedSignature = base64_encode($signature);

		$header_array = array(
			'X-cons-id' => $cons_id,
			'X-timestamp' => $timestamp,
			'X-signature' => $encodedSignature
		);
		return $header_array;
	}

	public function getUrl()
	{
		$bpjs_stage = config('app.bpjs_stage');
		if(strtolower($bpjs_stage) == 'production') $url = config('app.bpjs_vclaim_url_prod');
		else $url = config('app.bpjs_vclaim_url_dev');

		return $url;
	}
}
