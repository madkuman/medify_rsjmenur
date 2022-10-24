<?php

namespace App\Http\Controllers\BPJS\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ReadController extends Controller
{
    public function getAllDPJP()
    {
        return User::whereNotNull('kode_dpjp')->get();
    }
    public function getDpjp(Request $request, $keyword)
    {
        $keyword = preg_replace("/[^[:alnum:][:space:]]/u", '', $keyword);
    	$user = User::search($keyword)->whereExists('kode_dpjp')->get();
    	return json_encode($user);
    }

    public function getDpjpById($kode_dpjp)
    {
    	$user = User::where('kode_dpjp', $kode_dpjp)->orderBy('id', 'DESC')->first();
    	return json_encode($user);
    }

    public function getAllDPJPEncoded()
    {
        return json_encode(User::whereNotNull('kode_dpjp')->get());
    }
}
