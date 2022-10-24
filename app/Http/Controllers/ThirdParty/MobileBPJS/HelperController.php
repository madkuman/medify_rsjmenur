<?php

namespace App\Http\Controllers\ThirdParty\MobileBPJS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelperController extends Controller
{
	public function success($response, $message = "OK")
	{
		$res = [
			'response' => $response,
			'metadata' => [
				"message" => $message,
				"code" => 200
			]
		];
		return json_encode($res);
	}

	public function error($response = 'error', $code = 400, $message = "Invalid Request")
	{
		$res = [
			'response' => $response,
			'metadata' => [
				"message" => $message,
				"code" => $code
			]
		];
		return response()->json($res, $code);
	}

	public function errorAuth()
	{
		$res = [
			'response' => null,
			'metadata' => [
				"message" => "Unauthorize",
				"code" => 401
			]
		];
		return response()->json($res, 401);
	}
}
