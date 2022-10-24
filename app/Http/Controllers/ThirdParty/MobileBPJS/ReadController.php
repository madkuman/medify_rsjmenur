<?php

namespace App\Http\Controllers\ThirdParty\MobileBPJS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\UserBpjsMobile;
use App\User;
use DB;
use Hash;

class ReadController extends Controller
{
	public function getToken(Request $request)
	{
		DB::connection('mysql')->beginTransaction();
		DB::connection('thirdp')->beginTransaction();
		try {
			app('debugbar')->disable();
			$username = $request->header('x-username');
			$password = $request->header('x-password');
			/** cek user ada di db atau tidak */
			$user = User::where('username', $username)
				->first();
				
			if(empty($user)) return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')->error('User tidak ditemukan');

			$cek = Hash::check($password, $user->password);
			if ($cek == false) {
				$message = 'Username tidak ditemukan / Password salah';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error($message);
			}
			/** end cek user */
			/** generate token */
			$token = Hash::make($username . $password);
			$signature = hash('sha256', $token);
			$encodedSignature = base64_encode($signature);
			/** end generate token */

			$data['token']      = $encodedSignature;
			$data['created_by'] = $user->id;
			app('App\Http\Controllers\ThirdParty\MobileBPJS\CreateController')->saveToken($data);
			$response = ['token' => $encodedSignature];

			$log['jenis_request'] = 'post';
			$log['url']			  = 'mobile-bpjs/get-token';
			$log['param']         = json_encode($request->input());
			$log['response']      = json_encode($response);
			$log['created_by']    = $user->id;
			app('App\Http\Controllers\ThirdParty\MobileBPJS\CreateController')->createLog($log);

			DB::connection('thirdp')->commit();
			DB::connection('mysql')->commit();
			return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
				->success($response);
		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('thirdp')->rollback();
			DB::connection('mysql')->rollback();
			return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
				->error();
		}
	}

	public function cekUserToken($headers)
	{
		$user = User::where('username', $headers['username'])->first();
		$result = UserBpjsMobile::where('token', $headers['token'])
								->where('created_by', $user->id)
								->first();
		return $result;
	}
}
