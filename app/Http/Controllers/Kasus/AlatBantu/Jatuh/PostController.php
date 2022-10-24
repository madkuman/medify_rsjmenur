<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Jatuh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatHumptyDumpty;
use Auth;
use DB;
use Carbon\Carbon;

class PostController extends Controller
{
    public function create($nomor_kasus,Request $request)
	{
		if ($request->assesment_type == "humpty") {
			$data = app('App\Http\Controllers\Kasus\AlatBantu\HumptyDumpty\PostController')
			->create($nomor_kasus, $request);
		} else {
			$data = app('App\Http\Controllers\Kasus\AlatBantu\Morse\PostController')
			->create($nomor_kasus, $request);
		}

		return back()
		->with('message', $data['message'])
		->with('title', $data['title'])
		->with('status', $data['status']);
	}

	public function addTataLaksana($nomor_kasus,Request $request)
	{
		if ($request->assesment_type == "humpty") {
			$submit = app('App\Http\Controllers\Kasus\AlatBantu\HumptyDumpty\PostController')
			->addTataLaksana($request);
			return $submit;
		} else {
			$submit = app('App\Http\Controllers\Kasus\AlatBantu\Morse\PostController')
			->tatalaksana($nomor_kasus, $request);
			return $submit;
		}
	}
}
