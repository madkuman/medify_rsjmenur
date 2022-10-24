<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PermintaanUSG;

use App\Models\Kasus\Kasus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function create(Request $request, $nomor_kasus)
    {
    	$val = $request->except('_token');
    	$val = json_encode($val);

    	$kasus_id = Kasus::select('id')->where('nomor_kasus', $nomor_kasus)->pluck('id')->first();

		$return_value = app('App\Http\Controllers\Kasus\AlatBantu\PermintaanUSG\CreateController')->store($val, $kasus_id);

		return back()
        ->with('message', $return_value['message'])
        ->with('title',$return_value['title'])
        ->with('status', $return_value['status']);
    }

    public function edit(Request $request, $nomor_kasus, $id)
    {
    	$val = $request->except('_token');
    	$val = json_encode($val);

    	$return_value = app('App\Http\Controllers\Kasus\AlatBantu\PermintaanUSG\UpdateController')->update($val, $id);

		return back()
        ->with('message', $return_value['message'])
        ->with('title',$return_value['title'])
        ->with('status', $return_value['status']);
    }

    public function delete(Request $request, $nomor_kasus, $id)
    {
    	$return_value = app('App\Http\Controllers\Kasus\AlatBantu\PermintaanUSG\DeleteController')->delete($id);

		return back()
        ->with('message', $return_value['message'])
        ->with('title',$return_value['title'])
        ->with('status', $return_value['status']);
    }
}
