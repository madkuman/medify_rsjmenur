<?php

namespace App\Http\Middleware;

use Closure;
use App\UserPasien;
use Auth;

class PasienMobileAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $device = $request->device_token_medify;
        if(empty($device))
        {
            return response()->json(['status' => 401, 'message' => 'token kosong']);
        }
        $id_user = UserPasien::where('device', $device)->first();
        if(empty($id_user->id))
        {
            return response()->json(['status' => 401, 'message' => 'user tidak ditemukan']);
        }

        Auth::guard('pasien')->loginUsingId($id_user->id);

        return $next($request);
    }
}
