<?php

namespace App\Http\Controllers\MobileAPI\Pasien\Auth\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserPasien;
use Response;

class PostController extends Controller
{
	public function checkPhoneNumber(Request $request)
	{
		$phoneNum = $request->input('phone');
		$user = UserPasien::where('no_hp', $phoneNum)->first();
		if($user) {
			return Response::json(
				array(
						'status' => 1,
						'data' => $user
					));
		} else {
			return Response::json(
				array(
						'status' => -1
					));
		}
	}

	public function login(Request $request)
	{
		$token = $request->input('token');
		$phoneNum = $request->input('phone');
		$user = UserPasien::with('otp')->where('no_hp', '=', $phoneNum)->first();

		if($user && $this->validateToken($token, $user, $request->input('device_token'))) {
			
			app('App\Http\Controllers\Pasien\Auth\RegisterController')->deviceTokenCheck($request->device_token, $request->phone);
			return Response::json(
				array('success' => true,
					'status' => 1
				));
		} else {
			return Response::json(
				array('success' => false,
					'status' => -1
				));
		}
	}

	public function validateToken($token, $user, $device)
	{
	  $validToken = $user->otp->last()->code;
	  if($token == $validToken) {
	  	$user->device = $device;
	  	$user->save();
	    return true;
	  } else {
	    return false;
	  }
	}

	public function nologin(Request $request)
	{
	  $phoneNum = $request->input('phone');
	  $user = UserPasien::where('no_hp', '=', $phoneNum)->first();
	  if($user) {

		$user->device = $request->input('device_token_medify');
		$user->save();
		app('App\Http\Controllers\MobileAPI\Pasien\Auth\Register\PostController')->deviceTokenCheck($request->device_token_medify, $request->phone);
	    return Response::json(
	    	array('success' => true,
					'status' => 1
				));
	  } else {
	    return Response::json(
	    	array('success' => false,
					'status' => -1
				));
	  }
	}
}
