<?php

namespace App\Http\Controllers\Users\RekamMedis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class ViewController extends Controller
{
    	public function index()
    	{
    		$user_id = Auth::user()->id;
    		$my_rm = app('App\Http\Controllers\RekamMedis\Transaksi\ReadController')->getMyRM(1,$user_id);
    		$my_group = app('App\Http\Controllers\Group\Members\ReadController')->getMyGroup($user_id);

            //exclude grup rekam medis
            $rm_id = app('App\Http\Controllers\Group\Group\ReadController')->getRMGroupId();
            if (($key = array_search($rm_id, $my_group)) !== false) {
                unset($my_group[$key]);
            }

    		$my_group_rm = app('App\Http\Controllers\RekamMedis\Transaksi\ReadController')->getMyRM(2,$my_group);

    		$data['my_rm'] = $my_rm;
    		$data['my_group_rm'] = $my_group_rm;

    		return view('users.rekam-medis.index',$data);

    	}

        public function getMyRM()
        {
            $user_id = Auth::user()->id;
            $my_rm = app('App\Http\Controllers\RekamMedis\Transaksi\ReadController')->getMyRM(1,$user_id);

            $my_group = app('App\Http\Controllers\Group\Members\ReadController')->getMyGroup($user_id);
            $my_group_rm = app('App\Http\Controllers\RekamMedis\Transaksi\ReadController')->getMyRM(2,$my_group);

            $merged = $my_rm->merge($my_group_rm); 

            return $merged;
        }
}
