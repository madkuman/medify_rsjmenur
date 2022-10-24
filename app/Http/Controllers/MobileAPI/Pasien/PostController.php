<?php

namespace App\Http\Controllers\MobileAPI\Pasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserPasien;
use Auth;
use Carbon\Carbon;

class PostController extends Controller
{
	public function save(Request $request)
	{
		$user_id = Auth::guard('pasien')->id();
		$user = UserPasien::find($user_id);
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->no_hp = $request->no_hp;
		$user->ktp = $request->ktp;
		$user->alamat = $request->alamat;
		$user->tempat_lahir = $request->tempat_lahir;
		$tanggal_lahir = Carbon::createFromFormat('d-m-Y', $request->tanggal_lahir)->toDateTimeString();
		$user->tanggal_lahir = $tanggal_lahir;
		$user->save();
		return json_encode([
			'status' => 1,
			'user' => $user
		]);
	}
}
